<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Favorite;

class FavoritesTableSeeder extends Seeder
{
    public function run()
    {
        Favorite::create([
            'user_id' => 1, // ID pengguna
            'book_id' => 1, // ID buku yang difavoritkan
        ]);

        Favorite::create([
            'user_id' => 2,
            'book_id' => 2,
        ]);
    }
}
