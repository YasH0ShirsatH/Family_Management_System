<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Family Member - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary shadow">
        <div class="container">
            <a class="navbar-brand fs-4 fw-bold">
                <i class="bi bi-house-heart me-2"></i>Family Management System
            </a>
        </div>
    </nav>

    <div class="container py-4">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>({{ session('name') }} {{ session('surname') }}) : {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h2 class="mb-1 fw-bold"><i class="bi bi-person-plus me-2"></i>Add Family Member</h2>
                        <p class="mb-0 opacity-75">Enter members of family (Admin Section)</p>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('adminAddMember',$id) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold"><i class="bi bi-person me-2"></i>Full Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter full name" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold"><i class="bi bi-calendar3 me-2"></i>Date of Birth</label>
                                <input type="date" name="birthdate"
                                    class="form-control @error('birthdate') is-invalid @enderror"
                                    value="{{ old('birthdate') }}">
                                @error('birthdate')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold"><i class="bi bi-heart me-2"></i>Marital Status</label>
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
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror

                                <div class="mt-3" id="mrg_date_div"
                                    style="display: {{ old('marital_status') == '1' ? 'block' : 'none' }}">
                                    <label class="form-label fw-semibold"><i class="bi bi-calendar-heart me-2"></i>Marriage Date</label>
                                    <input type="date" name="mariage_date"
                                        class="form-control @error('mariage_date') is-invalid @enderror"
                                        value="{{ old('mariage_date') }}">
                                    @error('mariage_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold"><i class="bi bi-mortarboard me-2"></i>Education (Optional)</label>
                                <input type="text" name="education"
                                    class="form-control @error('education') is-invalid @enderror"
                                    placeholder="Enter education qualification" value="{{ old('education') }}">
                                @error('education')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold"><i class="bi bi-camera me-2"></i>Photo (Optional)</label>
                                <input type="file" name="photo_path"
                                    class="form-control @error('photo_path') is-invalid @enderror" accept="image/*">
                                <small class="form-text text-muted">Upload a clear photo (JPG, PNG, max 2MB)</small>
                                @error('photo_path')
                                <div class="invalid-feedback">{{ $message }}</div>
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