<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Schedule;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    public function create($id)
    {
        $schedule = Schedule::with('bus')->findOrFail($id);

        $seats = Seat::where('bus_id', $schedule->bus_id)
            ->orderBy('id')
            ->get();

        $bookedSeatIds = Booking::where('schedule_id', $id)
            ->pluck('seat_id')
            ->toArray();

        return view('booking', compact(
            'schedule',
            'seats',
            'bookedSeatIds'
        ));
    }

    public function store(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);

        $validated = $request->validate([
            'seat_id' => 'required|integer|exists:seats,id',
            'passenger_name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:20',
        ]);

        $booking = DB::transaction(function () use ($validated, $schedule) {
            $seat = Seat::where('id', $validated['seat_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($seat->bus_id != $schedule->bus_id) {
                throw ValidationException::withMessages([
                    'seat_id' => 'Kursi tidak sesuai dengan bus ini.'
                ]);
            }

            $alreadyBooked = Booking::where(
                'schedule_id',
                $schedule->id
            )->where('seat_id', $seat->id)->exists();

            if ($alreadyBooked) {
                throw ValidationException::withMessages([
                    'seat_id' => 'Kursi sudah dipesan. Pilih kursi lain.'
                ]);
            }

            return Booking::create([
                'schedule_id' => $schedule->id,
                'seat_id' => $seat->id,
                'booking_code' => 'NT-' . strtoupper(Str::random(8)),
                'passenger_name' => $validated['passenger_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'total_price' => $schedule->price,
                'status' => 'confirmed',
            ]);
        });

        return redirect()->route(
            'booking.summary',
            $booking->booking_code
        );
    }

    public function summary($code)
    {
        $booking = Booking::with([
            'schedule.bus',
            'seat'
        ])->where('booking_code', $code)->firstOrFail();

        return view('summary', compact('booking'));
    }
}
