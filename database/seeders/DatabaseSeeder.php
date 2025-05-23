<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
 
    $this->call([
        UsersTableSeeder::class,
        CategoriesTableSeeder::class,
        BooksTableSeeder::class,
        BookReviewsTableSeeder::class,
        FavoritesTableSeeder::class,
        LogsTableSeeder::class,
    ]);
}

}
