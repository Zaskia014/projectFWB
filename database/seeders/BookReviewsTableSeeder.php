<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BookReview;

class BookReviewsTableSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            BookReview::create([
                'user_id' => rand(2, 6), // 1 adalah admin
                'book_id' => rand(1, 10),
                'rating' => rand(3, 5),
                'comment' => "Review ke-$i sangat bagus.",
            ]);
        }
    }
}
