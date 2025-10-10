@if($members->status == '9')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Member Deleted - Family Management System</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/heading.css') }}">
        <link rel="stylesheet" href="https://use.typekit.net/qbl3xfq.css">
        
        <style>
            .active-class-2 { background-color: #198754; color: white; transform: translateX(5px); }
            .status-icon { font-size: 4rem; color: #ffc107; margin-bottom: 1rem; animation: pulse 2s infinite; }
            @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.1); } 100% { transform: scale(1); } }
        </style>
    </head>
    <body class="bg-light">
        <div id="mainContent">
            @include('partials.navbar2', ['shouldShowDiv' => true])
            <div class="container py-4">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card shadow rounded-4">
                            <div class="card-header bg-danger text-dark text-center py-3 rounded-top-4">
                                <h2 class="mb-1 fw-bold"><i class="bi bi-x-circle me-2"></i>Member Deleted</h2>
                                <p class="mb-0 opacity-75">This member is deleted</p>
                            </div>
                            <div class="card-body p-5 text-center">
                                <div class="status-icon"><i class="bi bi-x-circle text-danger"></i></div>
                                <h4 class="fw-bold text-dark mb-3">Can't Access</h4>

                                <div class="alert alert-danger border-0 mb-4">
                                    <i class="bi bi-info-circle me-2"></i>Contact administrator to activate this member.
                                </div>
                                <a href="{{ route('admin.index') }}" class="btn btn-primary rounded-pill px-4">
                                    <i class="bi bi-arrow-left me-2"></i>Back to Families
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
 @else
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Profile - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/heading.css') }}">
    <style>
        .active-class-31{
            background-color: #198754;
            color : white;
            transform: translateX(5px);
        }
    </style>
</head>
<body class="bg-light">
    <div id="mainContent">
        @include('partials.navbar2', ['shouldShowDiv' => true])

        <div class="container py-5">
            <div class="text-center mb-4">
                <a href="{{ route('admin.members') }}" class="btn btn-outline-primary rounded-pill">
                    <i class="bi bi-arrow-left me-2"></i>Back to Manage Members
                </a>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 mb-4 rounded-4">
                        <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                            <h2 class="mb-0">
                                <i class="bi bi-person-badge me-2"></i>
                                {{ $members->name }}'s Profile
                            </h2>
                        </div>

                        <div class="card-body p-5 text-center">
                            @if($members->photo_path)
                                <img src="{{ asset('uploads/images/' . $members->photo_path) }}" class="rounded-circle mb-4 border-4 border-light shadow" style="width: 150px; height: 150px; object-fit: cover;" alt="Member Photo">
                            @else
                                <img src="{{ asset('uploads/images/noimage.png') }}" class="rounded-circle mb-4 border-4 border-light shadow" style="width: 150px; height: 150px; object-fit: cover;" alt="No Image">
                            @endif

                            <h3 class="fw-bold mb-4 text-dark">{{ $members->name }}</h3>

                            <div class="card bg-light border-0 rounded-4">
                                <div class="card-body p-4">
                                    <h5 class="card-title text-primary mb-3">
                                        <i class="bi bi-person-circle me-2"></i>Personal Information
                                    </h5>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-2">
                                            @if($members->status == '0')
                                                <span class="text-muted">
                                                    <i class="bi bi-x-circle text-warning me-2"></i>Status
                                                    </span>
                                                <span class="fw-semibold text-warning">Inactive</span>
                                            @else
                                                <span class="text-muted">
                                                    <i class="bi bi-check-circle text-success me-2"></i>Status
                                                </span>
                                                <span class="fw-semibold text-success">Active</span>
                                            @endif
                                        </div>
                                        <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-2">
                                            <span class="text-muted">
                                                <i class="bi bi-calendar3 text-primary me-2"></i>Date of Birth
                                            </span>
                                            <span class="fw-semibold">{{ date('M d, Y', strtotime($members->birthdate)) }}</span>
                                        </div>
                                        <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-2">
                                             @if( $members->relation )
                                                <span class="text-muted">
                                                    <i class="bi bi-people text-primary me-2"></i>Relationship with head
                                                </span>
                                                <span class="fw-semibold">
                                                        {{ ucfirst($members->relation) }}
                                                </span>
                                             @else
                                                    <span class="text-muted">
                                                        <i class="bi bi-slash-circle text-danger me-2"></i>Relationship with head
                                                    </span>
                                                    <span class="fw-semibold">
                                                        Not Provided
                                                    </span>
                                             @endif

                                        </div>

                                        <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-2">
                                            <span class="text-muted">
                                                @if($members->marital_status == 1)
                                                    <i class="bi bi-heart-fill text-danger me-2"></i>Marital Status
                                                @else
                                                    <i class="bi bi-heart text-primary me-2"></i>Marital Status
                                                @endif
                                            </span>
                                            <span class="fw-semibold">{{ $members->marital_status == 1 ? 'Married' : 'Single' }}</span>
                                        </div>
                                        @if($members->mariage_date)
                                        <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-2">
                                            <span class="text-muted">
                                                <i class="bi bi-calendar3 text-danger me-2"></i>Marriage Date
                                            </span>
                                            <span class="fw-semibold">{{ date('M d, Y', strtotime($members->mariage_date)) }}</span>
                                        </div>
                                        @endif
                                        <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-2">
                                            <span class="text-muted">
                                                <i class="bi bi-mortarboard text-primary me-2"></i>Education
                                            </span>
                                            <span class="fw-semibold">{{ $members->education ?: 'Not provided' }}</span>
                                        </div>
                                        <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-2">
                                            <span class="text-muted">
                                                <i class="bi bi-people text-primary me-2"></i>Family Head
                                            </span>
                                            @if($members->head)
                                                <span class="fw-semibold">{{ ucfirst($members->head->name) }} {{ ucfirst($members->head->surname) }}</span>
                                            @else
                                                <span class="text-muted fst-italic">No Family Head</span>
                                            @endif
                                        </div>
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
@endif
