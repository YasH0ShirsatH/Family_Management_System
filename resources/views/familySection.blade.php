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
        
        <!-- Logout Button -->
        <div class="text-end mb-4">
            <a href="{{ route('logoutMember',$id) }}" class="btn btn-danger" id="logout">
                <i class="bi bi-box-arrow-right"></i> Complete & Logout
            </a>
        </div>

        <!-- Alerts -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Form and Members Layout -->
        <div class="row">
            <!-- Add Member Form -->
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header bg-success text-white py-3">
                        <h4 class="mb-0 fw-bold"><i class="bi bi-person-plus me-2"></i>Add Family Member</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('addMember',$id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Date of Birth</label>
                                <input type="date" name="birthdate" class="form-control" value="{{ old('birthdate') }}">
                                @error('birthdate')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Marital Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="marital_status" id="married" value="1" {{ old('marital_status') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="married">Married</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="marital_status" id="unmarried" value="0" {{ old('marital_status') == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="unmarried">Unmarried</label>
                                </div>
                                @error('marital_status')<div class="text-danger">{{ $message }}</div>@enderror
                                
                                <div class="mt-3" id="mrg_date_div" style="display: {{ old('marital_status') == '1' ? 'block' : 'none' }}">
                                    <label class="form-label fw-semibold">Marriage Date</label>
                                    <input type="date" name="mariage_date" class="form-control" value="{{ old('mariage_date') }}">
                                    @error('mariage_date')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Education (Optional)</label>
                                <input type="text" name="education" class="form-control" value="{{ old('education') }}">
                                @error('education')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Photo</label>
                                <input type="file" name="photo_path" class="form-control" accept="image/*">
                                @error('photo_path')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                            
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-person-plus me-2"></i>Add Member
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Added Members -->
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header bg-info text-white py-3">
                        <h4 class="mb-0 fw-bold"><i class="bi bi-people me-2"></i>Added Members ({{ $members->count() }})</h4>
                    </div>
                    <div class="card-body p-4" style="max-height: 600px; overflow-y: auto;">
                        @forelse($members as $member)
                        <div class="card mb-3">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        @if($member->photo_path)
                                        <img src="{{ asset('uploads/images/' . $member->photo_path) }}" class="rounded-circle" width="60" height="60" style="object-fit: cover;">
                                        @else
                                        <img src="{{ asset('uploads/images/noimage.png') }}" class="rounded-circle" width="60" height="60" style="object-fit: cover;">
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-1">{{ $member->name }}</h6>
                                        <small class="text-muted">{{ date('M d, Y', strtotime($member->birthdate)) }}</small><br>
                                        <small class="text-muted">{{ $member->marital_status ? 'Married' : 'Single' }}</small>
                                        @if($member->education)
                                        <br><small class="text-muted">{{ $member->education }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4">
                            <i class="bi bi-people display-4 text-muted mb-3"></i>
                            <p class="text-muted">No members added yet</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Family Head Info -->
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0 fw-bold"><i class="bi bi-person-badge me-2"></i>Family Head</h4>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <img src="{{ asset('uploads/images/' . $users->photo_path) }}" class="rounded-circle" width="100" height="100" style="object-fit: cover;">
                        <h5 class="mt-2 fw-bold">{{ $users->name }} {{ $users->surname }}</h5>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-sm-6">
                                <p><strong>Birth Date:</strong> {{ $users->birthdate }}</p>
                                <p><strong>Mobile:</strong> {{ $users->mobile }}</p>
                                <p><strong>Address:</strong> {{ $users->address }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p><strong>Marital Status:</strong> {{ $users->marital_status ? 'Married' : 'Single' }}</p>
                                @if($users->marital_status)
                                <p><strong>Marriage Date:</strong> {{ $users->mariage_date }}</p>
                                @endif
                                <p><strong>Location:</strong> {{ $users->city }}, {{ $users->state }}</p>
                            </div>
                        </div>
                        <p><strong>Hobbies:</strong> 
                            @foreach ($users->hobbies as $hobby)
                            {{ $hobby->hobby_name }}@if(!$loop->last), @endif
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Family Members Full List -->
        <div class="card shadow">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0 fw-bold"><i class="bi bi-people me-2"></i>All Family Members ({{ $members->count() }})</h4>
            </div>
            <div class="card-body p-4">
                @forelse($members as $member)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 text-center">
                                @if($member->photo_path)
                                <img src="{{ asset('uploads/images/' . $member->photo_path) }}" class="rounded-circle" width="80" height="80" style="object-fit: cover;">
                                @else
                                <img src="{{ asset('uploads/images/noimage.png') }}" class="rounded-circle" width="80" height="80" style="object-fit: cover;">
                                @endif
                            </div>
                            <div class="col-md-10">
                                <h5 class="fw-bold">{{ $member->name }}</h5>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p><strong>Birth Date:</strong> {{ date('M d, Y', strtotime($member->birthdate)) }}</p>
                                        <p><strong>Marital Status:</strong> {{ $member->marital_status ? 'Married' : 'Single' }}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        @if($member->marital_status)
                                        <p><strong>Marriage Date:</strong> {{ date('M d, Y', strtotime($member->mariage_date)) }}</p>
                                        @endif
                                        <p><strong>Education:</strong> {{ $member->education ?: 'Not specified' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-4">
                    <i class="bi bi-people text-muted" style="font-size: 3rem;"></i>
                    <h5 class="mt-3">No family members added yet</h5>
                    <p class="text-muted">Add your first family member using the form above.</p>
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