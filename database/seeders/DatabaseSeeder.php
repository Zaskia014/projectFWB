<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tambah 1 user contoh (opsional)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Jalankan semua seeder lainnya
        $this->call([
            UserTableSeeder::class,
            CategoriesTableSeeder::class,
            BooksTableSeeder::class,
            BookReviewsTableSeeder::class,
            FavoritesTableSeeder::class,
            LogsTableSeeder::class,
        ]);
    }
}
