<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    // Tampilkan semua buku
    public function index()
    {
        $books = Book::with('author')->latest()->paginate(10);
        return view('books.index', compact('books'));
    }
    

    // Tampilkan form tambah buku (jika admin/author)
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    // Simpan buku baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'author_id' => Auth::id(), // hanya jika author login
        ]);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    // Tampilkan detail buku (dengan author dan reviews)
    public function show(Book $book)
    {
        $book->load(['author', 'reviews.user']); // eager load author & reviews
        return view('books.show', compact('book'));
    }

    // Tampilkan form edit buku
    public function edit(Book $book)
    {
        // $this->authorize('update', $book); // opsional, jika pakai policy

        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    // Update buku
    public function update(Request $request, Book $book)
    {
        // $this->authorize('update', $book); // opsional

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $book->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    // Hapus buku
    public function destroy(Book $book)
    {
        // $this->authorize('delete', $book); // opsional
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }
}
