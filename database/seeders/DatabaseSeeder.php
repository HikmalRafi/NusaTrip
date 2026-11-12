<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bus;
use App\Models\Seat;
use App\Models\Schedule;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // DATA BUS DAN RUTE PERJALANAN
        $busData = [
            [
                'bus' => [
                    'name' => 'Nusantara Express',
                    'bus_type' => 'Executive',
                    'facilities' => 'AC, WiFi, Reclining Seat, USB Charger',
                    'total_seats' => 30,
                ],
                'route' => [
                    'origin' => 'Banjarmasin',
                    'destination' => 'Balikpapan',
                    'departure_hour' => 8,
                    'duration_hours' => 10,
                    'price' => 250000,
                ],
            ],

            [
                'bus' => [
                    'name' => 'Borneo Trans',
                    'bus_type' => 'Sleeper',
                    'facilities' => 'AC, Sleeper Seat, WiFi, Snack',
                    'total_seats' => 30,
                ],
                'route' => [
                    'origin' => 'Banjarmasin',
                    'destination' => 'Samarinda',
                    'departure_hour' => 9,
                    'duration_hours' => 12,
                    'price' => 300000,
                ],
            ],

            [
                'bus' => [
                    'name' => 'Royal Journey',
                    'bus_type' => 'Luxury',
                    'facilities' => 'AC, WiFi, Toilet, Entertainment',
                    'total_seats' => 30,
                ],
                'route' => [
                    'origin' => 'Banjarmasin',
                    'destination' => 'Palangka Raya',
                    'departure_hour' => 7,
                    'duration_hours' => 5,
                    'price' => 350000,
                ],
            ],
        ];

        foreach ($busData as $data) {

            // Buat atau perbarui data bus.
            $bus = Bus::updateOrCreate(
                ['name' => $data['bus']['name']],
                $data['bus']
            );

            // Buat 30 kursi untuk setiap bus.
            for ($i = 1; $i <= 30; $i++) {
                Seat::updateOrCreate(
                    [
                        'bus_id' => $bus->id,
                        'seat_number' => 'A' . $i,
                    ]
                );
            }

            // Buat jadwal untuk 14 hari ke depan.
            for ($day = 1; $day <= 14; $day++) {

                $departure = now()
                    ->startOfDay()
                    ->addDays($day)
                    ->setTime(
                        $data['route']['departure_hour'],
                        0
                    );

                $arrival = (clone $departure)->addHours(
                    $data['route']['duration_hours']
                );

                Schedule::updateOrCreate(
                    [
                        'bus_id' => $bus->id,
                        'origin' => $data['route']['origin'],
                        'destination' => $data['route']['destination'],
                        'departure_at' => $departure,
                    ],
                    [
                        'arrival_at' => $arrival,
                        'price' => $data['route']['price'],
                        'status' => 'available',
                    ]
                );
            }
        }
    }
}
