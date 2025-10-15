<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/heading.css') }}">
    <link rel="stylesheet" href="https://use.typekit.net/qbl3xfq.css">

    <style>
        body {
             font-family: "Exo", sans-serif;
                                        font-optical-sizing: auto;
                                        font-weight: 400;
                                        font-style: normal;
                                        letter-spacing: 0.5px;
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

        .team-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 48px 32px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.04);
            transition: all 0.1s ;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .team-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        }

        .team-card:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 20px 64px rgba(0, 0, 0, 0.08);
            border-color: rgba(13, 110, 253, 0.1);
        }

        .team-avatar {
            margin-bottom: 32px;
        }

        .avatar-circle {
            width: 96px;
            height: 96px;
            background: linear-gradient(135deg, #007AFF, #5856D6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 8px 32px rgba(0, 122, 255, 0.25);
            position: relative;
        }

        .avatar-circle::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, #007AFF, #5856D6);
            border-radius: 50%;
            z-index: -1;
            opacity: 0.3;
        }

        .avatar-initials {
            color: white;
            font-size: 1.75rem;
            font-weight: 600;
            letter-spacing: -0.5px;
        }

        .team-name {
            font-size: 1.75rem;
            font-weight: 600;
            color: #1d1d1f;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .team-role {
            margin-bottom: 24px;
        }

        .role-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 100px;
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 0.3px;
            border: none;
        }

        .role-badge.super-admin {
            background: rgba(0, 122, 255, 0.1);
            color: #007AFF;
        }

        .role-badge.admin {
            background: rgba(88, 86, 214, 0.1);
            color: #5856D6;
        }

        .team-description {
            color: #86868b;
            font-size: 1rem;
            margin-bottom: 32px;
            line-height: 1.4;
            font-weight: 400;
        }

        .team-contact {
            background: rgba(0, 0, 0, 0.02);
            border-radius: 16px;
            padding: 20px;
            margin: -16px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            color: #86868b;
            font-size: 0.95rem;
            font-weight: 400;
        }

        .contact-item i {
            color: #007AFF;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .stats-section {
                margin: 0 10px;
            }

            .section-title {
                font-size: 2rem;
            }

            .team-card {
                padding: 40px 24px;
            }

            .avatar-circle {
                width: 80px;
                height: 80px;
            }

            .avatar-initials {
                font-size: 1.5rem;
            }

            .team-name {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <div id="mainContent">
         @if(session()->has('loginId'))
                   @include('partials.navbar2', ['shouldShowDiv' => true,'shouldShowLoginDiv' => false])
               @else
                   @include('partials.navbar2', ['shouldShowDiv' => false,'shouldShowLoginDiv' => true])
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
                            <p class="text-muted mb-0">All Data Encrypted</p>
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
                <div class="row justify-content-center g-4">
                    @foreach ($admins->where('superuser', '1')->where('first_name','Yash')->where('last_name','Shirsath') as $admin)
                        <div class="col-lg-6 col-md-8">
                            <div class="team-card">
                                <div class="team-avatar">
                                    <div class="avatar-circle">
                                        <span class="avatar-initials">{{ substr($admin->first_name, 0, 1) }}{{ substr($admin->last_name, 0, 1) }}</span>
                                    </div>
                                </div>
                                <div class="team-info">
                                    <h3 class="team-name">{{ $admin->first_name }} {{ $admin->last_name }}</h3>
                                    <div class="team-role">
                                            <span class="role-badge text-danger admin">Frontend Developer</span>

                                        @if ($admin->superuser == '1')
                                            <span class="role-badge super-admin">Super Admin</span>
                                        @else
                                            <span class="role-badge admin">System Admin</span>
                                        @endif
                                            <span class="role-badge text-info admin">Backend Developer</span>

                                    </div>
                                    <p class="team-description">Junior Software Developer</p>
                                    <div class="team-contact">
                                        <div class="contact-item">
                                            <i class="bi bi-phone"></i>
                                            <span>{{ $admin->mobile }}</span>
                                        </div>
                                    </div>
                                </div>
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
                            <a href="/" class="btn text-white btn-primary-custom">
                                Get Started Today <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        @include('partials.footer')
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
