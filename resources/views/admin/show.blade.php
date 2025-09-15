<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Details - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/heading.css')  }}">
</head>
<body class="bg-light">
       @include('partials.navbar2',['shouldShowDiv' => true])


    <div class="container py-5">
        <div class="text-center mb-4">
            <a href="{{ route('admin.index') }}" class="btn btn-outline-primary rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Back to Manage Families
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm border-0 mb-4 rounded-4">
                    <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                        <h2 class="mb-0">
                            <i class="bi bi-person-badge me-2"></i>
                            {{ $heads->name }} Family Details
                        </h2>
                    </div>
                    
                    <div class="card-body p-5 text-center">
                        <img src="{{ asset('uploads/images/' . $heads->photo_path) }}"
                             class="rounded-circle mb-4  border-4 border-light shadow"
                             style="width: 150px; height: 150px; object-fit: cover;" alt="Family Head Photo">
                        
                        <h3 class="fw-bold mb-4 text-dark">{{ $heads->name }} {{ $heads->surname }}</h3>
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card bg-light border-0 h-100 rounded-4">
                                    <div class="card-body p-4">
                                        <h5 class="card-title text-primary mb-3">
                                            <i class="bi bi-person-circle me-2"></i>Personal Information
                                        </h5>
                                        <div class="list-group list-group-flush">
                                            <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-2">
                                                <span class="text-muted">
                                                    <i class="bi bi-calendar3 text-primary me-2"></i>Date of Birth
                                                </span>
                                                <span class="fw-semibold">{{ date('M d, Y', strtotime($heads->birthdate)) }}</span>
                                            </div>
                                            <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-2">
                                                <span class="text-muted">
                                                    <i class="bi bi-telephone text-primary me-2"></i>Mobile
                                                </span>
                                                <span class="fw-semibold">{{ $heads->mobile }}</span>
                                            </div>
                                            @if($heads->marital_status)
                                            <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-2">
                                                <span class="text-muted">
                                                    <i class="bi bi-heart text-danger me-2"></i>Marriage Date
                                                </span>
                                                <span class="fw-semibold">{{ date('M d, Y', strtotime($heads->mariage_date)) }}</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="card bg-light border-0 h-100 rounded-4">
                                    <div class="card-body p-4">
                                        <h5 class="card-title text-primary mb-3">
                                            <i class="bi bi-geo-alt me-2"></i>Address Information
                                        </h5>
                                        <div class="list-group list-group-flush">
                                            <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-2">
                                                <span class="text-muted">
                                                    <i class="bi bi-house text-primary me-2"></i>Address
                                                </span>
                                                <span class="fw-semibold text-end">{{ $heads->address }}</span>
                                            </div>
                                            <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-2">
                                                <span class="text-muted">
                                                    <i class="bi bi-building text-primary me-2"></i>City
                                                </span>
                                                <span class="fw-semibold">{{ ucfirst($heads->city) }}</span>
                                            </div>
                                            <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-2">
                                                <span class="text-muted">
                                                    <i class="bi bi-map text-primary me-2"></i>State
                                                </span>
                                                <span class="fw-semibold">{{ ucfirst($heads->state) }}</span>
                                            </div>
                                            <div class="list-group-item bg-transparent d-flex justify-content-between px-0 py-2">
                                                <span class="text-muted">
                                                    <i class="bi bi-mailbox text-primary me-2"></i>Pincode
                                                </span>
                                                <span class="fw-semibold">{{ $heads->pincode }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card bg-light border-0 mt-4 rounded-4">
                            <div class="card-body p-4">
                                <h5 class="card-title text-primary mb-3">
                                    <i class="bi bi-star me-2"></i>Hobbies & Interests
                                </h5>
                                <p class="mb-0 fw-semibold">
                                    @foreach ($heads->hobbies as $hobby)
                                        <span class="badge bg-secondary me-2 mb-2">{{ ucfirst($hobby->hobby_name) }}</span>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <span class="badge bg-success fs-6 px-4 py-3 rounded-pill">
                                <i class="bi bi-people me-2"></i>
                                {{ $heads->members->count() }} Family Members
                            </span>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('download', $heads->id) }}" class="btn btn-outline-danger px-4 w-40" style="border-radius: 25px; padding: 10px 15px;">
                                <i class="bi bi-download me-1"></i>Download PDF
                            </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($heads->members->count() > 0)
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-success text-white text-center py-3">
                            <h3 class="mb-0">
                                <i class="bi bi-people-fill me-2"></i>Family Members
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                @foreach($heads->members as $member)
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="card border-0 shadow-sm h-100 rounded-4">
                                            @if(empty($member->photo_path))
                                                <img src="{{ asset('uploads/images/noimage.png') }}" 
                                                     class="card-img-top" style="height: 200px; object-fit: cover;" alt="No Image">
                                            @else
                                                <img src="{{ asset('uploads/images/' . $member->photo_path) }}" 
                                                     class="card-img-top" style="height: 200px; object-fit: cover;" alt="Member Photo">
                                            @endif
                                            <div class="card-body p-3">
                                                <h6 class="card-title fw-bold text-primary mb-3">{{ $member->name }}</h6>
                                                <div class="small">
                                                    <p class="mb-2 d-flex align-items-center">
                                                        <i class="bi bi-calendar3 text-muted me-2"></i>
                                                        <span>{{ date('M d, Y', strtotime($member->birthdate)) }}</span>
                                                    </p>
                                                    <p class="mb-2 d-flex align-items-center">
                                                        <i class="bi bi-heart text-muted me-2"></i>
                                                        <span>{{ $member->marital_status ? 'Married' : 'Single' }}</span>
                                                    </p>
                                                    <p class="mb-0 d-flex align-items-center">
                                                        <i class="bi bi-mortarboard text-muted me-2"></i>
                                                        @if($member->education)
                                                            <span>{{ $member->education }}</span>
                                                        @else
                                                            <span class="text-muted fst-italic">Not provided</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-success text-white text-center py-3">
                            <h3 class="mb-0">
                                <i class="bi bi-people-fill me-2"></i>Family Members
                            </h3>
                        </div>
                        <div class="card-body text-center py-5">
                            <i class="bi bi-people display-1 text-muted mb-3"></i>
                            <h5 class="text-muted">No Family Members</h5>
                            <p class="text-muted">This family hasn't added any members yet.</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    

</body>
</html>