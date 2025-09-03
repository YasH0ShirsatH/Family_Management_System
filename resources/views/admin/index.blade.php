<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }

    .card {
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .badge {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .profile-img {
        border: 3px solid #fff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-view {
        background: linear-gradient(135deg, #28a745, #20c997);
        border: none;
    }

    .btn-view:hover {
        background: linear-gradient(135deg, #20c997, #28a745);
    }
    </style>
</head>

<body class="bg-light">
    <div class="container py-4">

        <!-- Header -->
        <div class="text-center mb-5">
            <h1 class="text-white mb-4"><i class="bi bi-house-heart me-2"></i>Family Management System</h1>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <div class="badge bg-primary fs-5 p-3">
                    <i class="bi bi-people-fill me-2"></i>Total Families: {{ $heads->count() }}
                </div>
                <a href="logout" class="badge bg-danger fs-5 p-3 text-decoration-none">
                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                </a>
            </div>
        </div>


        <div class="row">
            @foreach ($heads as $user)
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="mb-0"><i class="bi bi-person-badge me-2"></i>{{ $user->name }} Family</h5>
                    </div>
                    <div class="card-body text-center p-4">
                        <img src="{{ asset('uploads/images/' . $user->photo_path) }}"
                            class="rounded-circle mb-3 profile-img"
                            style="width: 100px; height: 100px; object-fit: cover;" alt="Head Photo">

                        <h6 class="card-title text-primary mb-3">{{ $user->name }} {{ $user->surname }}</h6>

                        <div class="row g-2 mb-3">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted"><i
                                            class="bi bi-calendar3 text-primary me-2"></i>Birth:</span>
                                    <span class="fw-bold">{{ $user->birthdate }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted"><i
                                            class="bi bi-telephone text-primary me-2"></i>Mobile:</span>
                                    <span class="fw-bold">{{ $user->mobile }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted"><i
                                            class="bi bi-geo-alt text-primary me-2"></i>Location:</span>
                                    <span class="fw-bold">{{ $user->city }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="badge bg-success fs-6">
                                <i class="bi bi-people me-1"></i>{{ $user->members->count() }} Members
                            </span>
                            <a href="{{ route('admin.show',$user->id) }}" class="btn btn-sm btn-view text-white">
                                <i class="bi bi-eye me-1"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>