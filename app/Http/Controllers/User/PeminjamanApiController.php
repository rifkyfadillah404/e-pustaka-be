<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PeminjamanApiController extends Controller
{
    /**
     * Get user's borrowing history
     */
    public function index()
    {
        try {
            $user = Auth::user();

            $peminjaman = Peminjaman::with(['book'])
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();

            $data = $peminjaman->map(function ($item) {
                return [
                    'id' => $item->id,
                    'book' => [
                        'id' => $item->book->id,
                        'book_code' => $item->book->book_code,
                        'title' => $item->book->title,
                        'author' => $item->book->author,
                        'publisher' => $item->book->publisher,
                        'year' => $item->book->year,
                        'image' => $item->book->image ? asset('storage/' . str_replace('public/', '', $item->book->image)) : null,
                    ],
                    'quantity' => $item->quantity,
                    'status' => $item->status,
                    'request_date' => $item->created_at->format('Y-m-d H:i:s'),
                    'borrow_date' => $item->tanggal_pinjam,
                    'return_date' => $item->tanggal_kembali,
                    'status_label' => $this->getStatusLabel($item->status),
                    'status_color' => $this->getStatusColor($item->status),
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Borrowing history retrieved successfully',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve borrowing history',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create new borrowing request
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'books_id' => 'required|exists:books,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $userId = $request->user_id;
            $user = User::findOrFail($userId);
            $book = Book::findOrFail($request->books_id); // throws 404 if not found

            $existingRequest = Peminjaman::where('user_id', $user->id)
                ->where('books_id', $book->id)
                ->whereIn('status', ['pending', 'approved'])
                ->first();

            if ($existingRequest) {
                return response()->json([
                    'success' => false,
                    'message' => 'You already have a pending or approved request for this book',
                ], 400);
            }

            // Check if book is currently borrowed by someone else
            $bookBorrowed = Peminjaman::where('books_id', $book->id)
                ->where('status', 'approved')
                ->exists();

            if ($bookBorrowed) {
                return response()->json([
                    'success' => false,
                    'message' => 'This book is currently borrowed by another user',
                ], 400);
            }

            // Buat permintaan peminjaman baru
            $peminjaman = Peminjaman::create([
                'user_id' => $user->id,
                'books_id' => $book->id,
                'quantity' => 1,
                'status' => 'pending',
                'tanggal_pinjam' => now(),
                'tanggal_kembali' => null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Borrowing request submitted successfully',
                'data' => [
                    'id' => $peminjaman->id,
                    'book' => [
                        'id' => $book->id,
                        'book_code' => $book->book_code,
                        'title' => $book->title,
                        'author' => $book->author,
                    ],
                    'status' => $peminjaman->status,
                    'request_date' => $peminjaman->created_at->format('Y-m-d H:i:s'),
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to submit borrowing request',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
