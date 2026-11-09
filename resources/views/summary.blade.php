<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-Ticket - NusaTrip</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background: #f2f5fa;
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

        .ticket {
            background: white;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 35px rgba(0, 0, 0, .06);
        }

        .ticket-header {
            background: #173b70;
            color: white;
            padding: 30px;
        }

        .ticket-body {
            padding: 30px;
        }

        .label {
            color: #8b98aa;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .value {
            font-weight: 700;
        }

        .code {
            color: #347fe5;
            font-size: 23px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .price {
            font-size: 25px;
            font-weight: 800;
            color: #173b70;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white;
            }

            .ticket {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar no-print">
        <div class="container">
            <a href="/" class="brand">Nusa<span>Trip.</span></a>
            <span class="text-success fw-semibold">
                <i class="bi bi-check-circle-fill"></i>
                Booking Successful
            </span>
        </div>
    </nav>

    <div class="container py-5">

        <div class="text-center mb-4">
            <i class="bi bi-check-circle-fill text-success" style="font-size:55px"></i>

            <h2 class="fw-bold mt-3">Booking Confirmed!</h2>

            <p class="text-secondary">
                Your journey is ready. Here is your digital ticket.
            </p>
        </div>

        <div class="ticket mx-auto" style="max-width:750px">

            <div class="ticket-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fw-bold mb-1">NusaTrip.</h3>
                        <small>Electronic Bus Ticket</small>
                    </div>

                    <i class="bi bi-ticket-perforated" style="font-size:50px"></i>
                </div>
            </div>

            <div class="ticket-body">

                <div class="mb-4">
                    <div class="label">BOOKING CODE</div>
                    <div class="code">
                        {{ $booking->booking_code }}
                    </div>
                </div>

                <hr>

                <div class="row g-4 mb-4">

                    <div class="col-6">
                        <div class="label">PASSENGER NAME</div>
                        <div class="value">
                            {{ $booking->passenger_name }}
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="label">SEAT NUMBER</div>
                        <div class="value text-primary">
                            {{ $booking->seat->seat_number }}
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="label">BUS</div>
                        <div class="value">
                            {{ $booking->schedule->bus->name }}
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="label">BUS TYPE</div>
                        <div class="value">
                            {{ $booking->schedule->bus->bus_type }}
                        </div>
                    </div>

                </div>

                <hr>

                <div class="row align-items-center py-3">

                    <div class="col-5">
                        <div class="label">DEPARTURE</div>

                        <h3 class="fw-bold">
                            {{ $booking->schedule->departure_at->format('H:i') }}
                        </h3>

                        <div class="value">
                            {{ $booking->schedule->origin }}
                        </div>

                        <small class="text-secondary">
                            {{ $booking->schedule->departure_at->format('d M Y') }}
                        </small>
                    </div>

                    <div class="col-2 text-center">
                        <i class="bi bi-arrow-right text-primary fs-2"></i>
                    </div>

                    <div class="col-5 text-end">
                        <div class="label">ARRIVAL</div>

                        <h3 class="fw-bold">
                            {{ $booking->schedule->arrival_at
    ? $booking->schedule->arrival_at->format('H:i')
    : '-' }}
                        </h3>

                        <div class="value">
                            {{ $booking->schedule->destination }}
                        </div>

                        <small class="text-secondary">
                            {{ $booking->schedule->arrival_at
    ? $booking->schedule->arrival_at->format('d M Y')
    : '-' }}
                        </small>
                    </div>

                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="label">TOTAL PAYMENT</div>
                        <div class="price">
                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                        </div>
                    </div>

                    <span class="badge bg-success p-2">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>

                <hr>

                <div class="text-center text-secondary small">
                    <i class="bi bi-shield-check text-success"></i>
                    Thank you for choosing NusaTrip.
                    Please present this ticket when boarding.
                </div>

            </div>
        </div>

        <div class="d-flex justify-content-center gap-3 mt-4 no-print">
            <button onclick="window.print()" class="btn btn-primary px-4">
                <i class="bi bi-printer me-2"></i>
                Print E-Ticket
            </button>

            <a href="/" class="btn btn-outline-primary px-4">
                Back to Home
            </a>
        </div>

    </div>

</body>

</html>