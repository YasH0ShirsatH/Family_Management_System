<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container-fluid" style="margin : 0rem; margin-top: 1rem; border-radius: 20px;">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            <i class="bi bi-check-circle me-2"></i>({{ session('name') }} {{ session('surname') }}) :
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Header -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
            <div class="container">
                <span class="navbar-brand mb-0 h1">
                    <i class="bi bi-house-heart me-2"></i>Family Management System
                </span>
                <div>
                    <a href="logout" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                    </a>
                    <a href="/" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-plus-circle"></i> Create Head
                    </a>
                </div>
            </div>
        </nav>

        <!-- Stats -->
        <div class="container mb-4">
            <div class="row text-center">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary">
                                <i class="bi bi-house me-2"></i>{{ $heads->count() }}
                            </h5>
                            <p class="card-text text-muted">Total Families</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-success">
                                <i
                                    class="bi bi-people me-2"></i>{{ $heads->sum(function($head) { return $head->members->count(); }) }}
                            </h5>
                            <p class="card-text text-muted">Total Members</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form style="width : 84.4%; margin : 2px auto;" action="{{ route('search') }}" method="get" class="d-flex mt-2 mb-4 w-80">
            @csrf
            <input type="text" name="search" class="form-control me-2 w-80" placeholder="Search...(if empty click search/Enter btn to show all data)">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <!-- Family Cards -->
        <div class="container">
            @if($heads->count() > 0)
            <div class="row">

                @foreach ($heads as $user)

                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-primary text-white text-center">
                            <h6 class="mb-0">
                                <i class="bi bi-person-badge me-2"></i>{{ $user->name }}'s Family
                            </h6>
                        </div>

                        <div class="card-body text-center p-4">
                            <img src="{{ asset('uploads/images/' . $user->photo_path) }}"
                                class="rounded-circle border border-3 mb-3"
                                style="width: 80px; height: 80px; object-fit: cover;" alt="Family Head Photo">

                            <h6 class="fw-bold mb-3">{{ ucfirst($user->name) }} {{ ucfirst($user->surname) }}</h6>

                            <div class="row g-2 small">
                                <div class="col-12 d-flex justify-content-between py-1 border-bottom">
                                    <span class="text-muted"><i class="bi bi-calendar3 me-1"></i>Birth:</span>
                                    <span class="fw-bold">{{ $user->birthdate }}</span>
                                </div>
                                <div class="col-12 d-flex justify-content-between py-1 border-bottom">
                                    <span class="text-muted"><i class="bi bi-telephone me-1"></i>Mobile:</span>
                                    <span class="fw-bold">{{ $user->mobile }}</span>
                                </div>
                                <div class="col-12 d-flex justify-content-between py-1">
                                    <span class="text-muted"><i class="bi bi-geo-alt me-1"></i>City:</span>
                                    <span class="fw-bold">{{ ucfirst($user->city) }}</span>
                                </div>
                                <span class="badge bg-success pt-3 pb-3 fs-6">
                                    <i class="bi bi-people me-1"></i>{{ $user->members->count() }} Members
                                </span>
                            </div>
                        </div>

                        <div class="card-footer bg-light">
                            <div class="d-flex justify-content-between align-items-center mb-2">

                                <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-pencil-square me-1"></i>Edit Head
                                </a>
                                <a href="{{ route('admin-member.show',$user->id)}}"
                                    class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-pencil-square me-1"></i>Edit Members
                                </a>
                            </div>
                            <div class="d-grid">
                                <a href="{{ route('admin.show', $user->id) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-eye me-1"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
            <div class="row">
                @else
                <div class="text-center py-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body py-5">
                            <i class="bi bi-house-x display-1 text-muted mb-3"></i>
                            <h4 class="text-muted">No Families Found</h4>
                            <p class="text-muted">There are currently no families registered in the system.</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>