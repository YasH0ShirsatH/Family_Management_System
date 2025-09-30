<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>State & City Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
        }
        .management-card {
            background: white;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: none;
        }
        .management-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }
        .origami-header {
            background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
            color: white;
            padding: 25px 30px;
            margin: 0;
            border-radius: 0;
        }
        .action-card {
            background: white;
            border-radius: 18px;
            padding: 30px 20px;
            text-decoration: none;
            color: inherit;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: none;
            display: block;
            height: 100%;
            position: relative;
            overflow: hidden;
        }
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
            text-decoration: none;
            color: inherit;
        }

        .stat-pill {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 20px;
            padding: 25px;
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
            <!-- Back Button -->
            <div class="text-center mb-4">
                <a href="/dashboard" class="btn btn-outline-primary rounded-pill">
                    <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
                </a>
            </div>

            <!-- Welcome Banner -->
            <div class="welcome-banner text-center">
                <h1 class="fw-bold mb-3">
                    <i class="bi bi-geo-alt-fill me-3"></i>
                    Location Management
                </h1>
                <p class="lead mb-0 opacity-90">Manage states and cities for the family management system</p>
            </div>

            <!-- Statistics Overview -->
            <div class="management-card mb-5">
                <div class="origami-header">
                    <h4 class="fw-bold mb-0">
                        <i class="bi bi-bar-chart me-2"></i>
                        Location Statistics
                    </h4>
                </div>
                <div class="p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="stat-pill">
                                <div class="mb-3">
                                    <i class="bi bi-map text-primary" style="font-size: 3rem;"></i>
                                </div>
                                <h2 class="fw-bold text-primary mb-2">{{ $states->count() }}</h2>
                                <p class="text-muted mb-0">Total States</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="stat-pill">
                                <div class="mb-3">
                                    <i class="bi bi-buildings text-success" style="font-size: 3rem;"></i>
                                </div>
                                <h2 class="fw-bold text-success mb-2">{{ $cities->count() }}</h2>
                                <p class="text-muted mb-0">Total Cities</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Grid -->
            <div class="row g-4">
                <div class="col-12">
                    <h3 class="fw-bold mb-4 text-center">
                        <i class="bi bi-lightning me-2 text-primary"></i>
                        Quick Actions
                    </h3>
                </div>

                <!-- View States -->
                <div class="col-md-6 col-lg-3">
                    <a href="admin/state-city/states" class="action-card text-center">
                        <div class="mb-3">
                            <i class="bi bi-map-fill text-primary" style="font-size: 3.5rem;"></i>
                        </div>
                        <h5 class="fw-bold text-primary mb-2">View States</h5>
                        <p class="text-muted mb-0 small">Browse and manage all states</p>
                    </a>
                </div>

                <!-- Add State -->
                <div class="col-md-6 col-lg-3">
                    <a href="admin/state-city/createState" class="action-card text-center">
                        <div class="mb-3">
                            <i class="bi bi-plus-square-fill text-success" style="font-size: 3.5rem;"></i>
                        </div>
                        <h5 class="fw-bold text-success mb-2">Add State</h5>
                        <p class="text-muted mb-0 small">Create new state entry</p>
                    </a>
                </div>

                <!-- View Cities -->
                <div class="col-md-6 col-lg-3">
                    <a href="admin/state-city/city" class="action-card text-center">
                        <div class="mb-3">
                            <i class="bi bi-buildings-fill text-warning" style="font-size: 3.5rem;"></i>
                        </div>
                        <h5 class="fw-bold text-warning mb-2">View Cities</h5>
                        <p class="text-muted mb-0 small">Browse and manage all cities</p>
                    </a>
                </div>

                <!-- Add City -->
                <div class="col-md-6 col-lg-3">
                    <a href="admin/state-city/createcity" class="action-card text-center">
                        <div class="mb-3">
                            <i class="bi bi-plus-circle-fill text-info" style="font-size: 3.5rem;"></i>
                        </div>
                        <h5 class="fw-bold text-info mb-2">Add City</h5>
                        <p class="text-muted mb-0 small">Create new city entry</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
