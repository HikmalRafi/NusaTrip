<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained()->cascadeOnDelete();
            $table->foreignId('seat_id')->constrained()->cascadeOnDelete();
            $table->string('booking_code')->unique();
            $table->string('passenger_name');
            $table->string('email');
            $table->string('phone');
            $table->unsignedBigInteger('total_price');
            $table->string('status')->default('confirmed');
            $table->timestamps();

            $table->unique(['schedule_id', 'seat_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};