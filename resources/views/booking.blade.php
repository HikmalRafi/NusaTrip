
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seat Booking - NusaTrip</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
            color: #17243b;
        }

        .navbar { background: white; padding: 18px 0; }
        .brand { font-size: 24px; font-weight: 800; color: #173b70; text-decoration: none; }
        .brand span { color: #3985ed; }

        .card-box {
            background: white;
            border-radius: 16px;
            padding: 25px;
            border: 1px solid #edf0f5;
        }

        .seat-map {
            max-width: 330px;
            margin: auto;
            padding: 22px;
            border: 2px solid #e5eaf2;
            border-radius: 50px 50px 15px 15px;
        }

        .seat-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 13px;
            margin-top: 25px;
        }

        .seat {
            height: 47px;
            border: 1px solid #b9c9df;
            background: white;
            color: #173b70;
            border-radius: 9px;
            font-weight: 700;
            cursor: pointer;
        }

        .seat:hover:not(:disabled) {
            border-color: #347fe5;
        }

        .seat.selected {
            background: #347fe5;
            color: white;
            border-color: #347fe5;
        }

        .seat.booked {
            background: #e2e5ea;
            color: #9ca3af;
            cursor: not-allowed;
            border-color: #e2e5ea;
        }

        .seat-gap {
            visibility: hidden;
        }

        .legend {
            width: 14px;
            height: 14px;
            border-radius: 4px;
            display: inline-block;
        }

        .btn-primary {
            background: #347fe5;
            border: none;
            font-weight: 700;
            padding: 12px;
        }

        .form-control {
            padding: 12px;
            border-radius: 9px;
        }
    </style>
</head>

<body>

<nav class="navbar">
    <div class="container">
        <a href="/" class="brand">Nusa<span>Trip.</span></a>
        <a href="{{ route('ticket.show', $schedule->id) }}"
           class="btn btn-outline-primary btn-sm">
            Back
        </a>
    </div>
</nav>

<div class="container py-5">

    <h2 class="fw-bold">Complete Your Booking</h2>
    <p class="text-secondary">
        Select your preferred seat and enter passenger information.
    </p>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">

        <div class="col-lg-7">

            <div class="card-box">

                <h5 class="fw-bold mb-1">Choose Your Seat</h5>
                <p class="text-secondary small">
                    {{ $schedule->bus->name }} -
                    {{ $schedule->bus->bus_type }}
                </p>

                <div class="d-flex flex-wrap gap-3 my-4 small">
                    <span>
                        <i class="legend" style="background:white;border:1px solid #b9c9df"></i>
                        Available
                    </span>

                    <span>
                        <i class="legend" style="background:#347fe5"></i>
                        Selected
                    </span>

                    <span>
                        <i class="legend" style="background:#e2e5ea"></i>
                        Booked
                    </span>
                </div>

                <div class="seat-map">

                    <div class="text-end mb-4">
                        <i class="bi bi-steering-wheel fs-3 text-secondary"></i>
                    </div>

                    <form id="bookingForm"
                        action="{{ route('booking.store', $schedule->id) }}"
                        method="POST">

                        @csrf

                        <input type="hidden"
                            name="seat_id"
                            id="seat_id"
                            value="{{ old('seat_id') }}">

                        <div class="seat-grid">

                            @foreach($seats as $index => $seat)

                                @php
                                    $booked = in_array($seat->id, $bookedSeatIds);
                                    $selected = old('seat_id') == $seat->id;
                                @endphp

                                @if($index % 4 == 2)
                                    <div class="seat-gap"></div>
                                @endif

                                <button type="button"
                                    class="seat
                                    {{ $booked ? 'booked' : '' }}
                                    {{ $selected && !$booked ? 'selected' : '' }}"
                                    data-id="{{ $seat->id }}"
                                    {{ $booked ? 'disabled' : '' }}>

                                    {{ $seat->seat_number }}

                                </button>

                            @endforeach

                        </div>

                    </form>

                </div>

            </div>

        </div>

        <div class="col-lg-5">

            <div class="card-box">

                <h5 class="fw-bold mb-4">Passenger Information</h5>

                <form id="passengerForm"
                    action="{{ route('booking.store', $schedule->id) }}"
                    method="POST">

                    @csrf

                    <input type="hidden"
                        name="seat_id"
                        id="passenger_seat_id"
                        value="{{ old('seat_id') }}">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Full Name
                        </label>
                        <input type="text"
                            name="passenger_name"
                            class="form-control"
                            placeholder="Enter passenger name"
                            value="{{ old('passenger_name') }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Email Address
                        </label>
                        <input type="email"
                            name="email"
                            class="form-control"
                            placeholder="example@email.com"
                            value="{{ old('email') }}"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Phone Number
                        </label>
                        <input type="tel"
                            name="phone"
                            class="form-control"
                            placeholder="08xxxxxxxxxx"
                            value="{{ old('phone') }}"
                            required>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-secondary">Bus</span>
                        <strong>{{ $schedule->bus->name }}</strong>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-secondary">Route</span>
                        <strong>
                            {{ $schedule->origin }} -
                            {{ $schedule->destination }}
                        </strong>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-secondary">Selected Seat</span>
                        <strong id="selectedSeat">Not selected</strong>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <span class="text-secondary">Total Price</span>
                        <strong class="text-primary fs-5">
                            Rp {{ number_format($schedule->price, 0, ',', '.') }}
                        </strong>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Confirm Booking
                        <i class="bi bi-arrow-right ms-2"></i>
                    </button>

                    <p class="text-secondary text-center small mt-3">
                        Please check your information before confirming.
                    </p>

                </form>

            </div>

        </div>

    </div>

</div>

<script>
    const seats = document.querySelectorAll('.seat:not(:disabled)');
    const seatInput = document.getElementById('seat_id');
    const passengerSeatInput = document.getElementById('passenger_seat_id');
    const selectedSeatText = document.getElementById('selectedSeat');

    seats.forEach(seat => {
        seat.addEventListener('click', function () {

            seats.forEach(item => item.classList.remove('selected'));

            this.classList.add('selected');

            seatInput.value = this.dataset.id;
            passengerSeatInput.value = this.dataset.id;

            selectedSeatText.textContent = this.textContent.trim();
        });
    });

    document.getElementById('passengerForm').addEventListener('submit', function(e) {
        if (!passengerSeatInput.value) {
            e.preventDefault();
            alert('Please select a seat first!');
        }
    });

    if (seatInput.value) {
        const previous = document.querySelector(
            '.seat[data-id="' + seatInput.value + '"]'
        );

        if (previous) {
            previous.classList.add('selected');
            selectedSeatText.textContent = previous.textContent.trim();
        }
    }
</script>

</body>
</html>
