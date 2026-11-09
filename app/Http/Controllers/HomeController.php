<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Schedule::with('bus')
            ->where('status', 'available');

        if ($request->filled('origin')) {
            $query->where('origin', 'like', '%' . $request->origin . '%');
        }

        if ($request->filled('destination')) {
            $query->where('destination', 'like', '%' . $request->destination . '%');
        }

        if ($request->filled('date')) {
            $query->whereDate('departure_at', $request->date);
        }

        $schedules = $query->orderBy('departure_at')->get();

        return view('home', compact('schedules'));
    }
}