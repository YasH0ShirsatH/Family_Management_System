@php
    $allSessionData = session()->all();
    $lastMatchingKey = null;
    $session_number = 0;

    foreach (array_reverse($allSessionData) as $key => $value) {
        if (str_starts_with($key, 'head_submitted_')) {
            $lastMatchingKey = $key;
            break;
        }
    }


    if ($lastMatchingKey) {
        $number = preg_replace('/[^0-9]/', '', $lastMatchingKey);
        $session_number = $number;
    }

@endphp
@if (@session('head_submitted_' . $session_number))
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    </div>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Resume Session</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>

    <body>

        <div class="vh-100 d-flex justify-content-center align-items-center bg-body-secondary">

            <div class="col-md-9 col-lg-7 col-xl-5">

                <div class="card shadow-sm border-0 rounded-5">
                    <div class="card-body text-center p-5">

                        <i class="bi bi-shield-lock-fill text-primary" style="font-size: 4rem;"></i>

                        <h2 class="display-6 fw-light mt-4">Resume Your Session</h2>

                        <p class="lead text-muted my-4">
                            To protect your information and continue your progress, please click the button below.
                        </p>

                        <a href="{{ route('familySection', $session_number) }}"
                            class="btn btn-primary btn-lg rounded-pill px-5">
                            Continue Session
                        </a>

                        <div class="mt-5">

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

@else


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Family Management System</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
        <style>
            body {
                background: #f4f6fb;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            .hero-section {
                background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
                color: white;
                padding: 80px 0;
                border-radius: 18px;
                margin-bottom: 40px;
            }
            .card {
                border: none;
                border-radius: 18px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                transition: transform 0.15s;
            }
            .card:hover {
                transform: translateY(-2px);
            }
            .btn {
                border-radius: 25px;
                font-weight: 500;
                padding: 12px 30px;
            }
        </style>
    </head>

    <body>
        @include('partials.navbar2', ['shouldShowDiv' => false])

        <div class="container py-4">
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-pill">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-pill">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="hero-section text-center">
                <div class="container">
                    <h1 class="display-4 fw-bold mb-4">
                        <i class="bi bi-house-heart me-3"></i>Family Management System
                    </h1>
                    <p class="lead mb-0">Professional family data management and organization platform</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-body text-center p-5">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                                style="width: 80px; height: 80px;">
                                <i class="bi bi-people text-primary" style="font-size: 2rem;"></i>
                            </div>
                            <h4 class="fw-bold mb-3 text-primary">Family Registration</h4>
                            <p class="text-muted mb-4">Register complete family information including head and members in a single streamlined process.</p>
                            <a href="/family-registration" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i>Register Family
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-body text-center p-5">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4"
                                style="width: 80px; height: 80px;">
                                <i class="bi bi-shield-check text-primary" style="font-size: 2rem;"></i>
                            </div>
                            <h4 class="fw-bold mb-3 text-primary">Administration</h4>
                            <p class="text-muted mb-4">Access administrative dashboard for comprehensive family data management and system control.</p>
                            <a href="/login" class="btn btn-outline-primary">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Admin Access
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

@endif
