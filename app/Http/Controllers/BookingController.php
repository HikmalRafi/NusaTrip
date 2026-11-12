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
    /**
     * Menampilkan halaman pemilihan kursi dan data penumpang.
     */
    public function create($id)
    {
        $schedule = Schedule::with('bus')->findOrFail($id);

        // Pastikan jadwal masih tersedia dan belum lewat.
        if (
            $schedule->status !== 'available' ||
            $schedule->departure_at->isPast()
        ) {
            abort(404, 'Jadwal perjalanan tidak tersedia.');
        }

        // Ambil kursi berdasarkan bus pada jadwal tersebut.
        $seats = Seat::where('bus_id', $schedule->bus_id)
            ->orderBy('id')
            ->get();

        // Ambil kursi yang sudah dipesan.
        $bookedSeatIds = Booking::where('schedule_id', $id)
            ->where('status', 'confirmed')
            ->pluck('seat_id')
            ->toArray();

        return view('booking', compact(
            'schedule',
            'seats',
            'bookedSeatIds'
        ));
    }

    /**
     * Memproses pemesanan tiket.
     */
    public function store(Request $request, $id)
    {
        // Validasi data penumpang dan kursi.
        $validated = $request->validate([
            'seat_id' => [
                'required',
                'integer',
                'exists:seats,id',
            ],

            'passenger_name' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email:rfc,dns',
                'max:100',
            ],

            'phone' => [
                'required',
                'regex:/^[0-9+\-\s]{9,20}$/',
            ],
        ], [
            'seat_id.required' => 'Silakan pilih kursi terlebih dahulu.',
            'seat_id.exists' => 'Kursi yang dipilih tidak valid.',

            'passenger_name.required' => 'Nama penumpang wajib diisi.',
            'passenger_name.max' => 'Nama penumpang maksimal 100 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid atau domain email tidak dapat diverifikasi.',
            'email.max' => 'Email maksimal 100 karakter.',

            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.regex' => 'Nomor telepon harus berisi 9–20 karakter angka atau tanda + dan -.',
        ]);

        // Proses pemesanan menggunakan database transaction.
        $booking = DB::transaction(function () use ($validated, $id) {

            // Kunci jadwal agar tidak berubah selama proses pemesanan.
            $schedule = Schedule::whereKey($id)
                ->lockForUpdate()
                ->firstOrFail();

            // Periksa status jadwal.
            if ($schedule->status !== 'available') {
                throw ValidationException::withMessages([
                    'seat_id' => 'Jadwal perjalanan sudah tidak tersedia.',
                ]);
            }

            // Periksa apakah jadwal sudah lewat.
            if ($schedule->departure_at->isPast()) {
                throw ValidationException::withMessages([
                    'seat_id' => 'Jadwal perjalanan sudah lewat.',
                ]);
            }

            // Kunci kursi yang dipilih.
            $seat = Seat::whereKey($validated['seat_id'])
                ->lockForUpdate()
                ->firstOrFail();

            // Pastikan kursi berasal dari bus yang benar.
            if ($seat->bus_id != $schedule->bus_id) {
                throw ValidationException::withMessages([
                    'seat_id' => 'Kursi tidak sesuai dengan bus ini.',
                ]);
            }

            // Periksa apakah kursi sudah dipesan pada jadwal ini.
            $alreadyBooked = Booking::where('schedule_id', $schedule->id)
                ->where('seat_id', $seat->id)
                ->where('status', 'confirmed')
                ->exists();

            if ($alreadyBooked) {
                throw ValidationException::withMessages([
                    'seat_id' => 'Kursi sudah dipesan. Silakan pilih kursi lain.',
                ]);
            }

            // Buat data pemesanan.
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

        // Arahkan pengguna ke halaman E-ticket.
        return redirect()->route(
            'booking.summary',
            $booking->booking_code
        );
    }

    /**
     * Menampilkan ringkasan pemesanan / E-ticket.
     */
    public function summary($code)
    {
        $booking = Booking::with([
            'schedule.bus',
            'seat',
        ])
            ->where('booking_code', $code)
            ->firstOrFail();

        return view('summary', compact('booking'));
    }
}
