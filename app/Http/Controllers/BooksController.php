<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->latest()->paginate(10);
        return view('books.index', compact('books'));
    }

    public function show($id)
    {
        $book = Book::with(['author', 'category', 'reviews.user', 'favoritedBy'])->findOrFail($id);

        $hasBought = false;
        $hasFavorited = false;

        if (Auth::check()) {
            // ✅ Cek apakah user sudah membeli buku (melalui relasi pivot book_transaction)
            $hasBought = Auth::user()->transactions()
                ->whereHas('books', function ($q) use ($book) {
                    $q->where('book_id', $book->id);
                })
                ->exists();

            // ✅ Cek apakah user sudah memfavoritkan buku ini
            $hasFavorited = Auth::user()->hasFavorited($book);
        }

        return view('books.show', compact('book', 'hasBought', 'hasFavorited'));
    }
}