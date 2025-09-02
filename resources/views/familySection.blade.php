<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; 
        }
        .card { 
            border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.1); 
        }
        .card-header { 
            background: linear-gradient(135deg, #2c3e50, #34495e); 
        }
        .btn-primary {
             background: linear-gradient(135deg, #667eea, #764ba2); border: none; 
            }
        .btn-primary:hover {
             background: linear-gradient(135deg, #764ba2, #667eea); transform: translateY(-2px); 
            }
        .member-card { 
            transition: transform 0.3s; 
        }
        .member-card:hover { 
            transform: translateY(-5px); 
        }
        .profile-img { 
            width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 4px solid white; 
        }
        .member-img {
             height: 200px; object-fit: cover; 
        }
        .card-img-top{
            height: 250px; object-fit: cover;
        }
        
    </style>
</head>
<body>
    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif



        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white">
                        <h2 class="mb-0"><i class="bi bi-person-plus-fill me-2"></i>Add Family Member</h2>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('addMember',$id) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-bold"><i class="bi bi-person me-1"></i>Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Birthdate</label>
                                <input type="date" name="birthdate" class="form-control" value="{{ old('birthdate') }}">
                                @error('birthdate')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Marital Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="marital_status" id="married"
                                        value="1" {{ old('marital_status') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="married">Married</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="marital_status" id="unmarried"
                                        value="0" {{ old('marital_status') == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="unmarried">Unmarried</label>
                                </div>
                                @error('marital_status')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <div class="mt-3" id="mrg_date_div"
                                    style="display: {{ old('marital_status') == '1' ? 'block' : 'none' }}">
                                    <label class="form-label">Marriage Date</label>
                                    <input type="date" name="mariage_date" class="form-control"
                                        value="{{ old('mariage_date') }}">
                                    @error('mariage_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Education (Optional)</label>
                                <input type="text" name="education" class="form-control" placeholder="Enter education"
                                    value="{{ old('education') }}">
                                @error('education')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Photo</label>
                                <input type="file" name="photo_path" class="form-control" accept="image/*">
                                @error('photo_path')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-plus-circle me-2"></i>Add Member</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h2 class="">Head Information</h2>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset('uploads/images/' . $users->photo_path) }}" class="rounded-circle border border-3 mb-3" style="width: 120px; height: 120px; object-fit: cover;" alt="Member Photo">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <ul class="list-group list-group-flush text-start">
                                    <li class="list-group-item"><strong>Name:</strong> {{ ucfirst($users->name) }}</li>
                                    <li class="list-group-item"><strong>Birthdate:</strong> {{ ucfirst($users->birthdate) }}</li>
                                    <li class="list-group-item"><strong>Marital Status:</strong> {{ $users->marital_status ? 'Married' : 'Unmarried' }}</li>
                                    @if($users->marital_status)
                                        <li class="list-group-item"><strong>Marriage Date:</strong> {{ $users->mariage_date }}</li>
                                    @endif
                                    <li class="list-group-item"><strong>Mobile:</strong> {{ $users->mobile }}</li>
                                    <li class="list-group-item"><strong>Address:</strong> {{ ucfirst($users->address) }}</li>
                                    <li class="list-group-item"><strong>State:</strong> {{ ucfirst($users->state) }}</li>
                                    <li class="list-group-item"><strong>City:</strong> {{ ucfirst($users->city )}}</li>
                                    <li class="list-group-item"><strong>Pin Code:</strong> {{ $users->pincode }}</li>
                                    <li class="list-group-item"><strong>Hobbies:</strong> {{ ucfirst($users->hobbies) }}</li>
                                    <div class="d-grid">
                                <a href="" class="btn btn-danger btn-lg"><i class="bi bi-dash-circle me-2"></i>Log Out</a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5 mt-5 justify-content-center">
        @if(@empty($members))
        <p class="text-danger">No family members added yet.</p>
        @else
        
        <h3 class="row mb-0 pt-2 pb-2 px-2 text-white rounded-top bg-primary">Family Members</h3>
        <div class="row  justify-content-center align-items-center bg-light p-4 rounded-bottom">
            @foreach($members as $member)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('uploads/images/' . $member->photo_path) }}" class="card-img-top"
                        alt="Member Photo">
                    <div class="card-body">
                        <h5 class="card-title">{{ $member->name }}</h5>
                        <p class="card-text"><strong>Birthdate:</strong> {{ $member->  birthdate }}</p>
                        <p class="card-text"><strong>Marital Status:</strong>
                            {{ $member->marital_status ? 'Married' : 'Unmarried' }}</p>
                        @if($member->marital_status)
                        <p class="card-text"><strong>Marriage Date:</strong> {{ $member->mariage_date }}</p>
                        @else
                        <p><strong>Marriage Date</strong> : <span class="text-danger">Not Applicable</span></p>
                        @endif
                        @if($member->education)
                        <p class="card-text"><strong>Education:</strong> {{ $member->education }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const marriedRadio = document.getElementById('married');
        const unmarriedRadio = document.getElementById('unmarried');
        const marriageDateDiv = document.getElementById('mrg_date_div');

        function toggleMarriageDate() {
            if (marriedRadio.checked) {
                marriageDateDiv.style.display = 'block';
            } else {
                marriageDateDiv.style.display = 'none';
            }
        }

        marriedRadio.addEventListener('change', toggleMarriageDate);
        unmarriedRadio.addEventListener('change', toggleMarriageDate);
    });
    </script>
</body>

</html>