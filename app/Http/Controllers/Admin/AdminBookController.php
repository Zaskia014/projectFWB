<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

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

    // Edit dan update tetap sama seperti sebelumnya
}
