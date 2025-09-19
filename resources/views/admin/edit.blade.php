<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Family Head - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/heading.css')  }}">

     <style>
        .active-class-2{
            background-color: #198754;
            color : white;
            transform: translateX(5px);
        }
    </style>

</head>
<style>
#uploadPhoto {
    display: none;
}
</style>
<style>
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
    border-color: #dc3545;
    background-color: #fff0f0;
}
</style>



<body class="bg-light">

    <div id="mainContent">

        <div style="padding-bottom : 10px;z-index:100">
            @include('partials.navbar2',['shouldShowDiv' => true])
        </div>
        <div class="text-center mb-4 mt-4">
            <a href="{{ route('admin.index') }}" class="btn btn-outline-primary rounded-pill">
                <i class="bi bi-arrow-left me-2"></i>Back to Manage Families
            </a>
        </div>
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow rounded-4">
                        <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                            <h2 class="mb-0 fw-bold"><i class="bi bi-person-badge me-2"></i>Edit Family Head</h2>
                            <p class="mb-0 mt-2">Update family head information</p>
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

                            <form action="{{ route('admin.update',$id) }}" id="formSubmit" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label fw-semibold">First Name</label>
                                        <input type="text" name="name" class="form-control rounded-pill"
                                            value="{{ $head->name }}" required>
                                        <div class="validation-error"></div>
                                        @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label fw-semibold">Last Name</label>
                                        <input type="text" name="surname" class="form-control rounded-pill"
                                            value="{{ $head->surname }}" required>
                                        <div class="validation-error"></div>
                                        @error('surname')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label fw-semibold">Date of Birth</label>
                                        <input type="date" name="birthdate" class="form-control rounded-pill"
                                            value="{{ $head->birthdate}}" required>
                                        <div class="validation-error"></div>
                                        @error('birthdate')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label fw-semibold">Mobile Number</label>
                                        <input type="tel" name="mobile" class="form-control rounded-pill"
                                            value="{{ $head->mobile }}" required>
                                        <div class="validation-error"></div>
                                        @error('mobile')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="mb-3 form-group">
                                    <label class="form-label fw-semibold">Address</label>
                                    <textarea name="address" class="form-control rounded-4" rows="3"
                                        required>{{ $head->address }}</textarea>
                                    <div class="validation-error"></div>
                                    @error('address')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3 form-group">
                                        <label class="form-label fw-semibold">State</label>
                                        <div class="validation-error"></div>
                                        <select name="state" id="stateSelect" class="form-select rounded-pill">
                                            <option value="">Select State</option>
                                            @foreach ($states as $state)
                                            <option value="{{ $state->name }}"
                                                {{ $head->state == $state->name ? 'selected' : '' }}>{{ $state->name }}
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
                                            @foreach ($city as $cities)
                                            <option value="{{ $cities->name }}"
                                                {{ $head->city == $cities->name ? 'selected' : '' }}>{{ $cities->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('city')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-4 mb-3 form-group">
                                        <label class="form-label fw-semibold">Pincode</label>
                                        <div class="validation-error"></div>
                                        <input type="number" name="pincode" class="form-control rounded-pill"
                                            value="{{ $head->pincode }}" required>
                                        @error('pincode')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="mb-3 form-group">
                                    <label class="form-label fw-semibold">Marital Status</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="marital_status"
                                                    id="married" value="1"
                                                    {{ $head->marital_status == '1' ? 'checked' : ''}}>
                                                <label class="form-check-label" for="married">Married</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="marital_status"
                                                    id="unmarried" value="0"
                                                    {{ $head->marital_status == '0' ? 'checked' : ''}}>
                                                <label class="form-check-label" for="unmarried">Unmarried</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="validation-error"></div>
                                    @error('marital_status')<div class="text-danger">{{ $message }}</div>@enderror

                                    <div class="mt-3 form-group" id="mrg_date_div"
                                        style="display: {{ $head->marital_status == '1' ? 'block' : 'none' }}">
                                        <label class="form-label fw-semibold">Marriage Date</label>
                                        <input type="date" name="mariage_date" class="form-control rounded-pill"
                                            value="{{ $head->mariage_date }}" @error('mariage_date')<div
                                            class="text-danger">{{ $message }}
                                    </div>@enderror
                                    <div class="validation-error"></div>
                                </div>
                        </div>

                        <!-- Hobby Section -->
                        <div class="card bg-light mb-4 mx-3 mt-4 rounded-4">
                            <div class="card-body  form-group">
                                <h6 class="card-title text-primary fw-semibold"><i class="bi bi-star me-2"></i>Hobbies &
                                    Interests</h6>
                                <div id="hobbyContainer">
                                    @foreach ($head->hobbies as $hobby)
                                    <input type="text" name="hobbies[]" value="{{ $hobby->hobby_name }}"
                                        class="form-control rounded-pill mb-2 hobby-input" placeholder="Enter hobby">
                                    @endforeach
                                </div>
                                <div class="d-flex gap-2">
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
                        </div>
                        <div class="mb-3 mx-3" id="photoSection">
                            <div
                                class="d-flex align-items-center justify-content-between p-2 bg-light rounded-3 border">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-camera text-primary me-2"></i>
                                    <span class="fw-semibold">Update Photo?</span>
                                </div>
                                <button type="button" id="addphoto" class="btn btn-primary btn-sm rounded-pill">
                                    <i class="bi bi-upload me-1"></i>Yes
                                </button>
                            </div>
                        </div>

                        <div class="mb-3 mx-3 form-group" id="uploadPhoto" style="display: none;">
                            <div class="p-2 bg-light rounded-3 border">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label fw-semibold mb-0">Profile Picture</label>
                                    <button type="button" id="removephoto"
                                        class="btn btn-outline-secondary btn-sm rounded-pill">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>

                                <div class="d-flex align-items-center gap-2">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('/uploads/images/').'/'.$head->photo_path }}" alt="Current"
                                            class="rounded-circle"
                                            style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #007bff;">
                                    </div>
                                    <div class="flex-grow-1">
                                        <input type="file" name="path" class="form-control form-control-sm rounded-pill"
                                            accept="image/*">
                                        <small class="text-muted">JPG, PNG, max 2MB</small>
                                        <div class="validation-error"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('path')<div class="text-danger">{{ $message }}</div>@enderror



                        <button type="submit" class="btn mb-5 py-3  mx-auto btn-primary rounded-pill"
                            style="width : 80%">
                            <i class="bi bi-check-circle me-2"></i>Update Family Head
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Section -->
        <div class="row justify-content-center mt-4 mb-4">
            <div class="col-lg-6">
                <div class="card border-danger shadow rounded-4">
                    <div class="card-header bg-danger text-white py-3 rounded-top-4">
                        <h5 class="mb-0 fw-bold">Danger Zone: Delete family head and all members</h5>
                    </div>
                    <div class="card-body text-center p-4">
                        <a href="{{ route('delete',$head->id) }}" class="btn btn-danger rounded-pill" id="deleteBtn">
                            <i class="bi bi-trash me-2"></i>Delete Head
                        </a>
                        </form>
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
        const hobbyContainer = document.getElementById('hobbyContainer');
        const addHobbyBtn = document.getElementById('addHobby');
        const removeHobbyBtn = document.getElementById('removeHobby');
        const deleteButton = document.getElementById('deleteBtn');
        const addphoto = document.getElementById('addphoto');
        const removephoto = document.getElementById('removephoto');
        const photoSection = document.getElementById('photoSection');


        if (addphoto) {
            addphoto.addEventListener('click', function(event) {
                const uploadPhoto = document.getElementById('uploadPhoto');
                if (uploadPhoto) {
                    uploadPhoto.style.display = 'block';
                    photoSection.style.display = 'none';
                }
            });
        }
        if (removephoto) {
            removephoto.addEventListener('click', function(event) {
                const uploadPhoto = document.getElementById('uploadPhoto');
                if (uploadPhoto) {
                    uploadPhoto.style.display = 'none';
                    photoSection.style.display = 'block';
                }
            });
        }


        if (deleteButton) {
            deleteButton.addEventListener('click', function(event) {
                if (!confirm(
                        'WARNING: This will permanently delete the head and ALL family members! This action cannot be undone. Are you sure?'
                    )) {
                    event.preventDefault();
                }
            });
        }

        function addHobbyInput() {
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'hobbies[]';
            // This is the line to change
            input.className = 'form-control rounded-pill mb-2 hobby-input'; // Add the 'hobby-input' class
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
    jQuery(document).ready(function() {
        jQuery('select[name="state"]').on('change', function() {
            let stateID = jQuery(this).val();

            jQuery.ajax({
                url: '/get-cities/' + stateID,
                type: "GET",
                dataType: "json",
                success: function(data) {

                    jQuery('select[name="city"]').empty();
                    jQuery.each(data, function(key, value) {
                        $('select[name="city"]').append('<option value="' + value
                            .name + '">' + value.name + '</option>');
                    });
                }
            });
        });
    });
    </script>


    <script>
    jQuery(document).ready(function() {
        $.validator.addMethod("maxfilesize", function(value, element, param) {
            if (element.files && element.files.length > 0) {
                var fileSize = element.files[0].size;
                var maxSizeBytes = param * 1024 * 1024;
                return fileSize <= maxSizeBytes;
            }
            return true;
        }, "File size must be less than 2 MB.");

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
                path: {
                    extension: "jpg|jpeg|png",
                    maxfilesize: 2
                },
                name: {
                    required: true
                },
                surname: {
                    required: true
                },
                birthdate: {
                    required: true,
                    ageAbove21: true
                },
                mobile: {
                    required: true,
                    rangelength: [10, 10]
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
                    rangelength: [6, 6]
                },
                marital_status: {
                    required: true
                },
                mariage_date: {
                    required: function() {
                        return $("#married").is(":checked");
                    }
                },
                // Corrected rule for hobbies
                'hobbies[]': {
                    require_from_group: [1, ".hobby-input"]
                }
            },
            messages: {
                path: {
                    extension: "Only JPG, JPEG, and PNG files are allowed.",
                    maxfilesize: "File size must be less than 2 MB."
                },
                name: {
                    required: "Please enter your first name"
                },
                surname: {
                    required: "Please enter your last name"
                },
                birthdate: {
                    required: "Please enter your date of birth",
                    ageAbove21: "You must be at least 21 years old to proceed."
                },
                mobile: {
                    required: "Please enter your mobile number",
                    rangelength: "Mobile number must be 10 digits"
                },
                address: {
                    required: "Please enter your address"
                },
                state: {
                    required: "Please select a state"
                },
                city: {
                    required: "Please select a city"
                },
                pincode: {
                    required: "Please enter your pincode",
                    rangelength: "Pincode must be 6 digits"
                },
                marital_status: {
                    required: "Please select your marital status"
                },
                mariage_date: {
                    required: "Please enter your marriage date"
                },
                // Corrected message for hobbies
                'hobbies[]': {
                    require_from_group: "Please enter at least one hobby"
                }
            },
           
            groups: {
                hobbies: "hobbies[]"
            },
            errorPlacement: function(error, element) {
                var $container;
               
                if (element.attr("name") === "hobbies[]") {
                    $container = element.closest('.form-group').find('.validation-error');
                } else {
                    $container = element.closest('.form-group').find('.validation-error');
                }

                if ($container.length) {
                    $container.html(error);
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element) {
                $(element).addClass('error');
            },
            unhighlight: function(element) {
                $(element).removeClass('error');
               
                if ($(element).attr("name") === "hobbies[]") {
                    $('.hobby-input').removeClass('error');
                }
                $(element).closest('.form-group').find('.validation-error').empty();
            }
        });
    });
    </script>
</body>

</html>