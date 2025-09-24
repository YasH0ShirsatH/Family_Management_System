<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Family Head - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/heading.css')  }}">
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

                            <form id="updateForm" action="{{ route('admin.fullupdate',$id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Head Information -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">First Name</label>
                                        <input type="text" name="name" class="form-control rounded-pill" value="{{ $head->name }}" required>
                                        @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Last Name</label>
                                        <input type="text" name="surname" class="form-control rounded-pill" value="{{ $head->surname }}" required>
                                        @error('surname')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Date of Birth</label>
                                        <input type="date" name="birthdate" class="form-control rounded-pill" value="{{ $head->birthdate}}" required>
                                        @error('birthdate')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Mobile Number</label>
                                        <input type="tel" name="mobile" class="form-control rounded-pill" value="{{ $head->mobile }}" required pattern="[0-9]{10}">
                                        @error('mobile')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Address</label>
                                    <textarea name="address" class="form-control rounded-4" rows="3" required>{{ $head->address }}</textarea>
                                    @error('address')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-semibold">State</label>
                                        <select name="state" id="stateSelect" class="form-select rounded-pill">
                                            <option value="">Select State</option>
                                            @if(isset($states) && !$states->isEmpty())
                                                @foreach ($states as $state)
                                                <option value="{{ $state->name }}" {{ $head && $head->state == $state->name ? 'selected' : '' }}>{{ $state->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('state')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-semibold">City</label>
                                        <select name="city" id="citySelect" class="form-select rounded-pill">
                                            <option value="">Select City</option>
                                            @if(isset($city) && !$city->isEmpty())
                                                @foreach ($city as $cities)
                                                <option value="{{ $cities->name }}" {{ $head && $head->city == $cities->name ? 'selected' : '' }}>{{ $cities->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('city')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-semibold">Pincode</label>
                                        <input type="number" name="pincode" class="form-control rounded-pill" value="{{ $head->pincode }}" required pattern="[0-9]{6}">
                                        @error('pincode')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="mb-3">
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
                                    @error('marital_status')<div class="text-danger">{{ $message }}</div>@enderror

                                    <div class="mt-3" id="mrg_date_div" style="display: {{ $head->marital_status == '1' ? 'block' : 'none' }}">
                                        <label class="form-label fw-semibold">Marriage Date</label>
                                        <input type="date" name="mariage_date" class="form-control rounded-pill" value="{{ $head->mariage_date }}">
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
                                                <label class="form-label fw-semibold"><i class="bi bi-people me-2"></i>Relation</label>
                                                <select name="members[{{$loop->iteration}}][relation]" class="form-select rounded-pill @error('relation') is-invalid @enderror">
                                                <option value="">Select Relation</option>
                                                <option value="spouse" {{ old('relation') == 'spouse' ? 'selected' : '' }}>Spouse</option>
                                                 <option value="son" {{ old('relation') == 'son' ? 'selected' : '' }}>Son</option>
                                                 <option value="daughter" {{ old('relation') == 'daughter' ? 'selected' : '' }}>Daughter</option>
                                                 <option value="father" {{ old('relation') == 'father' ? 'selected' : '' }}>Father</option>
                                                 <option value="mother" {{ old('relation') == 'mother' ? 'selected' : '' }}>Mother</option>
                                                 <option value="brother" {{ old('relation') == 'brother' ? 'selected' : '' }}>Brother</option>
                                                 <option value="sister" {{ old('relation') == 'sister' ? 'selected' : '' }}>Sister</option>
                                                 <option value="grandfather" {{ old('relation') == 'grandfather' ? 'selected' : '' }}>Grandfather</option>
                                                 <option value="grandmother" {{ old('relation') == 'grandmother' ? 'selected' : '' }}>Grandmother</option>
                                                 <option value="uncle" {{ old('relation') == 'uncle' ? 'selected' : '' }}>Uncle</option>
                                                 <option value="aunt" {{ old('relation') == 'aunt' ? 'selected' : '' }}>Aunt</option>
                                                 <option value="nephew" {{ old('relation') == 'nephew' ? 'selected' : '' }}>Nephew</option>
                                                 <option value="niece" {{ old('relation') == 'niece' ? 'selected' : '' }}>Niece</option>
                                                 <option value="cousin" {{ old('relation') == 'cousin' ? 'selected' : '' }}>Cousin</option>
                                                 <option value="other" {{ old('relation') == 'other' ? 'selected' : '' }}>Other</option>
                                            </select>

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
                                                    <select name="members[{{$loop->iteration}}][status]" id="status" class="form-select rounded-pill">
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

                                <button type="submit" class="btn mb-5 py-3 mx-auto btn-primary rounded-pill" style="width: 80%">
                                    <i class="bi bi-check-circle me-2"></i>Update Family Head & Members
                                </button>
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
            if (marriedRadio.checked) {
                marriageDateDiv.style.display = 'block';
            } else {
                marriageDateDiv.style.display = 'none';
            }
        }

        if (marriedRadio) marriedRadio.addEventListener('click', toggleMarriageDate);
        if (unmarriedRadio) unmarriedRadio.addEventListener('click', toggleMarriageDate);

        // Handle member marriage date toggles
        document.querySelectorAll('input[name*="[marital_status]"]').forEach(function(radio) {
            radio.addEventListener('click', function() {
                const memberIndex = this.name.match(/\[(\d+)\]/)[1];
                const marriageDateDiv = document.getElementById(`member_${memberIndex}_marriage`);
                if (marriageDateDiv) {
                    marriageDateDiv.style.display = this.value == '1' ? 'block' : 'none';
                }
            });
        });
        addHobbyBtn.addEventListener('click', addHobbyInput);
        removeHobbyBtn.addEventListener('click', removeHobbyInput);

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

                        <label class="form-label fw-semibold"><i class="bi bi-people me-2"></i>Relation</label>
                                                                <select name="new_members[${memberCount}][relation]" class="form-select rounded-pill @error('relation') is-invalid @enderror">
                                                                <option value="">Select Relation</option>
                                                                <option value="spouse" {{ old('relation') == 'spouse' ? 'selected' : '' }}>Spouse</option>
                                                                 <option value="son" {{ old('relation') == 'son' ? 'selected' : '' }}>Son</option>
                                                                 <option value="daughter" {{ old('relation') == 'daughter' ? 'selected' : '' }}>Daughter</option>
                                                                 <option value="father" {{ old('relation') == 'father' ? 'selected' : '' }}>Father</option>
                                                                 <option value="mother" {{ old('relation') == 'mother' ? 'selected' : '' }}>Mother</option>
                                                                 <option value="brother" {{ old('relation') == 'brother' ? 'selected' : '' }}>Brother</option>
                                                                 <option value="sister" {{ old('relation') == 'sister' ? 'selected' : '' }}>Sister</option>
                                                                 <option value="grandfather" {{ old('relation') == 'grandfather' ? 'selected' : '' }}>Grandfather</option>
                                                                 <option value="grandmother" {{ old('relation') == 'grandmother' ? 'selected' : '' }}>Grandmother</option>
                                                                 <option value="uncle" {{ old('relation') == 'uncle' ? 'selected' : '' }}>Uncle</option>
                                                                 <option value="aunt" {{ old('relation') == 'aunt' ? 'selected' : '' }}>Aunt</option>
                                                                 <option value="nephew" {{ old('relation') == 'nephew' ? 'selected' : '' }}>Nephew</option>
                                                                 <option value="niece" {{ old('relation') == 'niece' ? 'selected' : '' }}>Niece</option>
                                                                 <option value="cousin" {{ old('relation') == 'cousin' ? 'selected' : '' }}>Cousin</option>
                                                                 <option value="other" {{ old('relation') == 'other' ? 'selected' : '' }}>Other</option>
                                                            </select>
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
                            <input type="text" name="new_members[${memberCount}][education]" class="form-control rounded-pill" >
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

            marriedRadio.addEventListener('click', function() {
                marriageDateDiv.style.display = 'block';
            });

            unmarriedRadio.addEventListener('click', function() {
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
        $('#updateForm').validate({
            rules: {
                name: "required",
                surname: "required",
                birthdate: "required",
                mobile: { required: true, minlength: 10, maxlength: 10 },
                address: "required",
                state: "required",
                city: "required",
                pincode: { required: true, minlength: 6, maxlength: 6 },
                marital_status: "required"
            },
            messages: {
                name: "Please enter first name",
                surname: "Please enter last name",
                birthdate: "Please enter date of birth",
                mobile: "Please enter valid 10-digit mobile number",
                address: "Please enter address",
                state: "Please select state",
                city: "Please select city",
                pincode: "Please enter valid 6-digit pincode",
                marital_status: "Please select marital status"
            },
            ignore: [],
            submitHandler: function(form) {
                var isValid = true;

                // Validate name and birthdate for all members
                $('input[name*="[name]"], input[name*="[date]"]').each(function() {
                    if ($(this).val().trim() === '') {
                        $(this).addClass('error');
                        isValid = false;
                    } else {
                        $(this).removeClass('error');
                    }
                });

                // Validate marriage date for married members
                $('input[name*="[marital_status]"][value="1"]:checked').each(function() {
                    var memberIndex = this.name.match(/\[(\d+)\]/)[1];
                    var marriageDateInput = $('input[name*="[' + memberIndex + '][mariage_date]"]');
                    if (marriageDateInput.length && marriageDateInput.val().trim() === '') {
                        marriageDateInput.addClass('error');
                        isValid = false;
                    }
                });

                if (isValid) {
                    form.submit();
                } else {
                    alert('Please fill required fields: name, birthdate, and marriage date if married');
                }
            }
        });
    });
    </script>
</body>
</html>
