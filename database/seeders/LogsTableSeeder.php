<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Log;

class LogsTableSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Log::create([
                'activity' => "User melakukan aktivitas ke-$i",
                'user_id' => rand(2, 6),
            ]);
        }
    }
}
