<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookReview;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = BookReview::with(['user', 'book'])->latest()->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function show(BookReview $review)
    {
        return view('admin.reviews.show', compact('review'));
    }

    public function edit(BookReview $review)
    {
        $books = Book::all();
        $users = User::all();
        return view('admin.reviews.edit', compact('review', 'books', 'users'));
    }

    public function update(Request $request, BookReview $review)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
            'rating'  => 'required|integer|min:1|max:5',
            'review'  => 'nullable|string',
        ]);

        $review->update([
            'book_id' => $request->book_id,
            'user_id' => $request->user_id,
            'rating'  => $request->rating,
            'review'  => $request->review,
        ]);

        return redirect()->route('admin.reviews.index')->with('success', 'Ulasan berhasil diperbarui.');
    }

    public function destroy(BookReview $review)
    {
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Ulasan berhasil dihapus.');
    }
}
