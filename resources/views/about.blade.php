<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/heading.css') }}">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #1b1b18;
            background: #FDFDFC;
            min-height: 100vh;
        }

        .hero-section {
            background: linear-gradient(135deg, #0d6efd, #0056b3);
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 100%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(15deg);
        }

        .section-padding {
            padding: 100px 0;
        }

        .feature-card {
            background: white;
            border-radius: 18px;
            padding: 40px 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: none;
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #0d6efd, #0056b3);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
        }

        .stats-section {
            background: rgba(13, 110, 253, 0.05);
            border-radius: 18px;
            padding: 80px 0;
            margin: 0 20px;
            border: 1px solid rgba(13, 110, 253, 0.1);
        }

        .stat-item {
            text-align: center;
            padding: 30px 20px;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: #0d6efd;
            line-height: 1;
        }

        .mission-card {
            background: white;
            border-radius: 18px;
            padding: 50px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            border: none;
        }

        .mission-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(135deg, #0d6efd, #0056b3);
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #0d6efd, #0056b3);
            border: none;
            padding: 15px 40px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-primary-custom:hover {
            background: linear-gradient(135deg, #0b5ed7, #004085);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(13, 110, 253, 0.4);
            color: white;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            color: #1d1d1f;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: #6c757d;
            margin-bottom: 60px;
            font-weight: 400;
        }

        .text-primary {
            color: #0d6efd !important;
        }

        .btn-light {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            color: #1d1d1f;
            font-weight: 600;
        }

        .btn-light:hover {
            background: white;
            color: #1d1d1f;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .stats-section {
                margin: 0 10px;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>

    <div id="mainContent">
        @if (session()->has('loginId'))
            @include('partials.navbar2', ['shouldShowDiv' => true])
        @else
            @include('partials.navbar2', ['shouldShowDiv' => false])
        @endif

        <!-- Hero Section -->
        <section class="hero-section text-white">
            <div class="container position-relative">
                <div class="row align-items-center min-vh-75">
                    <div class="col-lg-6">
                        <h1 class="display-3 fw-bold mb-4">About Our Family Management System</h1>
                        <p class="lead mb-4">We're dedicated to helping families stay organized and connected through
                            innovative digital solutions that simplify family data management.</p>
                        <a href="#features" class="btn btn-light btn-lg rounded-pill px-4">
                            Learn More <i class="bi bi-arrow-down ms-2"></i>
                        </a>
                    </div>
                    <div class="col-lg-6 text-center">
                        <div class="position-relative">
                            <i class="bi bi-people-fill" style="font-size: 12rem; opacity: 0.1;"></i>
                            <div class="position-absolute top-50 start-50 translate-middle">
                                <i class="bi bi-heart-fill text-white" style="font-size: 4rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="section-padding">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-title">Why Choose Our Platform</h2>
                    <p class="section-subtitle">Built with families in mind, designed for the future</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card text-center">
                            <div class="feature-icon mx-auto">
                                <i class="bi bi-shield-check text-white" style="font-size: 1.8rem;"></i>
                            </div>
                            <h4 class="mb-3">Secure & Private</h4>
                            <p class="text-muted">Enterprise-grade security ensures your family data remains protected
                                and confidential at all times.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card text-center">
                            <div class="feature-icon mx-auto">
                                <i class="bi bi-lightning-charge text-white" style="font-size: 1.8rem;"></i>
                            </div>
                            <h4 class="mb-3">Fast & Efficient</h4>
                            <p class="text-muted">Intuitive interface designed for quick access to family information
                                with minimal learning curve.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card text-center">
                            <div class="feature-icon mx-auto">
                                <i class="bi bi-people text-white" style="font-size: 1.8rem;"></i>
                            </div>
                            <h4 class="mb-3">Family Focused</h4>
                            <p class="text-muted">Purpose-built for managing complex family relationships and
                                maintaining important connections.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-number">100%</div>
                            <h5 class="mt-2">Secure</h5>
                            <p class="text-muted mb-0">Data Protection</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-number">24/7</div>
                            <h5 class="mt-2">Available</h5>
                            <p class="text-muted mb-0">System Access</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-number">∞</div>
                            <h5 class="mt-2">Members</h5>
                            <p class="text-muted mb-0">No Limits</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="stat-item">
                            <div class="stat-number">1</div>
                            <h5 class="mt-2">Platform</h5>
                            <p class="text-muted mb-0">Unified System</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="section-padding">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="section-title">Meet the Team</h2>
                    <p class="section-subtitle">The talented developers behind this platform</p>
                </div>
                <div class="row g-4">
                    @foreach ($admins->where('superuser', '1') as $admin)
                        <div class="col-lg-12 col-md-6">
                            <div class="feature-card text-center">
                                <div class="feature-icon mx-auto">
                                    <i class="bi bi-person-circle text-white" style="font-size: 1.8rem;"></i>
                                </div>
                                <h4 class="mb-2">{{ $admin->first_name }} {{ $admin->last_name }}</h4>

                                <p class="text-primary mb-3">
                                    @if ($admin->superuser == '1')
                                        Super Admin
                                    @else
                                        System Admin
                                    @endif
                                </p>
                                <b>Contact</b>
                                <p class="text-muted">{{ $admin->mobile }}</p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>

        <!-- Mission Section -->
        <section class="section-padding bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="mission-card text-center">
                            <h2 class="section-title">Our Mission</h2>
                            <p class="lead mb-4">To empower families with digital tools that strengthen connections,
                                preserve memories, and simplify the management of family information across generations.
                            </p>
                            <a href="/" class="btn btn-primary-custom">
                                Get Started Today <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <footer
            style="background: rgba(0, 109, 214, 0.09); border-radius: 18px 18px 0 0; box-shadow: 0 -5px 15px rgba(0,0,0,0.05); margin-top: 200px; color: #6c757d;">
            <div class="container py-5">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <h5 class="fw-bold text-primary mb-3">
                            <i class="bi bi-house-heart me-2"></i>Family Management System
                        </h5>
                        <p class="text-muted mb-0">Professional family data management and organization platform for
                            modern
                            families.</p>
                    </div>

                    <div class="col-lg-4">
                        <h6 class="fw-bold mb-3">Quick Links</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="/family-registration"
                                    class="text-decoration-none text-muted"><i class="bi bi-people me-2"></i>Family
                                    Registration</a></li>
                            <li class="mb-2"><a href="/login" class="text-decoration-none text-muted"><i
                                        class="bi bi-shield-check me-2"></i>Admin Access</a></li>
                            <li class="mb-2"><a href="/about" class="text-decoration-none text-muted"><i
                                        class="bi bi-info-circle me-2"></i>About Us</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4">
                        <h6 class="fw-bold mb-3">Need Assistance?</h6>
                        <p class="text-muted mb-3">Encountered an issue during registration? Contact our administrator
                            for
                            help.</p>
                        @if ($admin1)
                            <p><small class="text-danger mb-3">Admin login detected.<br>Sign out to file a complaint as
                                    user!!</small></p>
                        @endif
                        <a href='/support' class="btn btn-outline-primary" style="border-radius: 25px;">
                            <i class="bi bi-envelope me-2"></i>Contact Support
                        </a>
                    </div>
                </div>

                <hr class="my-4" style="border-color: rgba(0,0,0,0.1);">

                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0 text-muted">
                            © 2025 <strong>Family Information Management System</strong>
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="" class="text-primary text-decoration-none fw-bold">fims.com</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
