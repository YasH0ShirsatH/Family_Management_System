<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Head Registration - Family Management System</title>
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
    }

    .card-header-custom {
        background: linear-gradient(135deg, var(--primary-color) 0%, #1d4ed8 100%);
        color: white;
        padding: 2.5rem;
        text-align: center;
        border: none;
    }

    .card-header-custom h2 {
        font-size: 1.75rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
    }

    .card-body-custom {
        padding: 3rem;
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
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary {
        background: var(--primary-color);
        border: none;
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .btn-primary:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
    }

    .btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
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

    .section-divider {
        border-top: 2px solid var(--border-color);
        margin: 2rem 0;
        position: relative;
    }

    .section-divider::after {
        content: '';
        position: absolute;
        top: -1px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 2px;
        background: var(--primary-color);
    }

    .hobby-section {
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.5rem;
        border: 1px solid var(--border-color);
    }

    .hobby-section h6 {
        color: var(--primary-color);
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .btn-success {
        background: var(--success-color);
        border: none;
    }

    .btn-success:hover {
        background: #047857;
    }

    .btn-danger {
        background: var(--danger-color);
        border: none;
    }

    .btn-danger:hover {
        background: #b91c1c;
    }
    </style>
</head>

<body>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="main-card">
                    <div class="card-header-custom">
                        <h2><i class="bi bi-person-badge"></i> Family Head Registration</h2>
                        <p class="mb-0 mt-2 opacity-90">Please provide the head of family information</p>
                    </div>

                    <div class="card-body-custom">
                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif
                        <form action="head" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="bi bi-person"></i> First Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter first name"
                                        value="{{ old('name') }}" >
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="bi bi-person"></i> Last Name</label>
                                    <input type="text" name="surname" class="form-control" placeholder="Enter last name"
                                        value="{{ old('surname') }}" >
                                    @error('surname')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="bi bi-calendar3"></i> Date of Birth</label>
                                    <input type="date" name="birthdate" class="form-control"
                                        value="{{ old('birthdate') }}" >
                                    @error('birthdate')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="bi bi-telephone"></i> Mobile Number</label>
                                    <input type="tel" name="mobile" class="form-control"
                                        placeholder="Enter mobile number" value="{{ old('mobile') }}" >
                                    @error('mobile')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><i class="bi bi-geo-alt"></i> Address</label>
                                <textarea name="address" class="form-control" rows="3"
                                    placeholder="Enter complete address" >{{ old('address') }}</textarea>
                                @error('address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label"><i class="bi bi-map"></i> State</label>
                                    <select name="state" class="form-select" >
                                        <option value="">Select State</option>
                                        <option value="maharashtra"
                                            {{ old('state') == 'maharashtra' ? 'selected' : '' }}>Maharashtra</option>
                                        <option value="Uttar Pradesh"
                                            {{ old('state') == 'Uttar Pradesh' ? 'selected' : '' }}>Uttar Pradesh
                                        </option>
                                        <option value="Tamil Nadu" {{ old('state') == 'Tamil Nadu' ? 'selected' : '' }}>
                                            Tamil Nadu</option>
                                    </select>
                                    @error('state')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label"><i class="bi bi-building"></i> City</label>
                                    <select name="city" class="form-select" >
                                        <option value="">Select City</option>
                                        <option value="nashik" {{ old('city') == 'nashik' ? 'selected' : '' }}>Nashik
                                        </option>
                                        <option value="pune" {{ old('city') == 'pune' ? 'selected' : '' }}>Pune</option>
                                        <option value="mumbai" {{ old('city') == 'mumbai' ? 'selected' : '' }}>Mumbai
                                        </option>
                                    </select>
                                    @error('city')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label"><i class="bi bi-mailbox"></i> Pincode</label>
                                    <input type="number" name="pincode" class="form-control" placeholder="Enter pincode"
                                        value="{{ old('pincode') }}" >
                                    @error('pincode')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="section-divider"></div>

                            <div class="mb-4">
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
                                    <label class="form-label" for="mariage_date"><i class="bi bi-calendar-heart"></i>
                                        Marriage Date</label>
                                    <input type="date" name="mariage_date" id="mariage_date" class="form-control"
                                        value="{{ old('mariage_date') }}">
                                    @error('mariage_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="hobby-section mb-4">
                                <h6><i class="bi bi-star"></i> Hobbies & Interests</h6>
                                <input type="text" name="hobbies[]" class="form-control mb-3"
                                    placeholder="Enter hobby or interest">

                                <div class="d-flex gap-2">
                                    <button type="button" id="addHobbies" class="btn btn-success btn-sm">
                                        <i class="bi bi-plus-circle"></i> Add Hobby
                                    </button>
                                    <button type="button" id="deleteHobbies" class="btn btn-danger btn-sm">
                                        <i class="bi bi-dash-circle"></i> Remove Last
                                    </button>
                                </div>

                                @error('hobbies')
                                <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                                @foreach ($errors->get('hobbies.*') as $messages)
                                @foreach ($messages as $msg)
                                <div class="text-danger mt-2">{{ $msg }}</div>
                                @break
                                @endforeach
                                @break
                                @endforeach
                            </div>

                            <div class="mb-4">
                                <label class="form-label"><i class="bi bi-camera"></i> Profile Picture</label>
                                <input type="file" name="path" class="form-control" accept="image/*" >
                                <small class="text-muted">Upload a clear photo (JPG, PNG, max 2MB)</small>
                                @error('path')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-check-circle me-2"></i>Register family head and go to add members
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const marriedRadio = document.getElementById('married');
    const unmarriedRadio = document.getElementById('unmarried');
    const marriageDateDiv = document.getElementById('mrg_date_div');
    const addHobbyBtn = document.getElementById('addHobbies');

    function createHobby() {
        const hobbyInput = document.createElement('input');
        hobbyInput.type = 'text';
        hobbyInput.name = 'hobbies[]';
        hobbyInput.className = 'form-control mt-2';
        hobbyInput.placeholder = 'Enter hobbies';
        document.getElementById('addHobbies').before(hobbyInput);
        hobbyInput.focus();
    }



    function deleteHobby() {
        const hobbyInputs = document.getElementsByName('hobbies[]');
        if (hobbyInputs.length > 1) {
            hobbyInputs[hobbyInputs.length - 1].remove();
        }
    }

    function toggleMarriageDate() {
        if (marriedRadio.checked) {
            marriageDateDiv.style.display = 'block';
        } else {
            marriageDateDiv.style.display = 'none';
        }
    }

    marriedRadio.addEventListener('change', toggleMarriageDate);
    unmarriedRadio.addEventListener('change', toggleMarriageDate);
    addHobbyBtn.addEventListener('click', createHobby);
    document.getElementById('deleteHobbies').addEventListener('click', deleteHobby);
});
</script>

</html>