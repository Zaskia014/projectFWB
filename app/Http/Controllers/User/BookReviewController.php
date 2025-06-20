<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookReviewController extends Controller
{
    
    public function create(Book $book)
    {
        return view('user.reviews.create', compact('book'));
    }
    public function buku()
    {
        $books = Book::with('author')->latest()->paginate(10);
        return view('user.dashboard', compact('books'));
    }
    public function store(Request $request, Book $book)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);

        BookReview::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->route('user.books.show', $book)->with('success', 'Ulasan berhasil ditambahkan.');
    }

    public function edit(BookReview $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.reviews.edit', compact('review'));
    }

    public function update(Request $request, BookReview $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);

        $review->update([
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->route('user.books.show', $review->book_id)->with('success', 'Ulasan berhasil diperbarui.');
    }

    public function destroy(BookReview $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $review->delete();

        return back()->with('success', 'Ulasan berhasil dihapus.');
    }
}
