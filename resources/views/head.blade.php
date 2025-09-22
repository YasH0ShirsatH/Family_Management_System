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
@if (@session('head_submitted_' . $session_number))
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Session</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    .prevent-select {
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    </style>
</head>

<body>

    <div class="vh-100 d-flex justify-content-center align-items-center bg-body-secondary">

        <div class="col-md-9 col-lg-7 col-xl-5">

            <div class="card shadow-sm border-0 rounded-5">
                <div class="card-body text-center p-5">

                    <i class="bi bi-shield-lock-fill text-primary" style="font-size: 4rem;"></i>

                    <h2 class="display-6 fw-light mt-4">Resume Your Session</h2>

                    <p class="lead text-muted my-4">
                        To protect your information and continue your progress, please click the button below.
                    </p>

                    <a href="{{ route('familySection', $session_number) }}"
                        class="btn btn-primary btn-lg rounded-pill px-5">
                        Continue Session
                    </a>

                    <div class="mt-5">

                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

@else
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Head Registration - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    /* Add this to your <style> section */
    .validation-error {
        color: #dc3545;
        font-size: 14px;
        margin-top: 4px;
        font-weight: 500;
        padding-left: 2px;
        min-height: 18px;
        transition: all 0.2s;
    }

    input.error,
    select.error,
    textarea.error {
        border-color: #dc3545 !important;
        background-color: #fff0f0;
    }
    </style>
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
                        <div class="alert alert-danger mt-2 alert-dismissible fade show rounded-pill">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif
                        @if (session('success'))
                        <div class="alert alert-success mt-2 alert-dismissible fade show rounded-pill">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif
                        <form action="head" id="formSubmit" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3 form-group">
                                    <label class="form-label fw-semibold">First Name</label>
                                    <input type="text" name="name" class="form-control rounded-pill optional-field"
                                        placeholder="Enter first name" value="{{ old('name') }}" required>
                                    <div class="validation-error"></div>
                                    @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3 form-group">
                                    <label class="form-label fw-semibold">Last Name</label>
                                    <input type="text" name="surname" class="form-control rounded-pill"
                                        placeholder="Enter last name" value="{{ old('surname') }}" required>
                                    <div class="validation-error"></div>
                                    @error('surname')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3 form-group">
                                    <label class="form-label fw-semibold">Date of Birth</label>
                                    <input type="date" name="birthdate" class="form-control rounded-pill"
                                        value="{{ old('birthdate') }}">
                                    <div class="validation-error"></div>
                                    @error('birthdate')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3 form-group">
                                    <label class="form-label fw-semibold">Mobile Number</label>
                                    <input type="text"  maxlength="10"  name="mobile" class="form-control rounded-pill"
                                        placeholder="Enter mobile number" value="{{ old('mobile') }}">
                                    <div class="validation-error"></div>
                                    @error('mobile')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="mb-3 form-group">
                                <label class="form-label fw-semibold">Address</label>
                                <textarea name="address" class="form-control rounded-4" rows="3"
                                    placeholder="Enter complete address">{{ old('address') }}</textarea>
                                <div class="validation-error"></div>
                                @error('address')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>

                            <div class="row form-group">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">State</label>
                                    <div class="validation-error"></div>
                                    <select name="state" id="stateSelect" class="form-select rounded-pill">
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                        <option value="{{ $state->name }}" data-state-id="{{ $state->id }}"
                                            {{ old('state') == $state->name ? 'selected' : '' }}>{{ $state->name }}
                                        </option>
                                        @endforeach
                                    </select>

                                    @error('state')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-4 mb-3 form-group">
                                    <label class="form-label fw-semibold">City</label>
                                    <div class="validation-error"></div>
                                    <select name="city" id="citySelect" class="form-select rounded-pill">
                                        <option value="">Select City</option>

                                    </select>

                                    @error('city')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-4 mb-3 form-group">
                                    <label class="form-label fw-semibold">Pincode</label>
                                    <div class="validation-error"></div>
                                    <input type="text"  maxlength="6"  name="pincode" class="form-control rounded-pill"
                                        placeholder="Enter pincode" value="{{ old('pincode') }}">

                                    @error('pincode')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="mb-4 ">
                                <label class="form-label fw-semibold">Marital Status</label>
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input " type="radio" name="marital_status"
                                                id="married" value="1"
                                                {{ old('marital_status') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label prevent-select" for="married">Married</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="marital_status"
                                                id="unmarried" value="0"
                                                {{ old('marital_status') == '0' ? 'checked' : '' }}>
                                            <label class="form-check-label  prevent-select" for="unmarried">Unmarried</label>
                                        </div>
                                    </div>
                                    <div class="validation-error"></div>
                                </div>

                                @error('marital_status')<div class="text-danger">{{ $message }}</div>@enderror

                                <div class="mt-3 form-group" id="mrg_date_div"
                                    style="display: {{ old('marital_status') == '1' ? 'block' : 'none' }}">
                                    <label class="form-label fw-semibold" for="mariage_date">Marriage Date</label>
                                    <input type="date" name="mariage_date" id="mariage_date"
                                        class="form-control rounded-pill" value="{{ old('mariage_date') }}">
                                    <div class="validation-error"></div>
                                    @error('mariage_date')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="card-body form-group">
                                <h6 class="card-title text-primary fw-semibold mb-3"><i
                                        class="bi bi-star me-2"></i>Hobbies & Interests</h6>
                                <div id="hobbyContainer">
                                    @php $oldHobbies = old('hobbies', ['']); @endphp
                                    @foreach($oldHobbies as $hobby)
                                    <input type="text" name="hobbies[]" class="form-control rounded-pill mb-2"
                                        placeholder="Enter hobby" value="{{ $hobby }}">
                                    @endforeach
                                </div>
                                <div class="d-flex gap-2 form-group">
                                    <button type="button" id="addHobby" class="btn btn-success btn-sm rounded-pill">
                                        <i class="bi bi-plus-circle me-1"></i>Add
                                    </button>
                                    <button type="button" id="removeHobby" class="btn btn-danger btn-sm rounded-pill">
                                        <i class="bi bi-dash-circle me-1"></i>Remove
                                    </button>
                                </div>
                                <div class="validation-error"></div>
                                @error('hobbies')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4 form-group">
                                <label class="form-label fw-semibold">Profile Picture</label>
                                <input type="file" name="path" class="form-control rounded-pill" accept="image/*">
                                <div class="form-text">Upload a clear photo (JPG, PNG, max 2MB)</div>
                                <div class="validation-error"></div>
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
    document.addEventListener('DOMContentLoaded', function() {
        const marriedRadio = document.getElementById('married');
        const unmarriedRadio = document.getElementById('unmarried');
        const marriageDateDiv = document.getElementById('mrg_date_div');
        const hobbyContainer = document.getElementById('hobbyContainer');
        const addHobbyBtn = document.getElementById('addHobby');
        const removeHobbyBtn = document.getElementById('removeHobby');
        const optionalFields = document.getElementsByClassName('optional-field');

        for (let i = 0; i < optionalFields.length; i++) {
            optionalFields[i].removeAttribute('required');
        }

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

    jQuery(document).ready(function() {
        jQuery('select[name="state"]').on('change', function() {
            let stateID = jQuery(this).val();
            jQuery.ajax({
                url: '/get-cities/' + stateID,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    const cityDropdown = jQuery('select[name="city"]');
                    cityDropdown.empty().append('<option value="">Select City</option>');
                    jQuery.each(data, function(key, value) {
                        cityDropdown.append('<option value="' + value.name + '">' +
                            value.name + '</option>');
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
    <script>
    jQuery(document).ready(function() {
        $.validator.addMethod("maxfilesize", function(value, element, param) {
            if (element.files && element.files.length > 0) {
                var fileSize = element.files[0].size;
                var maxSizeBytes = param * 1024 * 1024;
                return fileSize <= maxSizeBytes;
            }
            return true;
        }, "File size exceeds the allowed limit.");

        $.validator.addMethod("ageAbove21", function(value, element) {
            if (!value) return true;
            var dob = new Date(value);
            var today = new Date();
            var age = today.getFullYear() - dob.getFullYear();
            var m = today.getMonth() - dob.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) age--;
            return age >= 21;
        }, "You must be at least 21 years old.");

        $('#formSubmit').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                surname: {
                    required: true,
                    minlength: 3
                },
                birthdate: {
                    required: true,
                    ageAbove21: true
                },
                mobile: {
                    required: true,
                    rangelength: [10, 10],
                    number : true
                },
                address: {
                    required: true
                },
                state: {
                    required: true
                },
                city: {
                    required: true
                },
                pincode: {
                    required: true,
                    rangelength: [6, 6],
                    number : true
                },
                marital_status: {
                    required: true
                },
                mariage_date: {
                    required: {
                        depends: function(element) {
                            return $("#married").is(":checked");
                        }
                    }
                },
                'hobbies[]': {
                    required: true
                },
                path: {
                    required: true,
                    extension: "jpg|jpeg|png",
                    maxfilesize: 2
                }
            },
            messages: {
                name: {
                    required: "Please enter name"
                },
                surname: {
                    required: "Please enter surname"
                },
                birthdate: {
                    required: "Please enter birthdate",
                    ageAbove21: "You must be at least 21 years old to proceed."
                },
                mobile: {
                    required: "Please enter mobile",
                    rangelength: "Mobile must be 10 digits",
                    number : "Please enter valid 10 digit mobile (number)",
                },
                address: {
                    required: "Please enter address"
                },
                state: {
                    required: "Please select state"
                },
                city: {
                    required: "Please select city"
                },
                pincode: {
                    required: "Please enter Pincode",
                    rangelength: "Pincode must be 6 digits",
                    number : "Please enter valid 6 number pincode",

                },
                marital_status: {
                    required: "Please select marital status"
                },
                mariage_date: {
                    required: "Please enter marriage date"
                },
                'hobbies[]': {
                    required: "Please enter at least one hobby"
                },
                path: {
                    required: "Please upload profile picture",
                    extension: "Please upload a valid image (jpg, jpeg, png)",
                    maxfilesize: "Please upload image less than 2MB"
                }
            },
            errorPlacement: function(error, element) {
                var $container = element.closest('.form-group').find('.validation-error');
                $container.html(error);
            },
            highlight: function(element) {
                $(element).addClass('error');
            },
            unhighlight: function(element) {
                $(element).removeClass('error');
                $(element).closest('.form-group').find('.validation-error').empty();
            }
        });
    });
    </script>








</body>

</html>

@endif
