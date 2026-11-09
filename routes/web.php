<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BookingController;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/ticket/{id}', [TicketController::class, 'show'])
    ->name('ticket.show');

Route::get('/booking/{id}', [BookingController::class, 'create'])
    ->name('booking.create');

Route::post('/booking/{id}', [BookingController::class, 'store'])
    ->name('booking.store');

Route::get('/booking/summary/{code}', [BookingController::class, 'summary'])
    ->name('booking.summary');
