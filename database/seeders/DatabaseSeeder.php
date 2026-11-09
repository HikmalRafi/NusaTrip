<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bus;
use App\Models\Seat;
use App\Models\Schedule;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $buses = [
            [
                'name' => 'Nusantara Express',
                'bus_type' => 'Executive',
                'facilities' => 'AC, WiFi, Reclining Seat, USB Charger',
                'total_seats' => 30,
            ],
            [
                'name' => 'Borneo Trans',
                'bus_type' => 'Sleeper',
                'facilities' => 'AC, Sleeper Seat, WiFi, Snack',
                'total_seats' => 30,
            ],
            [
                'name' => 'Royal Journey',
                'bus_type' => 'Luxury',
                'facilities' => 'AC, WiFi, Toilet, Entertainment',
                'total_seats' => 30,
            ],
        ];

        foreach ($buses as $index => $data) {
            $bus = Bus::create($data);

            for ($i = 1; $i <= 30; $i++) {
                Seat::create([
                    'bus_id' => $bus->id,
                    'seat_number' => 'A' . $i,
                ]);
            }

            Schedule::create([
                'bus_id' => $bus->id,
                'origin' => 'Banjarmasin',
                'destination' => 'Balikpapan',
                'departure_at' => Carbon::tomorrow()->setTime(8 + $index, 0),
                'arrival_at' => Carbon::tomorrow()->setTime(18 + $index, 0),
                'price' => 250000 + ($index * 50000),
                'status' => 'available',
            ]);
        }
    }
}