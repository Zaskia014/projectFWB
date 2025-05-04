<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BooksTableSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Book::create([
                'title' => "Judul Buku $i",
                'description' => "Deskripsi buku ke-$i",
                'author' => "Penulis $i",
                'category_id' => rand(1, 5),
            ]);
        }
    }
}
