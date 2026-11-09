<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NusaTrip - Travel With Comfort</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        * {
            font-family: 'DM Sans', sans-serif;
        }

        body {
            background: #f5f7fb;
            color: #17243b;
        }

        .navbar {
            background: white;
            padding: 18px 0;
        }

        .brand {
            color: #173b70;
            font-size: 25px;
            font-weight: 800;
            text-decoration: none;
        }

        .brand span {
            color: #3985ed;
        }

        .nav-link {
            color: #526078;
            font-weight: 600;
            margin-left: 22px;
        }

        .hero {
            background: linear-gradient(115deg, #10294d, #174d88);
            color: white;
            padding: 85px 0 125px;
            border-radius: 0 0 35px 35px;
        }

        .hero h1 {
            font-size: clamp(35px, 5vw, 55px);
            font-weight: 800;
            line-height: 1.15;
        }

        .hero p {
            color: #c7d8ee;
            font-size: 16px;
        }

        .search-box {
            background: white;
            padding: 25px;
            border-radius: 16px;
            margin-top: -65px;
            position: relative;
            box-shadow: 0 12px 40px rgba(20, 40, 80, .10);
        }

        .form-label {
            color: #53627a;
            font-size: 13px;
            font-weight: 700;
        }

        .form-control {
            padding: 13px;
            border: 1px solid #e3e8f0;
            border-radius: 9px;
        }

        .btn-primary {
            background: #347fe5;
            border: none;
            padding: 13px 22px;
            font-weight: 700;
            border-radius: 9px;
        }

        .btn-primary:hover {
            background: #2466c3;
        }

        .section-title {
            font-weight: 800;
            font-size: 27px;
        }

        .bus-card {
            background: white;
            border: 1px solid #edf0f5;
            border-radius: 15px;
            padding: 23px;
            height: 100%;
            transition: .25s;
        }

        .bus-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(20, 40, 80, .08);
        }

        .bus-icon {
            width: 52px;
            height: 52px;
            display: grid;
            place-items: center;
            background: #eaf2ff;
            color: #347fe5;
            font-size: 24px;
            border-radius: 12px;
        }

        .bus-type {
            background: #edf4ff;
            color: #347fe5;
            padding: 5px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        .route-line {
            border-top: 2px dashed #cbd5e1;
            position: relative;
            margin: 12px 0;
        }

        .price {
            font-size: 21px;
            font-weight: 800;
            color: #173b70;
        }

        footer {
            background: #10294d;
            color: #bdcce0;
            margin-top: 90px;
            padding: 35px 0;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="brand" href="/">Nusa<span>Trip.</span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto align-items-lg-center">
                    <a class="nav-link" href="/">Home</a>
                    <a class="nav-link" href="#tickets">Explore Tickets</a>
                    <a class="nav-link" href="#about">About Us</a>
                    <a class="btn btn-primary ms-lg-4 mt-2 mt-lg-0" href="#tickets">
                        Book Your Trip
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-light text-primary mb-3 p-2">
                        YOUR JOURNEY STARTS HERE
                    </span>

                    <h1>Discover Your Next<br>Journey With Us.</h1>

                    <p class="mt-3 mb-0">
                        Travel comfortably, safely, and effortlessly.
                        Find your perfect bus journey with NusaTrip.
                    </p>
                </div>

                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                    <i class="bi bi-bus-front-fill" style="font-size:125px; opacity:.18;"></i>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="search-box">
            <h5 class="fw-bold mb-4">Find Your Journey</h5>

            <form action="{{ route('home') }}" method="GET">
                <div class="row g-3 align-items-end">

                    <div class="col-md-3">
                        <label class="form-label">FROM</label>
                        <input type="text" name="origin" class="form-control" placeholder="Departure city"
                            value="{{ request('origin') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">TO</label>
                        <input type="text" name="destination" class="form-control" placeholder="Destination city"
                            value="{{ request('destination') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">TRAVEL DATE</label>
                        <input type="date" name="date" class="form-control" min="{{ date('Y-m-d') }}"
                            value="{{ request('date') }}">
                    </div>

                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-2"></i> Search Bus
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <section class="container mt-5" id="tickets">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="section-title">Available Bus Tickets</h2>
                <p class="text-secondary mb-0">
                    Choose your preferred bus and enjoy the journey.
                </p>
            </div>
            <span class="text-secondary small">
                {{ $schedules->count() }} schedules found
            </span>
        </div>

        <div class="row g-4">

            @forelse($schedules as $schedule)

                <div class="col-lg-4 col-md-6">
                    <div class="bus-card">

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="bus-icon">
                                <i class="bi bi-bus-front"></i>
                            </div>
                            <span class="bus-type">
                                {{ $schedule->bus->bus_type }}
                            </span>
                        </div>

                        <h5 class="fw-bold mt-3 mb-1">
                            {{ $schedule->bus->name }}
                        </h5>

                        <small class="text-secondary">
                            {{ $schedule->bus->facilities }}
                        </small>

                        <div class="row mt-4 align-items-center">
                            <div class="col-5">
                                <h5 class="fw-bold mb-0">
                                    {{ \Carbon\Carbon::parse($schedule->departure_at)->format('H:i') }}
                                </h5>
                                <small class="text-secondary">
                                    {{ $schedule->origin }}
                                </small>
                            </div>

                            <div class="col-2 text-center">
                                <i class="bi bi-arrow-right text-primary"></i>
                            </div>

                            <div class="col-5 text-end">
                                <h5 class="fw-bold mb-0">
                                    {{ $schedule->arrival_at ? \Carbon\Carbon::parse($schedule->arrival_at)->format('H:i') : '-' }}
                                </h5>
                                <small class="text-secondary">
                                    {{ $schedule->destination }}
                                </small>
                            </div>
                        </div>

                        <div class="route-line"></div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <small class="text-secondary">Starting from</small>
                                <div class="price">
                                    Rp {{ number_format($schedule->price, 0, ',', '.') }}
                                </div>
                            </div>

                            <a href="{{ route('ticket.show', $schedule->id) }}" class="btn btn-primary">
                                View Details
                            </a>
                        </div>

                    </div>
                </div>

            @empty

                <div class="col-12">
                    <div class="bg-white rounded-4 text-center p-5">
                        <i class="bi bi-bus-front text-secondary" style="font-size:45px;"></i>
                        <h5 class="fw-bold mt-3">No buses found</h5>
                        <p class="text-secondary">
                            Try changing your search criteria.
                        </p>
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            Reset Search
                        </a>
                    </div>
                </div>

            @endforelse

        </div>
    </section>

    <section class="container mt-5" id="about">
        <div class="row g-4">
            <div class="col-md-4">
                <h5 class="fw-bold">
                    <i class="bi bi-shield-check text-primary me-2"></i>
                    Safe Journey
                </h5>
                <p class="text-secondary small">
                    Enjoy a comfortable and reliable travel experience.
                </p>
            </div>

            <div class="col-md-4">
                <h5 class="fw-bold">
                    <i class="bi bi-lightning-charge text-primary me-2"></i>
                    Easy Booking
                </h5>
                <p class="text-secondary small">
                    Find and reserve your preferred seat easily.
                </p>
            </div>

            <div class="col-md-4">
                <h5 class="fw-bold">
                    <i class="bi bi-ticket-perforated text-primary me-2"></i>
                    Digital Ticket
                </h5>
                <p class="text-secondary small">
                    Get your booking confirmation digitally.
                </p>
            </div>
        </div>
    </section>

    <footer>
        <div class="container d-flex flex-wrap justify-content-between gap-3">
            <div>
                <h4 class="text-white fw-bold">NusaTrip.</h4>
                <small>Travel smarter, travel better.</small>
            </div>
            <small class="align-self-center">
                © {{ date('Y') }} NusaTrip. All rights reserved.
            </small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>