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

                            <form id="updateForm" action="" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Head Information -->
                                <div class="row">
                                    <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label fw-semibold">First Name</label>
                                        <input type="text" name="name" class="form-control rounded-pill" value="{{ $head->name }}">
                                        <div class="validation-error"></div>
                                        @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label fw-semibold">Last Name</label>
                                        <input type="text" name="surname" class="form-control rounded-pill" value="{{ $head->surname }}">
                                        <div class="validation-error"></div>
                                        @error('surname')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label fw-semibold">Date of Birth</label>
                                        <input type="date" id="dobField" name="birthdate" class="form-control rounded-pill" value="{{ $head->birthdate}}">
                                        <div class="validation-error"></div>
                                        @error('birthdate')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6 mb-3 form-group">
                                        <label class="form-label fw-semibold">Mobile Number</label>
                                        <input type="text" maxlength="10" name="mobile" class="form-control rounded-pill" value="{{ $head->mobile }}">
                                        <div class="validation-error"></div>
                                        @error('mobile')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="mb-3 form-group">
                                    <label class="form-label fw-semibold">Address</label>
                                    <textarea name="address" class="form-control rounded-4" rows="3">{{ $head->address }}</textarea>
                                    <div class="validation-error"></div>
                                    @error('address')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3 form-group">
                                        <label class="form-label fw-semibold">State</label>
                                        <select name="state" id="stateSelect" class="form-select rounded-pill">
                                            <option value="">Select State</option>
                                            @if(isset($states) && !$states->isEmpty())
                                                @foreach ($states as $state)
                                                <option value="{{ $state->name }}" {{ $head && $head->state == $state->name ? 'selected' : '' }}>{{ $state->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="validation-error"></div>
                                        @error('state')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-4 mb-3 form-group">
                                        <label class="form-label fw-semibold">City</label>
                                        <select name="city" id="citySelect" class="form-select rounded-pill">
                                            <option value="">Select City</option>
                                            @if(isset($city) && !$city->isEmpty())
                                                @foreach ($city as $cities)
                                                <option value="{{ $cities->name }}" {{ $head && $head->city == $cities->name ? 'selected' : '' }}>{{ $cities->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="validation-error"></div>
                                        @error('city')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-4 mb-3 form-group">
                                        <label class="form-label fw-semibold">Pincode</label>
                                        <input type="text" maxlength="6" name="pincode" class="form-control rounded-pill" value="{{ $head->pincode }}">
                                        <div class="validation-error"></div>
                                        @error('pincode')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="mb-3 form-group">
                                    <label class="form-label fw-semibold">Marital Status</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="marital_status" id="married" value="1" {{ $head->marital_status == '1' ? 'checked' : ''}}>
                                                <label class="form-check-label" for="married">Married</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="marital_status" id="unmarried" value="0" {{ $head->marital_status == '0' ? 'checked' : ''}}>
                                                <label class="form-check-label" for="unmarried">Unmarried</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="validation-error"></div>
                                    @error('marital_status')<div class="text-danger">{{ $message }}</div>@enderror

                                    <div class="mt-3 form-group" id="mrg_date_div" style="display: {{ $head->marital_status == '1' ? 'block' : 'none' }}">
                                        <label class="form-label fw-semibold">Marriage Date</label>
                                        <input type="date" name="mariage_date" class="form-control rounded-pill" value="{{ $head->mariage_date }}">
                                        <div class="validation-error"></div>
                                        @error('mariage_date')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <!-- Hobby Section -->
                                <div class="card bg-light mb-4 rounded-4">
                                    <div class="card-body">
                                        <h6 class="card-title text-primary fw-semibold"><i class="bi bi-star me-2"></i>Hobbies & Interests</h6>
                                        <div id="hobbyContainer">
                                            @if($head && $head->hobbies)
                                                @foreach ($head->hobbies as $hobby)
                                                <input type="text" name="hobbies[]" value="{{ $hobby->hobby_name }}" class="form-control rounded-pill mb-2 hobby-input" placeholder="Enter hobby">
                                                @endforeach
                                            @else
                                                <input type="text" name="hobbies[]" value="" class="form-control rounded-pill mb-2 hobby-input" placeholder="Enter hobby">
                                            @endif
                                        </div>
                                        <div class="d-flex gap-2">
                                            <button type="button" id="addHobby" class="btn btn-success btn-sm rounded-pill">
                                                <i class="bi bi-plus-circle me-1"></i>Add
                                            </button>
                                            <button type="button" id="removeHobby" class="btn btn-danger btn-sm rounded-pill">
                                                <i class="bi bi-dash-circle me-1"></i>Remove
                                            </button>
                                        </div>
                                        @error('hobbies')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <!-- Photo Section -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Profile Picture</label>
                                    <input type="file" name="path" class="form-control rounded-pill" accept="image/*">
                                    @if($head->photo_path)
                                    <small class="text-muted">Current: <img src="{{ asset('/uploads/images/').'/'.$head->photo_path }}" alt="Current" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #007bff;"></small>
                                    @endif
                                    @error('path')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>

                                <!-- Family Members Section -->
                                @if(isset($head->members) && !$head->members->isEmpty())
                                <div class="card bg-light mb-4 rounded-4">
                                    <div class="card-header bg-info text-white">
                                        <h6 class="mb-0 fw-bold"><i class="bi bi-people me-2"></i>Family Members</h6>
                                    </div>
                                    <div class="card-body">
                                        @foreach($head->members as $item)
                                        <div class="border rounded-3 p-3 mb-3 bg-white member-card" data-member-id="{{ $item->id }}">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="text-primary mb-0"><i class="bi bi-person me-2"></i>Member {{ $loop->iteration }} ( <span class="text-success" > {{$item->name}}</span> )</h6>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteMember(this)">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Name</label>
                                                    <input type="text" name="members[{{$loop->iteration}}][name]" class="form-control rounded-pill" value="{{$item->name}}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Date of Birth</label>
                                                    <input type="date" name="members[{{$loop->iteration}}][date]" class="form-control rounded-pill" value="{{$item->birthdate}}" required>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-semibold"><i class="bi bi-people me-2"></i>Relation</label>
                                                <select name="members[{{$loop->iteration}}][relation]" class="form-select rounded-pill">
                                                    <option value="">Select Relation</option>
                                                    <option value="spouse" {{ $item->relation == 'spouse' ? 'selected' : '' }}>Spouse</option>
                                                    <option value="son" {{ $item->relation == 'son' ? 'selected' : '' }}>Son</option>
                                                    <option value="daughter" {{$item->relation == 'daughter' ? 'selected' : '' }}>Daughter</option>
                                                    <option value="father" {{$item->relation == 'father' ? 'selected' : '' }}>Father</option>
                                                    <option value="mother" {{ $item->relation == 'mother' ? 'selected' : '' }}>Mother</option>
                                                    <option value="brother" {{$item->relation == 'brother' ? 'selected' : '' }}>Brother</option>
                                                    <option value="sister" {{ $item->relation== 'sister' ? 'selected' : '' }}>Sister</option>
                                                    <option value="grandfather" {{ $item->relation == 'grandfather' ? 'selected' : '' }}>Grandfather</option>
                                                    <option value="grandmother" {{ $item->relation == 'grandmother' ? 'selected' : '' }}>Grandmother</option>
                                                    <option value="uncle" {{ $item->relation == 'uncle' ? 'selected' : '' }}>Uncle</option>
                                                    <option value="aunt" {{ $item->relation == 'aunt' ? 'selected' : '' }}>Aunt</option>
                                                    <option value="nephew" {{ $item->relation == 'nephew' ? 'selected' : '' }}>Nephew</option>
                                                    <option value="niece" {{ $item->relation == 'niece' ? 'selected' : '' }}>Niece</option>
                                                    <option value="cousin" {{ $item->relation == 'cousin' ? 'selected' : '' }}>Cousin</option>
                                                    <option value="other" {{ $item->relation == 'other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label fw-semibold">Marital Status</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="members[{{$loop->iteration}}][marital_status]" value="1" {{ $item->marital_status == 1 ? 'checked' : '' }}>
                                                            <label class="form-check-label">Married</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="members[{{$loop->iteration}}][marital_status]" value="0" {{ $item->marital_status == 0 ? 'checked' : '' }}>
                                                            <label class="form-check-label">Unmarried</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 member-marriage-date" id="member_{{$loop->iteration}}_marriage" style="display: {{ $item->marital_status == 1 ? 'block' : 'none' }}">
                                                <label class="form-label fw-semibold">Marriage Date</label>
                                                <input type="date" name="members[{{$loop->iteration}}][mariage_date]" class="form-control rounded-pill" value="{{$item->mariage_date}}">
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Education</label>
                                                    <input type="text" name="members[{{$loop->iteration}}][education]" class="form-control rounded-pill" value="{{$item->education}}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Photo</label>
                                                    <input type="file" name="members[{{$loop->iteration}}][photo]" class="form-control rounded-pill" accept="image/*">
                                                    @if($item->photo_path)
                                                    <small class="text-muted">Current: <img src="{{ asset('/uploads/images/').'/'.$item->photo_path }}" alt="Current Image" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #007bff;">
                                                    </small>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-semibold">Set Status</label>
                                                    <select name="members[{{$loop->iteration}}][status]" class="form-select rounded-pill">
                                                        <option value="">Select Status</option>
                                                        <option value="1" {{ $item->status == '1' ? 'selected' : '' }}>Active</option>
                                                        <option value="0" {{ $item->status == '0' ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                    @error('status')<div class="text-danger">{{ $message }}</div>@enderror
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                        <div class="text-center mt-3">
                                            <button type="button" class="btn btn-success" onclick="addMember()">
                                                <i class="bi bi-plus-circle me-2"></i>Add New Member
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5">
                                        <i class="bi bi-check-circle me-2"></i>Update Family Head & Members
                                    </button>
                                </div>
                            </form>
                        </div>
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
    document.addEventListener('DOMContentLoaded', function() {
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
            input.className = 'form-control rounded-pill mb-2 hobby-input';
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

        // Handle member marriage date toggles
        document.querySelectorAll('input[name*="[marital_status]"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                const memberIndex = this.name.match(/\[(\d+)\]/)[1];
                const marriageDateDiv = document.getElementById(`member_${memberIndex}_marriage`);
                if (marriageDateDiv) {
                    marriageDateDiv.style.display = this.value == '1' ? 'block' : 'none';
                }
            });
        });

        // Handle state-city dropdown
        const stateSelect = document.getElementById('stateSelect');
        const citySelect = document.getElementById('citySelect');

        if (stateSelect) {
            stateSelect.addEventListener('change', function() {
                const stateName = this.value;
                citySelect.innerHTML = '<option value="">Select City</option>';

                if (stateName) {
                    fetch(`/get-cities/${stateName}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(city => {
                                const option = document.createElement('option');
                                option.value = city.name;
                                option.textContent = city.name;
                                citySelect.appendChild(option);
                            });
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        }

        // Add member functionality
        window.addMember = function() {
            const membersContainer = document.querySelector('.card-body');
            const memberCount = document.querySelectorAll('.member-card').length + 1;

            const memberHtml = `
                <div class="border rounded-3 p-3 mb-3 bg-white member-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-primary mb-0"><i class="bi bi-person me-2"></i>Member ${memberCount}</h6>
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteMember(this)">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Name</label>
                            <input type="text" name="new_members[${memberCount}][name]" class="form-control rounded-pill" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Date of Birth</label>
                            <input type="date" name="new_members[${memberCount}][date]" class="form-control rounded-pill" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="bi bi-people me-2"></i>Relation</label>
                        <select name="new_members[${memberCount}][relation]" class="form-select rounded-pill">
                            <option value="">Select Relation</option>
                            <option value="spouse">Spouse</option>
                            <option value="son">Son</option>
                            <option value="daughter">Daughter</option>
                            <option value="father">Father</option>
                            <option value="mother">Mother</option>
                            <option value="brother">Brother</option>
                            <option value="sister">Sister</option>
                            <option value="grandfather">Grandfather</option>
                            <option value="grandmother">Grandmother</option>
                            <option value="uncle">Uncle</option>
                            <option value="aunt">Aunt</option>
                            <option value="nephew">Nephew</option>
                            <option value="niece">Niece</option>
                            <option value="cousin">Cousin</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Marital Status</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="new_members[${memberCount}][marital_status]" value="1">
                                    <label class="form-check-label">Married</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="new_members[${memberCount}][marital_status]" value="0" checked>
                                    <label class="form-check-label">Unmarried</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 member-marriage-date" style="display: none">
                        <label class="form-label fw-semibold">Marriage Date</label>
                        <input type="date" name="new_members[${memberCount}][mariage_date]" class="form-control rounded-pill">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Education</label>
                            <input type="text" name="new_members[${memberCount}][education]" class="form-control rounded-pill">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Photo</label>
                            <input type="file" name="new_members[${memberCount}][photo]" class="form-control rounded-pill" accept="image/*">
                        </div>
                    </div>
                </div>
            `;

            const addButton = document.querySelector('button[onclick="addMember()"]').parentElement;
            addButton.insertAdjacentHTML('beforebegin', memberHtml);

            // Add event listeners for the new member's marital status
            const newMemberCard = addButton.previousElementSibling;
            const marriedRadio = newMemberCard.querySelector('input[value="1"]');
            const unmarriedRadio = newMemberCard.querySelector('input[value="0"]');
            const marriageDateDiv = newMemberCard.querySelector('.member-marriage-date');

            marriedRadio.addEventListener('change', function() {
                marriageDateDiv.style.display = 'block';
            });

            unmarriedRadio.addEventListener('change', function() {
                marriageDateDiv.style.display = 'none';
            });
        };

        // Delete member functionality
        window.deleteMember = function(button) {
            const memberCard = button.closest('.member-card');
            const memberId = memberCard.getAttribute('data-member-id');

            if (memberId) {
                // Existing member - add to deleted list
                const deletedInput = document.createElement('input');
                deletedInput.type = 'hidden';
                deletedInput.name = 'deleted_members[]';
                deletedInput.value = memberId;
                document.querySelector('form').appendChild(deletedInput);
            }

            memberCard.remove();
        };
    });

    // jQuery validation
    $(document).ready(function() {
        $.validator.addMethod("noNumbers", function(value, element) {
            return this.optional(element) || !/\d/.test(value);
        }, "Numbers are not allowed");
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

                $.validator.addMethod("agebelow116", function(value, element) {
                    if (!value) return true;
                    var dob = new Date(value);
                    var today = new Date();
                    var age = today.getFullYear() - dob.getFullYear();
                    var m = today.getMonth() - dob.getMonth();
                    if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) age--;
                    return age <= 120;
                }, "Your age exceeds 120yrs.");

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

                $.validator.addMethod("noSpace", function(value, element) {
                            return value.indexOf(" ") < 0 && value !== "";
                        }, "Spaces are not allowed.");

        $('#updateForm').validate({
            rules: {
                name: { required: true, noNumbers: true , noSpace:true},
                surname: { required: true, noNumbers: true, noSpace:true },
                birthdate: {required : true, ageAbove21: true,agebelow116 : true },
                mobile: { required: true, digits: true, minlength: 10, maxlength: 10, noSpace:true },
                address: "required",
                state: "required",
                city: "required",
                pincode: { required: true, digits: true, minlength: 6, maxlength: 6, noSpace:true },
                marital_status: "required",
                mariage_date: { required: function() {
                                                                           return $("#married").is(":checked");
                                                                       },
                                                     minMarriageAge : "#dobField" },
                photo : { maxfilesize: 2}
            },
            messages: {
                name: { required: "Please enter first name", noNumbers: "Name cannot contain numbers" },
                surname: { required: "Please enter last name", noNumbers: "Surname cannot contain numbers" },
                birthdate: {required : "Please enter date of birth", ageAbove21: "You must be at least 21 years old" },
                mobile: { required: "Please enter mobile number", digits: "Only numbers allowed", minlength: "Must be 10 digits", maxlength: "Must be 10 digits" },
                address: "Please enter address",
                state: "Please select state",
                city: "Please select city",
                pincode: { required: "Please enter pincode", digits: "Only numbers allowed", minlength: "Must be 6 digits", maxlength: "Must be 6 digits" },
                marital_status: "Please select marital status",
                mariage_date: {required : "Marriage date is required when married", minMarriageAge: "The individual must be at least 18 years old at the time of marriage." },
                photo : {  maxfilesize: "File size must be less than 2MB" }
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

<script>
            $(document).ready(function(){
                $('#updateForm').on('submit', function(e){
                    e.preventDefault();

                    if(!$(this).valid()){
                        return;
                    }

                    var formData = new FormData(this);
                    formData.append('_method', 'PUT');
                    formData.append('_token', '{{ csrf_token() }}');

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('admin.fullupdate',$id) }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response){
                            if (response.status === 'success') {
                                alert(response.message + ' User: ' + response.name + ' ' + response.surname);

                                window.location.href = response.redirect;
                            } else {
                                alert('Error: ' + response.message);
                            }
                        },
                        error: function(xhr, status, error){
                            if(xhr.status === 500) {
                                var errors = xhr.responseJSON.errors;
                                var errorMsg = 'Validation errors:\n';
                                for(var field in errors) {
                                    errorMsg += errors[field][0] + '\n';
                                }
                                alert(errorMsg);
                            } else {
                                alert('An error occurred: ' + (xhr.responseJSON?.message || xhr.responseText));
                            }
                        }
                    });
                });
            });

        </script>
</body>
</html>
