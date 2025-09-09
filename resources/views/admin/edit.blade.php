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


    <nav class="navbar navbar-dark bg-primary shadow">
        <div class="container">
                <a class="navbar-brand fs-4 fw-bold">
                    <i class="bi bi-house-heart me-2"></i>Family Management System
                </a>
                <span class="navbar-text text-white d-flex align-items-center justify-content-end " style="width: 24%;">
                    
                
                <span>
                    <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                    <i class="navbar-toggler-icon"></i>
                    </a>

                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Family Management System</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                        <div>
                            This is a compilation of all the shortcuts we can use to efficiently perform various tasks on a Website
                        </div>
                        <div class="dropdown mt-3">
                            <p class="text-primary fw-bold">Dashboard</p>
                            <li><a class="dropdown-item text-dark" href="/dashboard"><i class="bi bi-speedometer2 text-primary  mb-2 mx-2"></i>Dashboard</a></li>
                        </div>
                        <div class="dropdown mt-3">
                            <p class="text-primary fw-bold">Usefull Links</p>
                            <li><a class="dropdown-item text-dark" href="/admin"><span><i class="bi bi-people  mb-2 mx-2 "></i>Manage Head</a></span></li>
                            <li><a class="dropdown-item text-dark" href="{{ route('state.index') }}"><i class="bi bi-geo-alt  mb-2 mx-2"></i>Manage States</a></li>
                            <li><a class="dropdown-item text-dark" href="{{ route('city.index') }}"><i class="bi bi-buildings  mb-2 mx-2"></i>Manage Cities</a></li>
                            
                            <li><a class="dropdown-item  bg-danger" href="/logout"><i class="bi bi-box-arrow-right  mb-2 mx-2"></i>Logout</a></li>
                        </div>
                        <div class="dropdown mt-3">
                            <p class="text-primary fw-bold">Add Content</p>
                            <li><a class="dropdown-item text-dark" href="/headview"><i class="bi bi-plus-square text-primary  mb-2 mx-2"></i>Create Head</a></li>

                            <li><a class="dropdown-item text-dark" href="{{ route('create.state') }}"><i class="bi bi-plus-square text-primary  mb-2 mx-2"></i>Create State</a></li>
                            <li><a class="dropdown-item  text-dark" href="{{ route('create.city') }}"><i class="bi bi-plus-square text-primary mb-2 mx-2"></i>Create City</a></li>
                            
                        </div>
                    </div>
                    </div>
                </span>
           
            
        </div>
    </nav>
    <div class="text-center mb-4 mt-4">
        <a href="{{ route('admin.index') }}" class="btn btn-outline-primary rounded-pill">
            <i class="bi bi-arrow-left me-2"></i>Back to Head Dashboard
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

                        <form action="{{ route('admin.update',$id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">First Name</label>
                                    <input type="text" name="name" class="form-control rounded-pill"
                                        value="{{ $head->name }}" required>
                                    @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Last Name</label>
                                    <input type="text" name="surname" class="form-control rounded-pill"
                                        value="{{ $head->surname }}" required>
                                    @error('surname')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Date of Birth</label>
                                    <input type="date" name="birthdate" class="form-control rounded-pill"
                                        value="{{ $head->birthdate }}" required>
                                    @error('birthdate')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Mobile Number</label>
                                    <input type="tel" name="mobile" class="form-control rounded-pill"
                                        value="{{ $head->mobile }}" required>
                                    @error('mobile')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Address</label>
                                <textarea name="address" class="form-control rounded-4" rows="3"
                                    required>{{ $head->address }}</textarea>
                                @error('address')<div class="text-danger">{{ $message }}</div>@enderror
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">State</label>
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
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">City</label>
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
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Pincode</label>
                                    <input type="number" name="pincode" class="form-control rounded-pill"
                                        value="{{ $head->pincode }}" required>
                                    @error('pincode')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="mb-3">
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
                                @error('marital_status')<div class="text-danger">{{ $message }}</div>@enderror

                                <div class="mt-3" id="mrg_date_div"
                                    style="display: {{ $head->marital_status == '1' ? 'block' : 'none' }}">
                                    <label class="form-label fw-semibold">Marriage Date</label>
                                    <input type="date" name="mariage_date" class="form-control rounded-pill"
                                        value="{{ $head->mariage_date }}" @error('mariage_date')<div
                                        class="text-danger">{{ $message }}
                                </div>@enderror
                            </div>
                    </div>

                    <!-- Hobby Section -->
                    <div class="card bg-light mb-4 mt-4 rounded-4">
                        <div class="card-body">
                            <h6 class="card-title text-primary fw-semibold"><i class="bi bi-star me-2"></i>Hobbies &
                                Interests</h6>
                            <div id="hobbyContainer">
                                @foreach ($head->hobbies as $hobby)
                                <input type="text" name="hobbies[]" value="{{ $hobby->hobby_name }}"
                                    class="form-control rounded-pill mb-2" placeholder="Enter hobby">
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
                            @error('hobbies')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Profile Picture</label>
                        <input type="file" name="path" class="form-control rounded-pill" accept="image/*">
                        <small class="text-muted">Upload a clear photo (JPG, PNG, max 2MB)</small>
                        @error('path')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <button type="submit" class="btn btn-primary rounded-pill">
                        <i class="bi bi-check-circle me-2"></i>Update Family Head
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Section -->
    <div class="row justify-content-center mt-4">
        <div class="col-lg-8">
            <div class="card border-danger shadow rounded-4">
                <div class="card-header bg-danger text-white py-3 rounded-top-4">
                    <h5 class="mb-0 fw-bold">Danger Zone: Delete family head and all members</h5>
                </div>
                <div class="card-body text-center p-4">
                    <form action="{{ route('admin.destroy', $head->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger rounded-pill" id="deleteBtn">
                            <i class="bi bi-trash me-2"></i>Delete Head
                        </button>
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
        const deleteButton = document.getElementById('deleteBtn');

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
</body>

</html>