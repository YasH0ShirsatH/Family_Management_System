<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Family Management System</title>
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
                <i class="bi bi-person-circle me-2"></i>{{ $user->first_name }} {{ $user->last_name }}
            </span>
        </div>
    </nav>

    <div class="container py-4">
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Quick Access Buttons -->
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <a href="{{ route('admin.index') }}" class="btn btn-primary btn-lg w-100 py-3 shadow">
                    <i class="bi bi-people fs-3 d-block mb-2"></i>
                    <div class="fw-bold">Manage Families</div>
                    <small>View and manage all family records</small>
                </a>
            </div>
            <div class="col-md-6">
                <a href="logout" class="btn btn-danger btn-lg w-100 py-3 shadow">
                    <i class="bi bi-box-arrow-right fs-3 d-block mb-2"></i>
                    <div class="fw-bold">Logout</div>
                    <small>Sign out of your account</small>
                </a>
            </div>
        </div>

        <!-- Dashboard Overview -->
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0 fw-bold">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard Overview
                </h4>
            </div>
            <div class="card-body p-4">
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="card border-0 bg-light text-center">
                            <div class="card-body p-4">
                                <i class="bi bi-people text-primary fs-1 mb-2"></i>
                                <h3 class="fw-bold text-primary mb-1">{{ $headcount }}</h3>
                                <p class="text-muted mb-0">Total Families</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 bg-light text-center">
                            <div class="card-body p-4">
                                <i class="bi bi-person-check text-success fs-1 mb-2"></i>
                                <h3 class="fw-bold text-success mb-1">{{ $membercount }}</h3>
                                <p class="text-muted mb-0">Active Members</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Info -->
                <div class="card bg-light">
                    <div class="card-body p-4">
                        <h5 class="card-title text-center mb-4">
                            <i class="bi bi-person-badge text-info me-2"></i>Account Information
                        </h5>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-person text-muted me-3"></i>
                                    <div>
                                        <small class="text-muted">Name</small>
                                        <div class="fw-semibold">{{ $user->first_name }} {{ $user->last_name }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-envelope text-muted me-3"></i>
                                    <div>
                                        <small class="text-muted">Email</small>
                                        <div class="fw-semibold">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-shield-check text-muted me-3"></i>
                                    <div>
                                        <small class="text-muted">Role</small>
                                        <div class="fw-semibold">Administrator</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle text-muted me-3"></i>
                                    <div>
                                        <small class="text-muted">Status</small>
                                        <div class="fw-semibold text-success">Active</div>
                                    </div>
                                </div>
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