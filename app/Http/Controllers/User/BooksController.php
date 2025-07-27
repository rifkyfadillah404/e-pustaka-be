<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        try {
            $books = Book::with('category')->get();

            $formatted = $books->map(function ($book) {
                $fotoUrl = null;

                if ($book->image) {
                    // Handle image path properly
                    $imagePath = $book->image;
                    if (str_starts_with($imagePath, 'public/')) {
                        $imagePath = str_replace('public/', '', $imagePath);
                    }
                    $fotoUrl = url('storage/' . $imagePath);
                }

                return [
                    'id' => $book->id,
                    'title' => $book->title,
                    'author' => $book->author,
                    'publisher' => $book->publisher,
                    'year' => $book->year,
                    'rack' => $book->rack,
                    'category' => $book->category ? $book->category->name : null,
                    'quantity' => (int) $book->quantity,
                    'fotoUrl' => $fotoUrl
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Books retrieved successfully',
                'data' => $formatted
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve books',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $book = Book::with('category')->findOrFail($id);

            $fotoUrl = null;
            if ($book->image) {
                $imagePath = $book->image;
                if (str_starts_with($imagePath, 'public/')) {
                    $imagePath = str_replace('public/', '', $imagePath);
                }
                $fotoUrl = url('storage/' . $imagePath);
            }

            $formatted = [
                'id' => $book->id,
                'title' => $book->title,
                'author' => $book->author,
                'publisher' => $book->publisher,
                'year' => $book->year,
                'rack' => $book->rack,
                'category' => $book->category ? $book->category->name : null,
                'quantity' => (int) $book->quantity,
                'fotoUrl' => $fotoUrl
            ];

            return response()->json([
                'success' => true,
                'message' => 'Book retrieved successfully',
                'data' => $formatted
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function search(Request $request)
    {
        try {
            $query = $request->get('q', '');

            $books = Book::with('category')
                ->where('title', 'LIKE', "%{$query}%")
                ->orWhere('author', 'LIKE', "%{$query}%")
                ->orWhere('publisher', 'LIKE', "%{$query}%")
                ->get();

            $formatted = $books->map(function ($book) {
                $fotoUrl = null;
                if ($book->image) {
                    $imagePath = $book->image;
                    if (str_starts_with($imagePath, 'public/')) {
                        $imagePath = str_replace('public/', '', $imagePath);
                    }
                    $fotoUrl = url('storage/' . $imagePath);
                }

                return [
                    'id' => $book->id,
                    'title' => $book->title,
                    'author' => $book->author,
                    'publisher' => $book->publisher,
                    'year' => $book->year,
                    'rack' => $book->rack,
                    'category' => $book->category ? $book->category->name : null,
                    'quantity' => (int) $book->quantity,
                    'fotoUrl' => $fotoUrl
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Search completed successfully',
                'data' => $formatted,
                'query' => $query
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Search failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
