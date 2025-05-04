<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BookReview;

class BookReviewsTableSeeder extends Seeder
{
    public function run()
    {
        BookReview::create([
            'book_id' => 1, // ID buku
            'user_id' => 1, // ID pengguna
            'rating' => 5,
            'review' => 'This book was amazing! A must-read for everyone.',
        ]);

        BookReview::create([
            'book_id' => 2,
            'user_id' => 2,
            'rating' => 4,
            'review' => 'Great book, but it could use more examples.',
        ]);
    }
}
