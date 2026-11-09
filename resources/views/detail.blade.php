<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ticket Details - NusaTrip</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
            color: #17243b;
            font-family: 'DM Sans', sans-serif;
        }

        .navbar {
            background: white;
            padding: 18px 0;
        }

        .brand {
            font-size: 25px;
            font-weight: 800;
            color: #173b70;
            text-decoration: none;
        }

        .brand span {
            color: #3985ed;
        }

        .main-card {
            background: white;
            border-radius: 18px;
            padding: 30px;
            border: 1px solid #edf0f5;
        }

        .bus-icon {
            width: 65px;
            height: 65px;
            display: grid;
            place-items: center;
            background: #eaf2ff;
            color: #347fe5;
            font-size: 30px;
            border-radius: 15px;
        }

        .route-city {
            font-size: 25px;
            font-weight: 800;
        }

        .route-line {
            border-top: 2px dashed #cbd5e1;
        }

        .info-label {
            color: #8490a3;
            font-size: 13px;
        }

        .info-value {
            font-weight: 700;
        }

        .price {
            font-size: 28px;
            font-weight: 800;
            color: #173b70;
        }

        .btn-primary {
            background: #347fe5;
            border: none;
            padding: 13px 25px;
            font-weight: 700;
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="container">
            <a href="/" class="brand">Nusa<span>Trip.</span></a>
            <a href="/" class="btn btn-outline-primary">Back to Home</a>
        </div>
    </nav>

    <div class="container py-5">

        <div class="mb-4">
            <small class="text-secondary">Home / Ticket Details</small>
            <h2 class="fw-bold mt-2">Journey Details</h2>
            <p class="text-secondary">Review your travel information before booking.</p>
        </div>

        <div class="row g-4">

            <div class="col-lg-8">

                <div class="main-card mb-4">

                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="bus-icon">
                            <i class="bi bi-bus-front"></i>
                        </div>

                        <div>
                            <h4 class="fw-bold mb-1">{{ $schedule->bus->name }}</h4>
                            <span class="badge bg-primary-subtle text-primary">
                                {{ $schedule->bus->bus_type }}
                            </span>
                        </div>
                    </div>

                    <hr>

                    <div class="row align-items-center py-4">

                        <div class="col-5">
                            <div class="info-label">DEPARTURE</div>
                            <div class="route-city">
                                {{ $schedule->departure_at->format('H:i') }}
                            </div>
                            <h5 class="fw-bold">{{ $schedule->origin }}</h5>
                            <small class="text-secondary">
                                {{ $schedule->departure_at->format('d M Y') }}
                            </small>
                        </div>

                        <div class="col-2 text-center">
                            <i class="bi bi-arrow-right text-primary fs-3"></i>
                        </div>

                        <div class="col-5 text-end">
                            <div class="info-label">ARRIVAL</div>
                            <div class="route-city">
                                {{ $schedule->arrival_at ? $schedule->arrival_at->format('H:i') : '-' }}
                            </div>
                            <h5 class="fw-bold">{{ $schedule->destination }}</h5>
                            <small class="text-secondary">
                                {{ $schedule->arrival_at ? $schedule->arrival_at->format('d M Y') : '-' }}
                            </small>
                        </div>

                    </div>

                    <hr>

                    <h5 class="fw-bold mb-3">Bus Facilities</h5>

                    <div class="d-flex flex-wrap gap-2">
                        @foreach(explode(',', $schedule->bus->facilities) as $facility)
                            <span class="badge bg-light text-dark border p-2">
                                <i class="bi bi-check-circle text-success me-1"></i>
                                {{ trim($facility) }}
                            </span>
                        @endforeach
                    </div>

                    <hr>

                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="info-label">TOTAL SEATS</div>
                            <div class="info-value">
                                {{ $schedule->bus->total_seats }} Seats
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="info-label">AVAILABILITY</div>
                            <div class="info-value text-success">
                                {{ $schedule->status === 'available' ? 'Available' : 'Unavailable' }}
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-lg-4">

                <div class="main-card">
                    <h5 class="fw-bold mb-4">Booking Summary</h5>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-secondary">Ticket price</span>
                        <strong>
                            Rp {{ number_format($schedule->price, 0, ',', '.') }}
                        </strong>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-secondary">Passengers</span>
                        <strong>1 Person</strong>
                    </div>

                    <hr>

                    <div class="text-secondary small">TOTAL PRICE</div>

                    <div class="price mb-4">
                        Rp {{ number_format($schedule->price, 0, ',', '.') }}
                    </div>

                    <a href="{{ route('booking.create', $schedule->id) }}" class="btn btn-primary w-100">
                        Continue Booking
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>

                    <p class="text-secondary text-center small mt-3 mb-0">
                        <i class="bi bi-shield-check text-success"></i>
                        Secure booking process
                    </p>
                </div>

            </div>

        </div>

    </div>

</body>

</html>