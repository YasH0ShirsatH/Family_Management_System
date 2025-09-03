<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body class="bg-primary">
    <div class="container py-4">
        <!-- Header -->
        <div class="text-center mb-4">
            <h2 class="text-white mb-3"><i class="bi bi-house-heart me-2"></i>Family Details</h2>
            <a href="{{ route('admin.index') }}" class="btn btn-light">
                <i class="bi bi-arrow-left me-1"></i>Back to Dashboard
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="mb-0"><i class="bi bi-person-badge me-2"></i>{{ $heads->name }} Family</h5>
                    </div>
                    <div class="card-body text-center p-4">
                        <img src="{{ asset('uploads/images/' . $heads->photo_path) }}"
                            class="rounded-circle mb-3 border border-3 border-white shadow"
                            style="width: 120px; height: 120px; object-fit: cover;" alt="Head Photo">

                        <h6 class="card-title text-primary mb-3">{{ $heads->name }} {{ $heads->surname }}</h6>

                        <div class="row g-2 mb-3">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted"><i
                                            class="bi bi-calendar3 text-primary me-2"></i>Birth:</span>
                                    <span class="fw-bold">{{ $heads->birthdate }}</span>
                                </div>
                               
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted"><i
                                            class="bi bi-telephone text-primary me-2"></i>Mobile:</span>
                                    <span class="fw-bold">{{ $heads->mobile }}</span>
                                </div>
                               
                                <div class="d-flex justify-content-between align-items-end py-1">
                                    <span class="text-muted"><i class="bi bi-geo-alt text-primary me-2"></i>Address:</span>
                                    <span class="fw-bold fs-6 text-end">{{ $heads->address }}, {{ $heads->city }}</span>
                                </div>

                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted"><i class="bi bi-map text-primary me-2"></i>State:</span>
                                    <span class="fw-bold">{{ $heads->state }}</span>
                                </div>

                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted"><i class="bi bi-mailbox text-primary me-2"></i>Pincode:</span>
                                    <span class="fw-bold">{{ $heads->pincode }}</span>
                                </div>

                                @if($heads->marital_status)
                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted"><i class="bi bi-heart text-danger me-2"></i>Marriage:</span>
                                    <span class="fw-bold">{{ $heads->mariage_date }}</span>
                                </div>
                                @endif

                                <div class="d-flex justify-content-between align-items-center py-1">
                                    <span class="text-muted"><i class="bi bi-star text-warning me-2"></i>Hobbies:</span>
                                    <span class="fw-bold">@foreach ($heads->hobbies as $hobby)
                                        {{ ucfirst($hobby->hobby_name) }} ,
                                        @endforeach</span>
                                </div>

                                
                                
                                
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <span class="badge bg-success fs-6 p-2">
                                <i class="bi bi-people me-1"></i>{{ $heads->members->count() }} Family Members
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
        <!-- Family Members Section -->
        @if($heads->members->count() > 0)
            <div class="container mt-4">
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-white text-center mb-4">
                            <i class="bi bi-people-fill me-2"></i>Family Members
                        </h3>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @foreach($heads->members as $member)
                        <div class="col-md-4 col-lg-3 mb-4">
                            <div class="card border-0 shadow-sm h-100">
                                @if(empty($member->photo_path))
                        <img src="{{ asset('uploads/images/noimage.png') }}" class="card-img-top" alt="No Image">
                    @else
                        <img src="{{ asset('uploads/images/' . $member->photo_path) }}" class="card-img-top" alt="Member Photo">
                    @endif
                                <div class="card-body p-3">
                                    <h6 class="card-title text-primary mb-2">{{ $member->name }}</h6>
                                    <div class="small">
                                        <p class="mb-1"><i class="bi bi-calendar3 text-muted me-1"></i>{{ $member->birthdate }}</p>
                                        <p class="mb-1"><i class="bi bi-heart text-muted me-1"></i>{{ $member->marital_status ? 'Married' : 'Single' }}</p>
                                        @if($member->education)
                                            <p class="mb-1"><i class="bi bi-mortarboard text-muted me-1"></i>{{ $member->education }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="container mt-4">
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle me-2"></i>No family members added yet.
                </div>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>