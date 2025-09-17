<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Management - Add Members</title>
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
                border-color: #dc3545 ;
                background-color: #fff0f0;
            }
        </style>


</head>
<body class="bg-light">
    <div class="container py-4">
        
        <!-- Header with Logout -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary fw-bold"><i class="bi bi-people-fill me-2"></i>Family Management</h2>
            <a href="{{ route('logoutMember',$id) }}" class="btn btn-danger rounded-pill" id="logout">
                <i class="bi bi-box-arrow-right me-2"></i>Complete & Logout
            </a>
        </div>

        <!-- Alerts -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-pill">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-pill">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Main Content -->
        <div class="row">
            <!-- Add Member Form -->
            <div class="col-lg-5">
                <div class="card shadow rounded-4 sticky-top" style="top: 20px;">
                    <div class="card-header bg-success text-white py-3 rounded-top-4">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-person-plus me-2"></i>Add New Member</h5>
                    </div>
                    <div class="card-body p-4">
                        <form id="formSubmit" action="{{ route('addMember',$id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 form-group">
                                <input type="text" name="name" class="form-control rounded-pill" placeholder="Full Name" value="{{ old('name') }}">
                                <div class="validation-error" ></div>
                                @error('name')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="mb-3 form-group">
                                <input type="date" name="birthdate" class="form-control rounded-pill" value="{{ old('birthdate') }}">
                                <div class="validation-error" ></div>
                                @error('birthdate')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="mb-3">
                                <div class="d-flex gap-3 form-group">
                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="marital_status" id="married" value="1" {{ old('marital_status') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="married">Married</label>
                                    </div>
                                    <div class="form-check ">
                                        <input class="form-check-input" type="radio" name="marital_status" id="unmarried" value="0" {{ old('marital_status') == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="unmarried">Single</label>
                                    </div><br>
                                    <div class="validation-error" ></div>
                                </div>
                                @error('marital_status')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                                
                                <div class="mt-3 form-group " id="mrg_date_div" style="display: {{ old('marital_status') == '1' ? 'block' : 'none' }}">
                                    <input type="date" name="mariage_date" class="form-control rounded-pill" placeholder="Marriage Date" value="{{ old('mariage_date') }}">
                                    <div class="validation-error" ></div>
                                    @error('mariage_date')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            
                            <div class="mb-3 form-group">
                                <input type="text" name="education" class="form-control rounded-pill" placeholder="Education (Optional)" value="{{ old('education') }}">
                                <div class="validation-error" ></div>
                                @error('education')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="mb-4 form-group">
                                <input type="file" name="photo_path" class="form-control rounded-pill" accept="image/*">
                                <div class="validation-error" ></div>
                                @error('photo_path')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>
                            
                            <button type="submit" class="btn btn-success w-100 rounded-pill py-2">
                                <i class="bi bi-person-plus me-2"></i>Add Member
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Members List -->
            <div class="col-lg-7">
                <div class="card shadow rounded-4">
                    <div class="card-header bg-primary text-white py-3 rounded-top-4">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-people me-2"></i>Family Members ({{ $members->count() + 1 }})</h5>
                    </div>
                    <div class="card-body p-0">
                        
                        <!-- Family Head -->
                        <div class="p-4 border-bottom">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('uploads/images/' . $users->photo_path) }}" class="rounded-circle me-3" width="60" height="60" style="object-fit: cover;">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="fw-bold mb-0 me-2">{{ $users->name }} {{ $users->surname }}</h6>
                                        <span class="badge bg-warning text-dark rounded-pill">Head</span>
                                    </div>
                                    <small class="text-muted d-block">{{ date('M d, Y', strtotime($users->birthdate)) }}</small>
                                    <small class="text-muted">{{ $users->marital_status ? 'Married' : 'Single' }} • {{ $users->city }}, {{ $users->state }}</small>
                                </div>
                            </div>
                        </div>

                        <!-- Family Members -->
                        <div style="max-height: 500px; overflow-y: auto;">
                            @forelse($members as $member)
                            <div class="p-4 border-bottom">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('uploads/images/' . ($member->photo_path ?: 'noimage.png')) }}" class="rounded-circle me-3" width="60" height="60" style="object-fit: cover;">
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-1">{{ $member->name }}</h6>
                                        <small class="text-muted d-block">{{ date('M d, Y', strtotime($member->birthdate)) }}</small>
                                        <div class="d-flex gap-2 mt-1">
                                            <span class="badge bg-light text-dark rounded-pill">{{ $member->marital_status ? 'Married' : 'Single' }}</span>
                                            @if($member->education)
                                            <span class="badge bg-info rounded-pill">{{ $member->education }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-5">
                                <i class="bi bi-person-plus-fill text-muted" style="font-size: 3rem;"></i>
                                <h6 class="text-muted mt-3">No members added yet</h6>
                                <p class="text-muted small">Add your first family member using the form</p>
                            </div>
                            @endforelse
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
        const logoutButton = document.getElementById('logout');

        logoutButton.addEventListener('click', function(event) {
            if (!confirm('Complete registration and logout?')) {
                event.preventDefault();
            }
        });

        function toggleMarriageDate() {
            marriageDateDiv.style.display = marriedRadio.checked ? 'block' : 'none';
        }

        marriedRadio.addEventListener('change', toggleMarriageDate);
        unmarriedRadio.addEventListener('change', toggleMarriageDate);
    });
    </script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>
        <script>
            
                jQuery(document).ready(function () {
                    $.validator.addMethod("maxfilesize", function (value, element, param) {
                        if (element.files && element.files.length > 0) {
                            var fileSize = element.files[0].size;
                            var maxSizeBytes = param * 1024 * 1024;
                            return fileSize <= maxSizeBytes;
                        }
                        return true;
                    }, "File size exceeds the allowed limit.");

                    $.validator.addMethod("ageAbove21", function (value, element) {
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
                        name: {required: true },
                    birthdate: {required: true,},
                    marital_status: {required: true },
                    mariage_date: {
                        required: {
                        depends: function (element) {
                                return $("#married").is(":checked");
                            }
                        }
                    },
                    
                    photo_path: { extension: "jpg|jpeg|png", maxfilesize: 2 }
                },
                    messages: {
                        name: {required: "Please enter name" },
                   
                    birthdate: {
                        required: "Please enter birthdate",
                    
                    },
                    
                    marital_status: {required: "Please select marital status" },
                    mariage_date: {required: "Please enter marriage date" },
                   
                    photo_path: {
                    extension: "Please upload a valid image (jpg, jpeg, png)",
                    maxfilesize: "Please upload image less than 2MB"
                    }
                },
                    errorPlacement: function (error, element) {
                    var $container = element.parents('.form-group').find('.validation-error');

                    $container.html(error);
                },
                    highlight: function (element) {
                        $(element).addClass('error');
                },
                    unhighlight: function (element) {
                        $(element).removeClass('error');
                    $(element).closest('.form-group').find('.validation-error').empty();
                }
            });
        });
       

        </script>

</body>
</html>