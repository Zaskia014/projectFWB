<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\BookReview;

class AuthorReviewController extends Controller
{
    public function index()
    {
        $authorId = Auth::id();

        $reviews = BookReview::whereHas('book', function ($query) use ($authorId) {
            $query->where('author_id', $authorId);
        })->with('book', 'user')->latest()->get();

        return view('author.reviews.index', compact('reviews'));
    }
}
