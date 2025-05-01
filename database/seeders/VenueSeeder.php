<?php

namespace Database\Seeders;

use App\Models\Venue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            Venue::create([
                'name' => Str::random(10),
                'location' => Str::random(10),
                'capacity' => $i + 2
            ]);
        }
    }
}
