<?php

namespace App\Http\Controllers;

use App\Models\Schedule;

class TicketController extends Controller
{
    public function show($id)
    {
        // Cari jadwal beserta informasi bus.
        $schedule = Schedule::with('bus')
            ->findOrFail($id);

        // Tolak jadwal yang tidak tersedia.
        if ($schedule->status !== 'available') {
            abort(404, 'Jadwal perjalanan tidak tersedia.');
        }

        // Tolak jadwal yang sudah lewat.
        if ($schedule->departure_at->isPast()) {
            abort(404, 'Jadwal perjalanan sudah lewat.');
        }

        return view('detail', compact('schedule'));
    }
}
