<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Log;

class LogsTableSeeder extends Seeder
{
    public function run()
    {
        Log::create([
            'user_id' => 1,
            'action' => 'Login',
            'timestamp' => now(),
        ]);

        Log::create([
            'user_id' => 2,
            'action' => 'Added Book to Favorites',
            'timestamp' => now(),
        ]);
    }
}
