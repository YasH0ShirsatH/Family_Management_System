<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Head Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>



<body class="bg-light">


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0">Enter the Information of <span class="text-body-emphasis">Head</span> of the
                            family</h2>
                    </div>
                    @if (session('error'))
                    <div class="error alert alert-danger alert-dismissible m-3 fade show" role="alert">
                        {{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="error alert alert-success alert-dismissible m-3 fade show" role="alert">
                        {{ session('success') }}<button type="button" class="btn-close"
                            data-bs-dismiss="alert"></button></div>
                    @endif



                    <div class="card-body">
                        <form action="head" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Surname</label>
                                    <input type="text" name="surname" class="form-control" placeholder="Enter surname"
                                        value="{{ old('surname') }}">
                                    @error('surname')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Birthdate</label>
                                    <input type="date" name="birthdate" class="form-control"
                                        value="{{ old('birthdate') }}">
                                    @error('birthdate')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="number" name="mobile" class="form-control"
                                        placeholder="Enter mobile number" value="{{ old('mobile') }}">
                                    @error('mobile')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control" rows="2"
                                    placeholder="Enter address">{{ old('address') }}</textarea>
                                @error('address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">State</label>
                                    <select name="state" class="form-select">
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
                                    <label class="form-label">City</label>
                                    <select name="city" class="form-select">
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
                                    <label class="form-label">Pincode</label>
                                    <input type="number" name="pincode" class="form-control" placeholder="Enter pincode"
                                        value="{{ old('pincode') }}">
                                    @error('pincode')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
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
                                    <label class="form-label" for="mariage_date">Marriage Date</label>
                                    <input type="date" name="mariage_date" id="mariage_date" class="form-control"
                                        value="{{ old('mariage_date') }}">
                                    @error('mariage_date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="form-controll mb-3">Enter Hobby</label>
                                <input type="text" name="hobbies[]" class="form-control mt-2" placeholder="Enter hobby. Click  ( + Add Hobby ) to add more hobbies">

                                <button type="button" id="addHobbies" class="btn btn-primary btn-sm mt-3"> <i
                                        class="bi bi-plus-circle"></i> Add Hobby</button>
                                <button type="button" id="deleteHobbies" class="btn btn-danger btn-sm mt-3"> <i
                                        class="bi bi-dash-circle"></i> Delete Hobby</button>

                                @error('hobbies')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @foreach ($errors->get('hobbies.*') as $messages)
                                    @foreach ($messages as $msg)
                                        <div class="text-danger">{{ $msg }}</div>
                                        @break
                                    @endforeach
                                    @break
                                @endforeach


                            </div>

                            <div class="mb-3">
                                <label class="form-label">Profile Picture</label>
                                <input type="file" name="path" class="form-control" accept="image/*">
                                @error('path')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
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