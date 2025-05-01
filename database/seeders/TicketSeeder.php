<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            Ticket::create([
                'price' => rand(1,100),
                'seat' => '1B',
                'user_id' => $i + 1,
                'event_id' => $i + 1,
            ]);
        }
    }
}
