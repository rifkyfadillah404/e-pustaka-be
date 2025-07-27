<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->get();
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_code' => 'nullable|string|unique:books,book_code',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'year' => 'required|string|max:255',
            'rack' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->image->store('public/images');
        }

        // Generate book code if not provided
        $bookCode = $request->book_code ?: Book::generateBookCode();

        Book::create([
            'book_code' => $bookCode,
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'image' => $imagePath,
            'year' => $request->year,
            'rack' => $request->rack,
            'category_id' => $request->category_id,
            'quantity' => 1  // Always 1 per book code
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Book created successfully with code: ' . $bookCode);
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'book_code' => 'nullable|string|unique:books,book_code,' . $book->id,
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'year' => 'required|string|max:255',
            'rack' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id'
        ]);

        $imagePath = $book->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->image->store('public/images');
        }

        $book->update([
            'book_code' => $request->book_code ?: $book->book_code,
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'image' => $imagePath,
            'year' => $request->year,
            'rack' => $request->rack,
            'category_id' => $request->category_id,
            'quantity' => 1  // Always 1 per book code
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully');
    }

    public function destroy($id)
    {
        Book::findOrFail($id)->delete();
        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully');
    }
}
