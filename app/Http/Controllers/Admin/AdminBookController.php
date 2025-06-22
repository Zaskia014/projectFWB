<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminBookController extends Controller
{
    public function index()
    {
        $books = Book::with('category', 'author')->get();
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $authors = User::where('role', 'author')->get();
        $categories = Category::all();
        return view('admin.books.create', compact('authors', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'published_date' => 'required|date',
            'category_id'    => 'required|exists:categories,id',
            'author_id'      => 'required|exists:users,id',
            'price'          => 'required|numeric',
            'description'    => 'required|string',
            'cover_image'    => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'title', 'published_date', 'category_id', 'author_id', 'description', 'price'
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        Book::create($data);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show($id)
    {
        $book = Book::with('category', 'author')->findOrFail($id);
        return view('admin.books.show', compact('book'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = User::where('role', 'author')->get();
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'authors', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'published_date' => 'required|date',
            'category_id'    => 'required|exists:categories,id',
            'author_id'      => 'required|exists:users,id',
            'price'          => 'required|numeric',
            'description'    => 'required|string',
            'cover_image'    => 'nullable|image|max:2048',
        ]);

        $book = Book::findOrFail($id);

        $data = $request->only([
            'title', 'published_date', 'category_id', 'author_id', 'description', 'price'
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $book->update($data);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // Hapus cover image jika ada
        if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus.');
    }
}
