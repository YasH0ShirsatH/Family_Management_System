<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Management - Admin Dashboard</title>
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
            <div class="d-flex gap-2">
                <a href="/" class="btn btn-outline-light">
                    <i class="bi bi-plus-circle me-1"></i>Create Head
                </a>
                <a href="logout" class="btn btn-outline-light">
                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <!-- Success Alert -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <strong>{{ session('name') }} {{ session('surname') }}</strong>: {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Dashboard Header -->
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0 fw-bold">
                    <i class="bi bi-speedometer2 me-2"></i>Admin Dashboard
                </h4>
            </div>
            <div class="card-body p-4">
                <!-- Stats Cards -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="card bg-primary text-white border-0">
                            <div class="card-body text-center py-3">
                                <i class="bi bi-house-door fs-1 mb-2"></i>
                                <h4 class="mb-0">{{ $heads->count() }}</h4>
                                <small>Total Families</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-success text-white border-0">
                            <div class="card-body text-center py-3">
                                <i class="bi bi-people-fill fs-1 mb-2"></i>
                                <h4 class="mb-0">{{ $heads->sum(function($head) { return $head->members->count(); }) }}</h4>
                                <small>Total Members</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search Form -->
                <form action="{{ route('search') }}" method="get" class="d-flex gap-2">
                    @csrf
                    <input type="text" name="search" class="form-control" 
                           placeholder="Search by Name, Mobile No, State, City. (leave empty to show all)">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search me-1"></i>Search
                    </button>
                </form>
            </div>
        </div>
<<<<<<< HEAD
        <form style="width : 84.4%; margin : 2px auto;" action="{{ route('search') }}" method="get" class="d-flex mt-2 mb-4 w-80">
            @csrf
            <input type="text" name="search" class="form-control me-2 w-80" placeholder="Search...(if empty click search/Enter btn to show all data)">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
=======
>>>>>>> 198717efb1b1084c1ff7c95224d834686d96e686

        <!-- Family Cards -->
        @if($heads->count() > 0)
        <div class="row justify-content-center">
            @foreach ($heads as $user)
            <div class="col-lg-6 col-xl-4 mb-4">
                <div class="card h-100 shadow-sm border-0" style="border-radius: 20px; transition: transform 0.2s; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                    <!-- Card Header with Gradient -->
                    <div class="text-center text-white py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px 20px 0 0;">
                        <i class="bi bi-house-heart fs-2 mb-2"></i>
                        <h6 class="mb-0 fw-bold">{{ $user->name }}'s Family</h6>
                    </div>

                    <div class="card-body text-center px-4 py-4">
                        <!-- Profile Image -->
                        <img src="{{ asset('uploads/images/' . $user->photo_path) }}"
                             class="rounded-circle border border-3 border-primary shadow mb-3"
                             style="width: 90px; height: 90px; object-fit: cover;" alt="Family Head Photo">
                        <h5 class="fw-bold mb-3 text-dark">{{ ucfirst($user->name) }} {{ ucfirst($user->surname) }}</h5>

                        <!-- Info Grid -->
                        <div class="row g-2 mb-3 text-start">
                            <div class="col-12">
                                <div class="d-flex align-items-center p-2 bg-light rounded">
                                    <i class="bi bi-calendar3 text-primary me-3"></i>
                                    <div class="flex-grow-1">
                                        <small class="text-muted d-block">Birth Date</small>
                                        <span class="fw-semibold">{{ date('M d, Y', strtotime($user->birthdate)) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center p-2 bg-light rounded">
                                    <i class="bi bi-telephone text-success me-3"></i>
                                    <div class="flex-grow-1">
                                        <small class="text-muted d-block">Mobile</small>
                                        <span class="fw-semibold">{{ $user->mobile }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center p-2 bg-light rounded">
                                    <i class="bi bi-geo-alt text-info me-3"></i>
                                    <div class="flex-grow-1">
                                        <small class="text-muted d-block">Location</small>
                                        <span class="fw-semibold">{{ ucfirst($user->city) }}, {{ ucfirst($user->state) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center p-2 bg-light rounded">
                                    <i class="bi bi-people text-warning me-3"></i>
                                    <div class="flex-grow-1">
                                        <small class="text-muted d-block">Total Members</small>
                                        <span class="fw-semibold">{{ $user->members->count() + 1 }} (Including Head)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Members Badge -->
                        <div class="d-flex justify-content-center">
                            <span class="badge bg-gradient" style="background: linear-gradient(45deg, #28a745, #20c997); font-size: 0.9rem; padding: 8px 16px;">
                                <i class="bi bi-people me-2"></i>{{ $user->members->count() }} Members + 1 Head
                            </span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="card-footer bg-white border-0 p-3">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.show', $user->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-eye me-2"></i>View Family Details
                            </a>
                            <div class="row g-2">
                                <div class="col-6">
                                    <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-outline-warning btn-sm w-100">
                                        <i class="bi bi-pencil me-1"></i>Edit Head
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('admin-member.show',$user->id) }}" class="btn btn-outline-info btn-sm w-100">
                                        <i class="bi bi-people me-1"></i>Members
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="card shadow">
            <div class="card-body text-center py-5">
                <i class="bi bi-house-x" style="font-size: 4rem;" class="text-muted mb-3"></i>
                <h4 class="text-muted">No Families Found</h4>
                <p class="text-muted">There are currently no families registered in the system.</p>
                <a href="/" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Create First Family
                </a>
            </div>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>