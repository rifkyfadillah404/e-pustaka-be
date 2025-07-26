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
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'year' => 'required|string|max:255',
            'rack' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->image->store('public/images');
        }

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'image' => $imagePath,
            'year' => $request->year,
            'rack' => $request->rack,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Book created successfully');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'year' => 'required|string|max:255',
            'rack' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0'
        ]);

        $book = Book::findOrFail($id);

        $imagePath = $book->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->image->store('public/images');
        }

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'image' => $imagePath,
            'year' => $request->year,
            'rack' => $request->rack,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully');
    }

    public function destroy($id)
    {
        Book::findOrFail($id)->delete();
        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully');
    }
}
