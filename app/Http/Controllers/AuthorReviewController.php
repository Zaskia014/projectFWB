<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookReview;
use Illuminate\Support\Facades\Auth;

class AuthorReviewController extends Controller
{
    public function index()
    {
        // Ambil semua review untuk buku yang ditulis oleh author yang sedang login
        $reviews = BookReview::with(['book', 'user'])
            ->whereHas('book', function ($query) {
                $query->where('author_id', Auth::id());
            })->latest()->get();

        return view('user.reviews.index', compact('reviews'));
    }

    public function destroy($id)
    {
        $review = BookReview::findOrFail($id);

        // Pastikan review ini milik buku author yang sedang login
        if ($review->book->author_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $review->delete();

        return redirect()->route('reviews.index')->with('success', 'Review berhasil dihapus.');
    }
}
