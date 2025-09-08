<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Management - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    a {
        text-decoration: none;
    }
    </style>
</head>

<body class="bg-light">
    <!-- Navigation -->
    <nav class="navbar navbar-dark bg-primary shadow">
        <div class="container">
            <a class="navbar-brand fs-4 fw-bold">
                <i class="bi bi-house-heart me-2"></i>Family Management System
            </a>
            <div class="d-flex gap-2">
                <a href="/headview" class="btn btn-success rounded-pill">
                    <i class="bi bi-plus-circle me-1"></i>Create Head
                </a>
                <a href="/state-city" class="btn btn-warning rounded-pill">
                    <i class="bi bi-plus-circle me-1"></i>Create State/City
                </a>
                <a href="logout" class="btn btn-danger rounded-pill">
                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                </a>

            </div>
        </div>
    </nav>

    <div class="container py-4">
        <!-- Success Alert -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-pill">
            <strong>{{ session('name') }} {{ session('surname') }}</strong>: {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Dashboard Header -->
        <div class="card shadow mb-4 rounded-4">
            <div class="card-header bg-primary text-white py-3 rounded-top-4">
                <h4 class="mb-0 fw-bold">
                    <i class="bi bi-speedometer2 me-2"></i>Admin Dashboard
                </h4>
            </div>

            <div class="card-body p-4 ">
                <!-- Stats Cards telling num of families and their heads -->

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="card bg-primary text-white border-0 rounded-4">
                            <div class="card-body text-center py-3">
                                <i class="bi bi-house-door fs-1 mb-2"></i>
                                <h4 class="mb-0">{{ $heads->total() }}</h4>
                                <small>Total Families</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-success text-white border-0 rounded-4">
                            <div class="card-body text-center py-3">
                                <i class="bi bi-people-fill fs-1 mb-2"></i>
                                <h4 class="mb-0">{{ $totalMembers }}</h4>
                                <small>Total Members</small>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- Search Form -->
                <div class="card border-0 bg-light rounded-4 mb-4">
                    <div class="card-body p-3">
                        <form action="{{ route('search') }}" method="get" class="d-flex gap-3">
                            @csrf
                            <input type="text" name="search" value="{{ old('search', request()->input('search')) }}"
                                class="form-control rounded-pill border-0 shadow-sm"
                                placeholder="Search by Name, Mobile No, State, City..." style="padding: 12px 20px;">
                            <button type="submit" class="btn btn-primary rounded-pill shadow-sm flex-shrink-0" style="padding: 12px 40px; min-width: 150px;">
                                <i class="bi bi-search me-2"></i>Search
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Family List -->
        @if($heads->count() > 0)
        <div class="row">
            <div class="col-12">
                @foreach ($heads as $user)
                <div class="card shadow-sm mb-3 rounded-4" style="transition: all 0.2s;" onmouseover="this.style.transform='scale(1.01)'" onmouseout="this.style.transform='scale(1)'">
                    <div class="card-body p-4">
                        <div class="row align-items-center g-3">
                            <!-- Profile Image -->
                            <div class="col-md-2 text-center">
                                <img src="{{ asset('uploads/images/' . $user->photo_path) }}"
                                     class="rounded-circle border border-3 border-primary shadow"
                                     style="width: 90px; height: 90px; object-fit: cover;" alt="Family Head Photo">
                            </div>
                            
                            <!-- Family Info -->
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="badge rounded-pill" style="background: linear-gradient(45deg, #667eea, #764ba2); padding: 8px 15px;">
                                        <i class="bi bi-house-heart me-2"></i>{{ $user->name }}'s Family
                                    </span>
                                </div>
                                <h5 class="fw-bold mb-3">{{ ucfirst($user->name) }} {{ ucfirst($user->surname) }}</h5>
                                <div class="row g-2">
                                    <div class="col-sm-6">
                                        <small class="text-muted d-flex align-items-center">
                                            <i class="bi bi-calendar3 text-primary me-2"></i>
                                            {{ date('M d, Y', strtotime($user->birthdate)) }}
                                        </small>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted d-flex align-items-center">
                                            <i class="bi bi-telephone text-success me-2"></i>
                                            {{ $user->mobile }}
                                        </small>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted d-flex align-items-center">
                                            <i class="bi bi-geo-alt text-info me-2"></i>
                                            {{ ucfirst($user->city) }}, {{ ucfirst($user->state) }}
                                        </small>
                                    </div>
                                    <div class="col-sm-6">
                                        <span class="badge bg-success rounded-pill">
                                            <i class="bi bi-people me-1"></i>{{ $user->members->count() + 1 }} Members
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="col-md-4">
                                <div class="d-grid gap-3">
                                    <a href="{{ route('admin.show', $user->id) }}" class="btn btn-primary" style="border-radius: 25px; padding: 12px 20px;">
                                        <i class="bi bi-eye me-2"></i>View Details
                                    </a>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-outline-warning w-100" style="border-radius: 25px; padding: 10px 15px;">
                                                <i class="bi bi-pencil me-1"></i>Edit Head
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('admin-member.show',$user->id) }}" class="btn btn-outline-info w-100" style="border-radius: 25px; padding: 10px 15px;">
                                                <i class="bi bi-people me-1"></i>Edit Members
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Pagination -->
        @if($heads->hasPages())
        <div class="d-flex justify-content-center align-items-center mt-4 gap-2">
            @if ($heads->onFirstPage())
                <span class="btn btn-light disabled" style="border-radius: 20px;">« Previous</span>
            @else
                <a href="{{ $heads->previousPageUrl() }}" class="btn btn-primary" style="border-radius: 20px;">« Previous</a>
            @endif

            @for ($i = 1; $i <= $heads->lastPage(); $i++)
                @if ($i == $heads->currentPage())
                    <span class="btn btn-primary" style="border-radius: 20px;">{{ $i }}</span>
                @else
                    <a href="{{ $heads->url($i) }}" class="btn btn-outline-primary" style="border-radius: 20px;">{{ $i }}</a>
                @endif
            @endfor

            @if ($heads->hasMorePages())
                <a href="{{ $heads->nextPageUrl() }}" class="btn btn-primary" style="border-radius: 20px;">Next »</a>
            @else
                <span class="btn btn-light disabled" style="border-radius: 20px;">Next »</span>
            @endif
        </div>
        @endif
        @else
        <div class="card shadow rounded-4">
            <div class="card-body text-center py-5">
                <i class="bi bi-house-x" style="font-size: 4rem;" class="text-muted mb-3"></i>
                <h4 class="text-muted">No Families Found</h4>
                <p class="text-muted">There are currently no families registered in the system.</p>
                <a href="/" class="btn btn-primary rounded-pill">
                    <i class="bi bi-plus-circle me-2"></i>Create First Family
                </a>
            </div>
        </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>