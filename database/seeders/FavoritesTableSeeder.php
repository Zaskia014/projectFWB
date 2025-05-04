<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Favorite;

class FavoritesTableSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Favorite::create([
                'user_id' => rand(2, 6),
                'book_id' => rand(1, 10),
            ]);
        }
    }
}
