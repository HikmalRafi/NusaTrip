<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Validasi input pencarian.
        $validated = $request->validate([
            'origin' => 'nullable|string|max:100',
            'destination' => 'nullable|string|max:100',
            'date' => 'nullable|date_format:Y-m-d|after_or_equal:today',
        ], [
            'origin.max' => 'Nama kota asal maksimal 100 karakter.',
            'destination.max' => 'Nama kota tujuan maksimal 100 karakter.',
            'date.date_format' => 'Format tanggal pencarian tidak valid.',
            'date.after_or_equal' => 'Tanggal perjalanan tidak boleh sebelum hari ini.',
        ]);

        // Ambil jadwal yang masih tersedia dan belum lewat.
        $query = Schedule::with('bus')
            ->where('status', 'available')
            ->where('departure_at', '>', now());

        // Filter berdasarkan kota asal.
        if (!empty($validated['origin'])) {
            $query->where(
                'origin',
                'like',
                '%' . $validated['origin'] . '%'
            );
        }

        // Filter berdasarkan kota tujuan.
        if (!empty($validated['destination'])) {
            $query->where(
                'destination',
                'like',
                '%' . $validated['destination'] . '%'
            );
        }

        // Filter berdasarkan tanggal keberangkatan.
        if (!empty($validated['date'])) {
            $query->whereDate(
                'departure_at',
                $validated['date']
            );
        }

        // Urutkan berdasarkan waktu keberangkatan.
        $schedules = $query
            ->orderBy('departure_at')
            ->get();

        return view('home', compact('schedules'));
    }
}
