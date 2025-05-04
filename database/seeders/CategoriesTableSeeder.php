<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'name' => 'Fiction',
            'description' => 'Books that contain stories created from the imagination.'
        ]);

        Category::create([
            'name' => 'Non-Fiction',
            'description' => 'Books that are based on real facts and events.'
        ]);

        Category::create([
            'name' => 'Science',
            'description' => 'Books related to scientific concepts and discoveries.'
        ]);
    }
}
