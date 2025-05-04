<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        Book::create([
            'title' => 'The Great Adventure',
            'author_id' => 1, // ID user yang menjadi penulis
            'published_date' => '2022-05-01',
            'category_id' => 1, // ID kategori (misal: Fiction)
            'description' => 'A thrilling adventure novel.',
            'cover_image' => 'great_adventure_cover.jpg',
        ]);

        Book::create([
            'title' => 'Science of the Universe',
            'author_id' => 1,
            'published_date' => '2023-01-15',
            'category_id' => 3, // ID kategori (misal: Science)
            'description' => 'An informative book about the universe.',
            'cover_image' => 'science_of_universe_cover.jpg',
        ]);
    }
}
