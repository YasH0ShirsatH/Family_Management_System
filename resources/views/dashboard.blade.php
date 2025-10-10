<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/qbl3xfq.css">
    <style>
        .new-font{
            font-family: "lora", serif;
            font-weight: 400;
            font-style: normal;
        }
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
        }
        .dashboard-card {
            background: white;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: none;
        }
        .dashboard-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }
        .origami-header {
            background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
            color: white;
            padding: 20px 25px;
            margin: 0;
            border-radius: 0;
        }
        .action-card {
            background: white;
            border-radius: 18px;
            padding: 25px;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: none;
            display: block;
            height: 100%;
        }
        .action-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.15);
            text-decoration: none;
            color: inherit;
        }
        .stat-pill {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            border: 1px solid #dee2e6;
        }
        .welcome-banner {
            background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
            color: white;
            border-radius: 18px;
            padding: 30px;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div id="mainContent">
        @include('partials.navbar2', ['shouldShowDiv' => true])

        <div class="container py-4">
            <!-- Welcome Banner -->
            <div class="welcome-banner text-center">
                <h1 class="fw-bold mb-3 new-font">
                    <i class="bi bi-house-heart me-3"></i>
                    Family Management Dashboard
                </h1>
                <p class="lead mb-0 opacity-90">Manage families, members, and locations with ease</p>
            </div>

            @if (session('error'))
                <div class="alert alert-success alert-dismissible fade show rounded-pill mb-4">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Quick Actions -->
            <div class="row g-4 mb-5">
                <div class="col-12">
                    <h3 class="fw-bold mb-4 new-font">
                        <i class="bi bi-lightning me-2 text-primary"></i>
                        Quick Actions
                    </h3>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('admin.index') }}" class="action-card">
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="bi bi-people-fill text-primary" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="fw-bold text-primary mb-2">Manage Families</h5>
                            <p class="text-muted mb-0">View, edit, and organize family records</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/family-registration" class="action-card">
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="bi bi-person-plus-fill text-success" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="fw-bold text-success mb-2">Create Family</h5>
                            <p class="text-muted mb-0">Register new family head and members</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="/state-city" class="action-card">
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="bi bi-geo-alt-fill text-warning" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="fw-bold text-warning mb-2">Manage Locations</h5>
                            <p class="text-muted mb-0">Configure states and cities</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Statistics Overview -->
            <div class="dashboard-card">
                <div class="origami-header">
                    <h4 class="fw-bold mb-0 new-font">
                        <i class="bi bi-bar-chart me-2"></i>
                        System Overview
                    </h4>
                </div>
                <div class="p-4">
                    <div class="row g-4">
                        <div class="col-md-3 col-6">
                            <div class="stat-pill">
                                <div class="mb-2">
                                    <i class="bi bi-people text-primary" style="font-size: 2rem;"></i>
                                </div>
                                <h3 class="fw-bold text-primary mb-1">{{ $headcount }}</h3>
                                <small class="text-muted">Total Family Heads</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-pill">
                                <div class="mb-2">
                                    <i class="bi bi-person-check text-success" style="font-size: 2rem;"></i>
                                </div>
                                <h3 class="fw-bold text-success mb-1">{{ $membercount }}</h3>
                                <small class="text-muted">Total Members</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-pill">
                                <div class="mb-2">
                                    <i class="bi bi-geo-alt text-warning" style="font-size: 2rem;"></i>
                                </div>
                                <h3 class="fw-bold text-warning mb-1">{{ $statecount }}</h3>
                                <small class="text-muted">Total States</small>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="stat-pill">
                                <div class="mb-2">
                                    <i class="bi bi-geo-fill text-danger" style="font-size: 2rem;"></i>
                                </div>
                                <h3 class="fw-bold text-danger mb-1">{{ $citycount }}</h3>
                                <small class="text-muted">Total Cities</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
