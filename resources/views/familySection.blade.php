<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Management - Add Members</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        
        <!-- Header with Logout -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold"><i class="bi bi-people-fill me-2"></i>Family Management</h2>
            <a href="{{ route('logoutMember',$id) }}" class="btn btn-danger rounded-pill" id="logout">
                <i class="bi bi-box-arrow-right me-2"></i>Complete & Logout
            </a>
        </div>

        <!-- Alerts -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-pill">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-pill">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Main Content -->
        <div class="row">
            <!-- Add Member Form -->
            <div class="col-lg-5">
                <div class="card shadow rounded-4 sticky-top" style="top: 20px;">
                    <div class="card-header bg-success text-white py-3 rounded-top-4">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-person-plus me-2"></i>Add New Member</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('addMember',$id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="name" class="form-control rounded-pill" placeholder="Full Name" value="{{ old('name') }}">
                                @error('name')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="mb-3">
                                <input type="date" name="birthdate" class="form-control rounded-pill" value="{{ old('birthdate') }}">
                                @error('birthdate')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="mb-3">
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="marital_status" id="married" value="1" {{ old('marital_status') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="married">Married</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="marital_status" id="unmarried" value="0" {{ old('marital_status') == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="unmarried">Single</label>
                                    </div>
                                </div>
                                @error('marital_status')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                                
                                <div class="mt-3" id="mrg_date_div" style="display: {{ old('marital_status') == '1' ? 'block' : 'none' }}">
                                    <input type="date" name="mariage_date" class="form-control rounded-pill" placeholder="Marriage Date" value="{{ old('mariage_date') }}">
                                    @error('mariage_date')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <input type="text" name="education" class="form-control rounded-pill" placeholder="Education (Optional)" value="{{ old('education') }}">
                                @error('education')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="mb-4">
                                <input type="file" name="photo_path" class="form-control rounded-pill" accept="image/*">
                                @error('photo_path')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>
                            
                            <button type="submit" class="btn btn-success w-100 rounded-pill py-2">
                                <i class="bi bi-person-plus me-2"></i>Add Member
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Members List -->
            <div class="col-lg-7">
                <div class="card shadow rounded-4">
                    <div class="card-header bg-primary text-white py-3 rounded-top-4">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-people me-2"></i>Family Members ({{ $members->count() + 1 }})</h5>
                    </div>
                    <div class="card-body p-0">
                        
                        <!-- Family Head -->
                        <div class="p-4 border-bottom">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('uploads/images/' . $users->photo_path) }}" class="rounded-circle me-3" width="60" height="60" style="object-fit: cover;">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="fw-bold mb-0 me-2">{{ $users->name }} {{ $users->surname }}</h6>
                                        <span class="badge bg-warning text-dark rounded-pill">Head</span>
                                    </div>
                                    <small class="text-muted d-block">{{ date('M d, Y', strtotime($users->birthdate)) }}</small>
                                    <small class="text-muted">{{ $users->marital_status ? 'Married' : 'Single' }} • {{ $users->city }}, {{ $users->state }}</small>
                                </div>
                            </div>
                        </div>

                        <!-- Family Members -->
                        <div style="max-height: 500px; overflow-y: auto;">
                            @forelse($members as $member)
                            <div class="p-4 border-bottom">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('uploads/images/' . ($member->photo_path ?: 'noimage.png')) }}" class="rounded-circle me-3" width="60" height="60" style="object-fit: cover;">
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-1">{{ $member->name }}</h6>
                                        <small class="text-muted d-block">{{ date('M d, Y', strtotime($member->birthdate)) }}</small>
                                        <div class="d-flex gap-2 mt-1">
                                            <span class="badge bg-light text-dark rounded-pill">{{ $member->marital_status ? 'Married' : 'Single' }}</span>
                                            @if($member->education)
                                            <span class="badge bg-info rounded-pill">{{ $member->education }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-5">
                                <i class="bi bi-person-plus-fill text-muted" style="font-size: 3rem;"></i>
                                <h6 class="text-muted mt-3">No members added yet</h6>
                                <p class="text-muted small">Add your first family member using the form</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
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
            if (!confirm('Complete registration and logout?')) {
                event.preventDefault();
            }
        });

        function toggleMarriageDate() {
            marriageDateDiv.style.display = marriedRadio.checked ? 'block' : 'none';
        }

        marriedRadio.addEventListener('change', toggleMarriageDate);
        unmarriedRadio.addEventListener('change', toggleMarriageDate);
    });
    </script>
</body>
</html>