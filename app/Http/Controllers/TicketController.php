<?php

namespace App\Http\Controllers;

use App\Models\Schedule;

class TicketController extends Controller
{
    public function show($id)
    {
        $schedule = Schedule::with('bus')->findOrFail($id);

        return view('detail', compact('schedule'));
    }
}