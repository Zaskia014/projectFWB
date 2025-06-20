<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->latest()->paginate(10);
        return view('books.index', compact('books'));
    }
    
    public function show($id)
    {
        // Ambil data buku beserta relasinya
        $book = Book::with(['category', 'reviews.user', 'favoritedBy'])->findOrFail($id);

        return view('books.show', compact('book'));
    }
}
