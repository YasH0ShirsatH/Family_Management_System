<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Navigation -->
    <nav class="navbar navbar-dark bg-primary shadow">
        <div class="container">
            <a class="navbar-brand fs-4 fw-bold">
                <i class="bi bi-house-heart me-2"></i>Family Management System
            </a>
            <span class="navbar-text text-white">
                <i class="bi bi-person-circle me-2"></i>Welcome, Guest
            </span>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-4">
        <!-- Welcome Message -->
        <div class="text-center mb-5">
            <h1 class="display-6 fw-bold text-primary mb-3">
                <i class="bi bi-house-heart me-3"></i>Welcome to Family Management System
            </h1>
            <p class="lead text-muted">Organize, connect, and preserve your family's legacy with our comprehensive management platform. Build meaningful relationships and create lasting memories for generations to come.</p>
        </div>

        <!-- Statistics Overview -->
        <div class="card shadow mb-5 rounded-4">
            <div class="card-header bg-primary text-white py-3 rounded-top-4">
                <h4 class="mb-0 fw-bold">
                    <i class="bi bi-bar-chart me-2"></i>System Statistics
                </h4>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card bg-primary text-white border-0 h-100 rounded-4">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-house-door fs-1 mb-3"></i>
                                <h3 class="mb-2">{{$headcount}}</h3>
                                <h6 class="mb-0">Registered Families</h6>
                                <small class="opacity-75">Active family units in system</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-success text-white border-0 h-100 rounded-4">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-people-fill fs-1 mb-3"></i>
                                <h3 class="mb-2">{{$membercount}}</h3>
                                <h6 class="mb-0">Family Members</h6>
                                <small class="opacity-75">Total individuals registered</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-info text-white border-0 h-100 rounded-4">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-shield-check fs-1 mb-3"></i>
                                <h3 class="mb-2">{{$usercount}}</h3>
                                <h6 class="mb-0">System Administrators</h6>
                                <small class="opacity-75">Authorized admin users</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Cards -->
        <div class="card shadow rounded-4">
            <div class="card-header bg-white border-0 py-4">
                <h4 class="mb-0 fw-bold text-center">
                    <i class="bi bi-rocket-takeoff me-2 text-primary"></i>Get Started with Your Family Journey
                </h4>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card border-primary h-100 rounded-4">
                            <div class="card-body text-center p-4">
                                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 90px; height: 90px;">
                                    <i class="bi bi-person-plus text-primary" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5 class="card-title fw-bold mb-3 text-primary">Register Family Head</h5>
                                <p class="card-text text-muted mb-4">Begin your family tree by registering the primary family head with complete personal information, contact details, and family background to establish the foundation of your family network.</p>
                                <a href="headview" class="btn btn-primary btn-lg rounded-pill">
                                    <i class="bi bi-plus-circle me-2"></i>Start Registration
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border-success h-100 rounded-4">
                            <div class="card-body text-center p-4">
                                <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 90px; height: 90px;">
                                    <i class="bi bi-gear text-success" style="font-size: 2.5rem;"></i>
                                </div>
                                <h5 class="card-title fw-bold mb-3 text-success">Administrative Access</h5>
                                <p class="card-text text-muted mb-4">Access the administrative dashboard to manage all registered families, view comprehensive reports, edit family information, and maintain the overall system with advanced management tools.</p>
                                <a href="/login" class="btn btn-success btn-lg rounded-pill">
                                    <i class="bi bi-shield-lock me-2"></i>Admin Login
                                </a>
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