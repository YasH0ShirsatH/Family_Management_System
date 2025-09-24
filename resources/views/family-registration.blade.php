<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Registration - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
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
            border-color: #dc3545 !important;
            background-color: #fff0f0;
        }

        .member-card {
            border: 2px dashed #dee2e6;
            transition: all 0.3s ease;
        }

        .member-card:hover {
            border-color: #0d6efd;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow rounded-4">
                    <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                        <h2 class="mb-0 fw-bold"><i class="bi bi-people-fill me-2"></i>Complete Family Registration</h2>
                        <p class="mb-0 mt-2">Register family head and add members in one go</p>
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

                        <form action="{{ route('family.store') }}" id="formSubmit" method="post" enctype="multipart/form-data">
                            @csrf

                            <!-- Head Information Section -->
                            <div class="card mb-4 border-primary">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="bi bi-person-badge me-2"></i>Family Head Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            <label class="form-label fw-semibold">First Name</label>
                                            <input type="text" name="head_name" class="form-control rounded-pill" placeholder="Enter first name" value="{{ old('head_name') }}">
                                            <div class="validation-error"></div>
                                            @error('head_name')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-6 mb-3 form-group">
                                            <label class="form-label fw-semibold">Last Name</label>
                                            <input type="text" name="head_surname" class="form-control rounded-pill" placeholder="Enter last name" value="{{ old('head_surname') }}">
                                            <div class="validation-error"></div>
                                            @error('head_surname')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            <label class="form-label fw-semibold">Date of Birth</label>
                                            <input type="date" id="dobField" name="head_birthdate" class="form-control rounded-pill" value="{{ old('head_birthdate') }}">
                                            <div class="validation-error"></div>
                                            @error('head_birthdate')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-6 mb-3 form-group">
                                            <label class="form-label fw-semibold">Mobile Number</label>
                                            <input type="text" maxlength="10" name="head_mobile" class="form-control rounded-pill" placeholder="Enter mobile number" value="{{ old('head_mobile') }}">
                                            <div class="validation-error"></div>
                                            @error('head_mobile')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 form-group">
                                        <label class="form-label fw-semibold">Address</label>
                                        <textarea name="head_address" class="form-control rounded-4" rows="3" placeholder="Enter complete address">{{ old('head_address') }}</textarea>
                                        <div class="validation-error"></div>
                                        @error('head_address')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3 form-group">
                                            <label class="form-label fw-semibold">State</label>
                                            <select name="head_state" id="stateSelect" class="form-select rounded-pill">
                                                <option value="">Select State</option>
                                                @foreach ($states as $state)
                                                <option value="{{ $state->name }}" data-state-id="{{ $state->id }}" {{ old('head_state') == $state->name ? 'selected' : '' }}>{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="validation-error"></div>
                                            @error('head_state')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-4 mb-3 form-group">
                                            <label class="form-label fw-semibold">City</label>
                                            <select name="head_city" id="citySelect" class="form-select rounded-pill">
                                                <option value="">Select City</option>
                                            </select>
                                            <div class="validation-error"></div>
                                            @error('head_city')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="col-md-4 mb-3 form-group">
                                            <label class="form-label fw-semibold">Pincode</label>
                                            <input type="text" maxlength="6" name="head_pincode" class="form-control rounded-pill" placeholder="Enter pincode" value="{{ old('head_pincode') }}">
                                            <div class="validation-error"></div>
                                            @error('head_pincode')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 form-group">
                                        <label class="form-label fw-semibold">Marital Status</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="head_marital_status" id="head_married" value="1" {{ old('head_marital_status') == '1' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="head_married">Married</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="head_marital_status" id="head_unmarried" value="0" {{ old('head_marital_status') == '0' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="head_unmarried">Unmarried</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="validation-error"></div>
                                        @error('head_marital_status')<div class="text-danger">{{ $message }}</div>@enderror

                                        <div class="mt-3 form-group" id="head_mrg_date_div" style="display: {{ old('head_marital_status') == '1' ? 'block' : 'none' }}">
                                            <label class="form-label fw-semibold">Marriage Date</label>
                                            <input type="date" name="head_mariage_date" class="form-control rounded-pill" value="{{ old('head_mariage_date') }}">
                                            <div class="validation-error"></div>
                                            @error('head_mariage_date')<div class="text-danger">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 form-group">
                                        <label class="form-label fw-semibold">Hobbies & Interests</label>
                                        <div id="hobbyContainer">
                                            @php $oldHobbies = old('head_hobbies', ['']); @endphp
                                            @foreach($oldHobbies as $hobby)
                                            <input type="text" name="head_hobbies[]" class="form-control rounded-pill mb-2" placeholder="Enter hobby" value="{{ $hobby }}">
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
                                        @error('head_hobbies')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3 form-group">
                                        <label class="form-label fw-semibold">Profile Picture</label>
                                        <input type="file" name="head_photo" class="form-control rounded-pill" accept="image/*">
                                        <div class="form-text">Upload a clear photo (JPG, PNG, max 2MB)</div>
                                        <div class="validation-error"></div>
                                        @error('head_photo')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Members Section -->
                            <div class="card mb-4 border-success">
                                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0"><i class="bi bi-people me-2"></i>Family Members</h5>
                                    <button type="button" id="addMember" class="btn btn-outline-light btn-sm rounded-pill">
                                        <i class="bi bi-person-plus me-1"></i>Add Member
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div id="membersContainer">

                                    </div>
                                    <div class="text-center text-muted py-3" id="noMembersMessage">
                                        <i class="bi bi-person-plus-fill" style="font-size: 2rem;"></i>
                                        <p class="mb-0 mt-2">No members added yet. Click "Add Member" to start.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                                    <i class="bi bi-check-circle me-2"></i>Register Complete Family
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script>
    let memberCount = 0;

    document.addEventListener('DOMContentLoaded', function() {
        const headMarriedRadio = document.getElementById('head_married');
        const headUnmarriedRadio = document.getElementById('head_unmarried');
        const headMarriageDateDiv = document.getElementById('head_mrg_date_div');
        const hobbyContainer = document.getElementById('hobbyContainer');
        const addHobbyBtn = document.getElementById('addHobby');
        const removeHobbyBtn = document.getElementById('removeHobby');
        const addMemberBtn = document.getElementById('addMember');
        const membersContainer = document.getElementById('membersContainer');
        const noMembersMessage = document.getElementById('noMembersMessage');

        function toggleHeadMarriageDate() {
            headMarriageDateDiv.style.display = headMarriedRadio.checked ? 'block' : 'none';
        }

        function addHobbyInput() {
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'head_hobbies[]';
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

        function addMember() {
            memberCount++;
            const memberHtml = `
                <div class="member-card card mb-3" id="member-${memberCount}">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Member ${memberCount}</h6>
                        <button type="button" class="btn btn-outline-danger btn-sm rounded-pill" onclick="removeMember(${memberCount})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" name="members[${memberCount}][name]" class="form-control rounded-pill" placeholder="Enter full name">
                                <div class="validation-error"></div>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label fw-semibold">Date of Birth</label>
                                <input type="date" name="members[${memberCount}][birthdate]" class="form-control rounded-pill">
                                <div class="validation-error"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label fw-semibold">Marital Status</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="members[${memberCount}][marital_status]" id="member_${memberCount}_married" value="1">
                                        <label class="form-check-label" for="member_${memberCount}_married">Married</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="members[${memberCount}][marital_status]" id="member_${memberCount}_unmarried" value="0">
                                        <label class="form-check-label" for="member_${memberCount}_unmarried">Single</label>
                                    </div>
                                </div>
                                <div class="validation-error"></div>
                                <div class="mt-2 form-group" id="member_${memberCount}_mrg_date_div" style="display: none;">
                                    <input type="date" name="members[${memberCount}][mariage_date]" class="form-control rounded-pill" placeholder="Marriage Date">
                                    <div class="validation-error"></div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <label class="form-label fw-semibold">Education (Optional)</label>
                                <input type="text" name="members[${memberCount}][education]" class="form-control rounded-pill" placeholder="Enter education">
                                <div class="validation-error"></div>
                            </div>
                        </div>
                        <div class="mb-3 form-group">
                            <label class="form-label fw-semibold">Photo (Optional)</label>
                            <input type="file" name="members[${memberCount}][photo]" class="form-control rounded-pill" accept="image/*">
                            <div class="validation-error"></div>
                        </div>
                    </div>
                </div>
            `;

            membersContainer.insertAdjacentHTML('beforeend', memberHtml);
            noMembersMessage.style.display = 'none';

            // Add validation rules for new member
            addMemberValidationRules(memberCount);

            // Add event listeners for the new member's marital status
            const marriedRadio = document.getElementById(`member_${memberCount}_married`);
            const unmarriedRadio = document.getElementById(`member_${memberCount}_unmarried`);
            const marriageDateDiv = document.getElementById(`member_${memberCount}_mrg_date_div`);

            function toggleMemberMarriageDate() {
                marriageDateDiv.style.display = marriedRadio.checked ? 'block' : 'none';
            }

            marriedRadio.addEventListener('change', toggleMemberMarriageDate);
            unmarriedRadio.addEventListener('change', toggleMemberMarriageDate);
        }

        window.removeMember = function(id) {
            // Remove validation rules for this member
            removeMemberValidationRules(id);
            document.getElementById(`member-${id}`).remove();
            if (membersContainer.children.length === 0) {
                noMembersMessage.style.display = 'block';
            }
        };

        // Function to add validation rules for members
        function addMemberValidationRules(count) {
            const nameField = `members[${count}][name]`;
            const birthdateField = `members[${count}][birthdate]`;
            const maritalStatusField = `members[${count}][marital_status]`;
            const mariageDateField = `members[${count}][mariage_date]`;
            const photoField = `members[${count}][photo]`;

            $.validator.addMethod("noNumbers", function(value, element) {
                        return this.optional(element) || /^[a-zA-Z\s]*$/.test(value);
                    }, "Please enter only letters and spaces.");



            $(`input[name="${nameField}"]`).rules('add', {
                required: true,
                minlength: 2,
                noNumbers : true,
                messages: {
                    required: "Please enter member name",
                    minlength: "Name must be at least 2 characters",
                    noNumbers: "Numbers are not allowed",
                }
            });

            $(`input[name="${birthdateField}"]`).rules('add', {
                required: true,
                messages: {
                    required: "Please enter birthdate"
                }
            });

            $(`input[name="${maritalStatusField}"]`).rules('add', {
                required: true,
                messages: {
                    required: "Please select marital status"
                }
            });

            $(`input[name="${mariageDateField}"]`).rules('add', {
                required: function() {
                    return $(`#member_${count}_married`).is(':checked');
                },

                messages: {
                    required: "Please enter marriage date"
                }
            });

            $(`input[name="${photoField}"]`).rules('add', {
                extension: "jpg|jpeg|png",
                maxfilesize: 2,
                messages: {
                    extension: "Please upload a valid image (jpg, jpeg, png)",
                    maxfilesize: "Please upload image less than 2MB"
                }
            });
        }

        // Function to remove validation rules for members
        function removeMemberValidationRules(count) {
            const nameField = `members[${count}][name]`;
            const birthdateField = `members[${count}][birthdate]`;
            const maritalStatusField = `members[${count}][marital_status]`;
            const mariageDateField = `members[${count}][mariage_date]`;
            const photoField = `members[${count}][photo]`;

            $(`input[name="${nameField}"]`).rules('remove');
            $(`input[name="${birthdateField}"]`).rules('remove');
            $(`input[name="${maritalStatusField}"]`).rules('remove');
            $(`input[name="${mariageDateField}"]`).rules('remove');
            $(`input[name="${photoField}"]`).rules('remove');
        }

        headMarriedRadio.addEventListener('change', toggleHeadMarriageDate);
        headUnmarriedRadio.addEventListener('change', toggleHeadMarriageDate);
        addHobbyBtn.addEventListener('click', addHobbyInput);
        removeHobbyBtn.addEventListener('click', removeHobbyInput);
        addMemberBtn.addEventListener('click', addMember);
    });

    // State/City dropdown
    const oldCity = @json(old('head_city'));
    jQuery(document).ready(function() {
        jQuery('select[name="head_state"]').on('change', function() {
            let stateID = jQuery(this).val();
            jQuery.ajax({
                url: '/get-cities/' + stateID,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    const cityDropdown = jQuery('select[name="head_city"]');
                    cityDropdown.empty().append('<option value="">Select City</option>');
                    jQuery.each(data, function(key, value) {
                        cityDropdown.append('<option value="' + value.name + '">' + value.name + '</option>');
                    });
                    if (oldCity) {
                        cityDropdown.val(oldCity);
                    }
                }
            });
        });
        if (jQuery('select[name="head_state"]').val()) {
            jQuery('select[name="head_state"]').trigger('change');
        }
    });

    // Validation
    jQuery(document).ready(function() {
        $.validator.addMethod("maxfilesize", function(value, element, param) {
            if (element.files && element.files.length > 0) {
                var fileSize = element.files[0].size;
                var maxSizeBytes = param * 1024 * 1024;
                return fileSize <= maxSizeBytes;
            }
            return true;
        }, "File size exceeds the allowed limit.");

        $.validator.addMethod("noNumbers", function(value, element) {
            return this.optional(element) || /^[a-zA-Z\s]*$/.test(value);
        }, "Please enter only letters and spaces.");

        $.validator.addMethod("ageAbove21", function(value, element) {
            if (!value) return true;
            var dob = new Date(value);
            var today = new Date();
            var age = today.getFullYear() - dob.getFullYear();
            var m = today.getMonth() - dob.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) age--;
            return age >= 21;
        }, "You must be at least 21 years old.");

        $.validator.addMethod("minMarriageAge", function(value, element, dobSelector) {
            if (!value || !$(dobSelector).val()) {
                return true; // No validation if either date is empty
            }

            var marriageDate = new Date(value);
            var dob = new Date($(dobSelector).val());

            var age = marriageDate.getFullYear() - dob.getFullYear();
            var m = marriageDate.getMonth() - dob.getMonth();

            if (m < 0 || (m === 0 && marriageDate.getDate() < dob.getDate())) {
                age--;
            }

            return age >= 18;
        }, "The individual must be at least 18 years old at the time of marriage.");

        $('#formSubmit').validate({
            rules: {
                head_name: { required: true, minlength: 3 , noNumbers : true },
                head_surname: { required: true, minlength: 3 ,  noNumbers : true},
                head_birthdate: { required: true, ageAbove21: true },
                head_mobile: { required: true, rangelength: [10, 10], number: true },
                head_address: { required: true },
                head_state: { required: true },
                head_city: { required: true },
                head_pincode: { required: true, rangelength: [6, 6], number: true },
                head_marital_status: { required: true   },
                head_mariage_date: {

                    required: function() {
                                           return $("#head_married").is(":checked");
                                       },
                     minMarriageAge : "#dobField"

                },
                'head_hobbies[]': { required: true },
                head_photo: { required: true, extension: "jpg|jpeg|png", maxfilesize: 2 }
            },
            messages: {
                head_name: { required: "Please enter name" , noNumbers : "Numbers are not allowed in this field" },
                head_surname: { required: "Please enter surname" ,noNumbers : "Numbers are not allowed in this field"},
                head_birthdate: { required: "Please enter birthdate", ageAbove21: "You must be at least 21 years old to proceed." },
                head_mobile: { required: "Please enter mobile", rangelength: "Mobile must be 10 digits", number: "Please enter valid 10 digit mobile" },
                head_address: { required: "Please enter address" },
                head_state: { required: "Please select state" },
                head_city: { required: "Please select city" },
                head_pincode: { required: "Please enter Pincode", rangelength: "Pincode must be 6 digits", number: "Please enter valid 6 number pincode" },
                head_marital_status: { required: "Please select marital status" },
                head_mariage_date: { required: "Please enter marriage date" },
                'head_hobbies[]': { required: "Please enter at least one hobby" },
                head_photo: { required: "Please upload profile picture", extension: "Please upload a valid image (jpg, jpeg, png)", maxfilesize: "Please upload image less than 2MB" }
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
