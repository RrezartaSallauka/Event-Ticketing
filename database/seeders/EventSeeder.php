<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            Event::create([
                'name' => Str::random(10),
                'description' => Str::random(15),
                'user_id' => $i + 1,
                'venue_id' => $i + 1,
                'date' => now()->format('Y-m-d')
            ]);
        }

    }
}
