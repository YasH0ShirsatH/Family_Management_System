<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Management - Add Members</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    :root {
        --primary-color: #2563eb;
        --secondary-color: #64748b;
        --success-color: #059669;
        --danger-color: #dc2626;
        --warning-color: #d97706;
        --light-bg: #f8fafc;
        --dark-text: #1e293b;
        --border-color: #e2e8f0;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        background: linear-gradient(135deg, var(--light-bg) 0%, #e2e8f0 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .main-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border: 1px solid var(--border-color);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .card-header-custom {
        background: linear-gradient(135deg, var(--success-color) 0%, #047857 100%);
        color: white;
        padding: 2rem;
        text-align: center;
        border: none;
    }

    .card-header-primary {
        background: linear-gradient(135deg, var(--primary-color) 0%, #1d4ed8 100%);
    }

    .card-header-custom h2,
    .card-header-custom h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
    }

    .card-body-custom {
        padding: 2.5rem;
    }

    .form-label {
        font-weight: 500;
        color: var(--dark-text);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-control,
    .form-select {
        border: 2px solid var(--border-color);
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--success-color);
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
    }

    .form-check-input:checked {
        background-color: var(--success-color);
        border-color: var(--success-color);
    }

    .btn-primary {
        background: var(--success-color);
        border: none;
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .btn-primary:hover {
        background: #047857;
        transform: translateY(-1px);
    }

    .btn-danger {
        background: var(--danger-color);
        border: none;
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-danger:hover {
        background: #b91c1c;
        transform: translateY(-1px);
    }

    .alert {
        border: none;
        border-radius: 12px;
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
    }

    .text-danger {
        color: var(--danger-color) !important;
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }

    .member-card {
        background: white;
        border-radius: 16px;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        overflow: hidden;
        height: 280px;
    }

    .member-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .member-img {
        /* height: 200px; */
        min-height: 280px;
        object-fit: cover;
        width: 100%;
    }

    .profile-image {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid white;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .info-list {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid var(--border-color);
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        color: var(--secondary-color);
        font-weight: 500;
    }

    .info-value {
        color: var(--dark-text);
        font-weight: 600;
        text-align: justify;
        font-size: 14px;
        max-width: 200px;
    }

    .section-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, #1d4ed8 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 12px 12px 0 0;
        margin-bottom: 0;
    }

    .section-body {
        background: white;
        padding: 2rem;
        border-radius: 0 0 12px 12px;
        border: 1px solid var(--border-color);
        border-top: none;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: var(--secondary-color);
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: var(--border-color);
    }
    </style>
</head>

<body>
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="main-card">
                    <div class="card-header-custom">
                        <h2><i class="bi bi-person-plus"></i> Add Family Member</h2>
                        <p class="mb-0 mt-2 opacity-90">Add a new member to your family</p>
                    </div>
                    <div class="card-body-custom">
                        <form action="{{ route('addMember',$id) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label"><i class="bi bi-person"></i> Full Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter full name" value="{{ old('name') }}">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><i class="bi bi-calendar3"></i> Date of Birth</label>
                                <input type="date" name="birthdate"
                                    class="form-control @error('birthdate') is-invalid @enderror"
                                    value="{{ old('birthdate') }}">
                                @error('birthdate')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><i class="bi bi-heart"></i> Marital Status</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="marital_status"
                                                id="married" value="1"
                                                {{ old('marital_status') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="married">Married</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="marital_status"
                                                id="unmarried" value="0"
                                                {{ old('marital_status') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="unmarried">Unmarried</label>
                                        </div>
                                    </div>
                                </div>
                                @error('marital_status')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <div class="mt-3" id="mrg_date_div"
                                    style="display: {{ old('marital_status') == '1' ? 'block' : 'none' }}">
                                    <label class="form-label"><i class="bi bi-calendar-heart"></i> Marriage Date</label>
                                    <input type="date" name="mariage_date"
                                        class="form-control @error('mariage_date') is-invalid @enderror"
                                        value="{{ old('mariage_date') }}">
                                    @error('mariage_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><i class="bi bi-mortarboard"></i> Education (Optional)</label>
                                <input type="text" name="education" class="form-control"
                                    placeholder="Enter education qualification" value="{{ old('education') }}">
                                @error('education')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label"><i class="bi bi-camera"></i> Photo</label>
                                <input type="file" name="photo_path" class="form-control" accept="image/*">
                                <small class="text-muted">Upload a clear photo (JPG, PNG, max 2MB)</small>
                                @error('photo_path')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-person-plus me-2"></i>Add Family Member
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="main-card">
                <div class="card-header-custom card-header-primary">
                    <h3><i class="bi bi-person-badge"></i> Family Head Information</h3>
                </div>
                <div class="card-body-custom text-center">
                    <img src="{{ asset('uploads/images/' . $users->photo_path) }}" class="profile-image mb-4"
                        alt="Head Photo">

                    <h4 class="mb-4" style="color: var(--dark-text);">{{ ucfirst($users->name) }}
                        {{ ucfirst($users->surname) }}</h4>

                    <div class="info-list">
                        <div class="info-item">
                            <span class="info-label"><i class="bi bi-calendar3 me-2"></i>Date of Birth:</span>
                            <span class="info-value">{{ $users->birthdate }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label"><i class="bi bi-heart me-2"></i>Marital Status:</span>
                            <span class="info-value">{{ $users->marital_status ? 'Married' : 'Unmarried' }}</span>
                        </div>
                        @if($users->marital_status)
                        <div class="info-item">
                            <span class="info-label"><i class="bi bi-calendar-heart me-2"></i>Marriage Date:</span>
                            <span class="info-value">{{ $users->mariage_date }}</span>
                        </div>
                        @endif
                        <div class="info-item">
                            <span class="info-label"><i class="bi bi-telephone me-2"></i>Mobile:</span>
                            <span class="info-value">{{ $users->mobile }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label"><i class="bi bi-geo-alt me-2"></i>Address:</span>
                            <span class="info-value">{{ ucfirst($users->address) }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label"><i class="bi bi-map me-2"></i>State:</span>
                            <span class="info-value">{{ ucfirst($users->state) }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label"><i class="bi bi-building me-2"></i>City:</span>
                            <span class="info-value">{{ ucfirst($users->city) }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label"><i class="bi bi-mailbox me-2"></i>Pin Code:</span>
                            <span class="info-value">{{ $users->pincode }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label"><i class="bi bi-star me-2"></i>Hobbies:</span>
                            <span class="info-value">
                                @foreach ($users->hobbies as $hobby)
                                {{ ucfirst($hobby->hobby_name) }}@if(!$loop->last), @endif
                                @endforeach
                            </span>
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <a href="{{ route('logoutMember',$id) }}" class="btn btn-danger btn-lg" id="logout">
                            <i class="bi bi-check-circle me-2"></i>Complete Registration & Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="section-header">
                <h3 class="mb-0"><i class="bi bi-people me-2"></i>Family Members ({{ $members->count() }})</h3>
            </div>
            <div class="section-body">
                @forelse($members as $member)
                <div class="row g-4 mb-4">
                    <div class="col-12">
                        <div class="member-card">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    @if(empty($member->photo_path))
                                    <img src="{{ asset('uploads/images/noimage.png') }}" class="member-img h-100"
                                        alt="No Image">
                                    @else
                                    <img src="{{ asset('uploads/images/' . $member->photo_path) }}"
                                        class="member-img h-100" alt="Member Photo">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="p-4">
                                        <h4 class="mb-3" style="color: var(--dark-text); font-weight: 600;">
                                            {{ $member->name }}</h4>

                                        <div class="row g-3">
                                            <div class="col-sm-6 col-lg-3">
                                                <div class="text-center p-3 bg-light rounded">
                                                    <i class="bi bi-calendar3 text-primary fs-4 mb-2 d-block"></i>
                                                    <small class="text-muted d-block mb-1">Date of Birth</small>
                                                    <strong
                                                        class="small">{{ date('M d, Y', strtotime($member->birthdate)) }}</strong>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-3">
                                                <div class="text-center p-3 bg-light rounded">
                                                    <i class="bi bi-heart text-danger fs-4 mb-2 d-block"></i>
                                                    <small class="text-muted d-block mb-1">Marital Status</small>
                                                    <strong
                                                        class="small">{{ $member->marital_status ? 'Married' : 'Single' }}</strong>
                                                </div>
                                            </div>
                                            @if($member->marital_status)
                                            <div class="col-sm-6 col-lg-3">
                                                <div class="text-center p-3 bg-light rounded">
                                                    <i class="bi bi-calendar-heart text-success fs-4 mb-2 d-block"></i>
                                                    <small class="text-muted d-block mb-1">Marriage Date</small>
                                                    <strong
                                                        class="small">{{ date('M d, Y', strtotime($member->mariage_date)) }}</strong>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="col-sm-6 col-lg-3">
                                                <div class="text-center p-3 bg-light rounded">
                                                    <i class="bi bi-mortarboard text-warning fs-4 mb-2 d-block"></i>
                                                    <small class="text-muted d-block mb-1">Education</small>
                                                    <strong
                                                        class="small">{{ $member->education ?: 'Not Provided' }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <i class="bi bi-people"></i>
                    <h5>No Family Members Added Yet</h5>
                    <p>Start by adding your first family member using the form above.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const marriedRadio = document.getElementById('married');
        const unmarriedRadio = document.getElementById('unmarried');
        const marriageDateDiv = document.getElementById('mrg_date_div');
        const logoutButton = document.getElementById('logout');

        logoutButton.addEventListener('click', function(event) {
            if (!confirm(
                    'Are you sure you want to complete the registration? Make sure you have added all family members.'
                    )) {
                event.preventDefault();
            }
        });

        function toggleMarriageDate() {
            if (marriedRadio && marriedRadio.checked) {
                marriageDateDiv.style.display = 'block';
            } else {
                marriageDateDiv.style.display = 'none';
            }
        }

        if (marriedRadio) marriedRadio.addEventListener('change', toggleMarriageDate);
        if (unmarriedRadio) unmarriedRadio.addEventListener('change', toggleMarriageDate);
    });
    </script>
</body>

</html>