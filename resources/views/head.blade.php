<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

@php
        $allSessionData = session()->all();
        $lastMatchingKey = null;
        $session_number = 0;
      
        foreach (array_reverse($allSessionData) as $key => $value) {
            if (str_starts_with($key, 'head_submitted_')) { 
                $lastMatchingKey = $key;
                break; 
            }
        }

        
        if ($lastMatchingKey) {
            $number = preg_replace('/[^0-9]/', '', $lastMatchingKey);
            $session_number = $number;
        }

    @endphp
    @if (@session('head_submitted_'.$session_number))
        <div class="alert alert-danger mt-5 alert-dismissible fade show rounded-pill">
            Your Session Still Exist Complete it  : <a href="{{ 
            route('familySection',$session_number) }}">Click here</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>

@else
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Head Registration - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">
   
    


    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow rounded-4">
                    <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                        <h2 class="mb-0 fw-bold"><i class="bi bi-person-badge me-2"></i>Family Head Registration</h2>
                        <p class="mb-0 mt-2">Please provide the head of family information</p>
                    </div>

                    <div class="card-body p-4">
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show rounded-pill">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show rounded-pill">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        <form action="head" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">First Name</label>
                                    <input type="text" name="name" class="form-control rounded-pill"
                                        placeholder="Enter first name" value="{{ old('name') }}">
                                    @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Last Name</label>
                                    <input type="text" name="surname" class="form-control rounded-pill"
                                        placeholder="Enter last name" value="{{ old('surname') }}">
                                    @error('surname')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Date of Birth</label>
                                    <input type="date" name="birthdate" class="form-control rounded-pill"
                                        value="{{ old('birthdate') }}">
                                    @error('birthdate')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Mobile Number</label>
                                    <input type="tel" name="mobile" class="form-control rounded-pill"
                                        placeholder="Enter mobile number" value="{{ old('mobile') }}">
                                    @error('mobile')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Address</label>
                                <textarea name="address" class="form-control rounded-4" rows="3"
                                    placeholder="Enter complete address">{{ old('address') }}</textarea>
                                @error('address')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">State</label>
                                    <select name="state" id="stateSelect" class="form-select rounded-pill">
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->name }}" data-state-id="{{ $state->id }}" {{ old('state') == $state->name ? 'selected' : '' }}>{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('state')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">City</label>
                                    <select name="city" id="citySelect" class="form-select rounded-pill">
                                        <option value="">Select City</option>

                                    </select>
                                    @error('city')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Pincode</label>
                                    <input type="number" name="pincode" class="form-control rounded-pill"
                                        placeholder="Enter pincode" value="{{ old('pincode') }}">
                                    @error('pincode')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Marital Status</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="marital_status"
                                                id="married" value="1" {{ old('marital_status') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="married">Married</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="marital_status"
                                                id="unmarried" value="0" {{ old('marital_status') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="unmarried">Unmarried</label>
                                        </div>
                                    </div>
                                </div>
                                @error('marital_status')<div class="text-danger">{{ $message }}</div>@enderror

                                <div class="mt-3" id="mrg_date_div"
                                    style="display: {{ old('marital_status') == '1' ? 'block' : 'none' }}">
                                    <label class="form-label fw-semibold" for="mariage_date">Marriage Date</label>
                                    <input type="date" name="mariage_date" id="mariage_date"
                                        class="form-control rounded-pill" value="{{ old('mariage_date') }}">
                                    @error('mariage_date')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="card bg-light mb-4 rounded-4">
                                <div class="card-body">
                                    <h6 class="card-title text-primary fw-semibold mb-3"><i
                                            class="bi bi-star me-2"></i>Hobbies & Interests</h6>
                                    <div id="hobbyContainer">
                                        <input type="text" name="hobbies[]" class="form-control rounded-pill mb-2"
                                            placeholder="Enter hobby">
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="button" id="addHobby" class="btn btn-success btn-sm rounded-pill">
                                            <i class="bi bi-plus-circle me-1"></i>Add
                                        </button>
                                        <button type="button" id="removeHobby"
                                            class="btn btn-danger btn-sm rounded-pill">
                                            <i class="bi bi-dash-circle me-1"></i>Remove
                                        </button>
                                    </div>
                                    @error('hobbies')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Profile Picture</label>
                                <input type="file" name="path" class="form-control rounded-pill" accept="image/*">
                                <div class="form-text">Upload a clear photo (JPG, PNG, max 2MB)</div>
                                @error('path')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill">
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const marriedRadio = document.getElementById('married');
            const unmarriedRadio = document.getElementById('unmarried');
            const marriageDateDiv = document.getElementById('mrg_date_div');
            const hobbyContainer = document.getElementById('hobbyContainer');
            const addHobbyBtn = document.getElementById('addHobby');
            const removeHobbyBtn = document.getElementById('removeHobby');

            function addHobbyInput() {
                const input = document.createElement('input');
                input.type = 'text';
                input.name = 'hobbies[]';
                input.className = 'form-control rounded-pill mb-2';
                input.placeholder = 'Enter hobby';
                hobbyContainer.appendChild(input);
                input.focus();
            }

            function removeHobbyInput() {
                const inputs = hobbyContainer.querySelectorAll('input');
                if (inputs.length > 1) {
                    inputs[inputs.length - 1].remove();
                }
            }

            function toggleMarriageDate() {
                marriageDateDiv.style.display = marriedRadio.checked ? 'block' : 'none';
            }

            marriedRadio.addEventListener('change', toggleMarriageDate);
            unmarriedRadio.addEventListener('change', toggleMarriageDate);
            addHobbyBtn.addEventListener('click', addHobbyInput);
            removeHobbyBtn.addEventListener('click', removeHobbyInput);
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script>

        const oldCity = @json(old('city'));

        jQuery(document).ready(function () {
            jQuery('select[name="state"]').on('change', function () {
                let stateID = jQuery(this).val();
                jQuery.ajax({
                    url: '/get-cities/' + stateID,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        const cityDropdown = jQuery('select[name="city"]');
                        cityDropdown.empty().append('<option value="">Select City</option>');
                        jQuery.each(data, function (key, value) {
                            cityDropdown.append('<option value="' + value.name + '">' + value.name + '</option>');
                        });

                        // Add this logic to check and set the old value
                        if (oldCity) {
                            cityDropdown.val(oldCity);
                        }
                    }
                });
            });
            if (jQuery('select[name="state"]').val()) {
                jQuery('select[name="state"]').trigger('change');
            }
        });
    </script>
</body>

</html>

@endif