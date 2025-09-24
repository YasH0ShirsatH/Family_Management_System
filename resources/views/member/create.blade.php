<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Family Member - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/heading.css')  }}">
    <style>
        .active-class-31{
                   background-color: #198754;
                   color : white;
                   transform: translateX(5px);
               }
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
</head>

<body class="bg-light">
    <div id="mainContent">

        @include('partials.navbar2', ['shouldShowDiv' => true])


        <div class="container py-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-pill" role="alert">
                    <i class="bi bi-check-circle me-2"></i>({{ session('name') }} {{ session('surname') }}) :
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow rounded-4">
                        <div class="card-header bg-primary text-white text-center py-3 rounded-top-4">
                            <h2 class="mb-1 fw-bold"><i class="bi bi-person-plus me-2"></i>Add Family Member</h2>
                            <p class="mb-0 opacity-75">Enter members of family head
                                ({{ $users->name . " " . $users->surname }})</p>
                        </div>
                        <div class="card-body p-4">
                            <form id="formSubmit" action="{{ route('adminAddMember', $id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3 form-group">
                                    <label class="form-label fw-semibold"><i class="bi bi-person me-2"></i>Full
                                        Name</label>
                                    <input type="text" name="name"
                                        class="form-control rounded-pill @error('name') is-invalid @enderror"
                                        placeholder="Enter full name" value="{{ old('name') }}">
                                    <div class="validation-error"></div>

                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 form-group">
                                    <label class="form-label fw-semibold"><i class="bi bi-calendar3 me-2"></i>Date of
                                        Birth</label>
                                    <input type="date" name="birthdate"
                                        class="form-control rounded-pill @error('birthdate') is-invalid @enderror"
                                        value="{{ old('birthdate') }}">
                                    <div class="validation-error"></div>
                                    @error('birthdate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 form-group">
                                    <label class="form-label fw-semibold"><i class="bi bi-people me-2"></i>Relation</label>
                                    <select name="relation" class="form-select rounded-pill @error('relation') is-invalid @enderror">
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
                                    <div class="validation-error"></div>
                                    @error('relation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 form-group">
                                    <label class="form-label fw-semibold"><i class="bi bi-heart me-2"></i>Marital
                                        Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="marital_status" id="married"
                                            value="1" {{ old('marital_status') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="married">Married</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="marital_status"
                                            id="unmarried" value="0" {{ old('marital_status') == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="unmarried">Unmarried</label>
                                    </div>
                                    <div class="validation-error"></div>
                                    @error('marital_status')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror

                                    <div class="mt-3" id="mrg_date_div"
                                        style="display: {{ old('marital_status') == '1' ? 'block' : 'none' }}">
                                        <label class="form-label fw-semibold"><i
                                                class="bi bi-calendar-heart me-2"></i>Marriage Date</label>
                                        <input type="date" name="mariage_date"
                                            class="form-control rounded-pill @error('mariage_date') is-invalid @enderror"
                                            value="{{ old('mariage_date') }}">
                                        <div class="validation-error"></div>
                                        @error('mariage_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 form-group">
                                    <label class="form-label fw-semibold"><i
                                            class="bi bi-mortarboard me-2"></i>Education (Optional)</label>
                                    <input type="text" name="education"
                                        class="form-control rounded-pill @error('education') is-invalid @enderror"
                                        placeholder="Enter education qualification" value="{{ old('education') }}">
                                    <div class="validation-error"></div>
                                    @error('education')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4 form-group">
                                    <label class="form-label fw-semibold"><i class="bi bi-camera me-2"></i>Photo
                                        (Optional)</label>
                                    <input type="file" name="photo_path"
                                        class="form-control rounded-pill @error('photo_path') is-invalid @enderror"
                                        accept="image/*">
                                    <small class="form-text text-muted">Upload a clear photo (JPG, PNG, max 2MB)</small>
                                    <div class="validation-error"></div>
                                    @error('photo_path')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                                        <i class="bi bi-person-plus me-2"></i>Add Family Member
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const marriedRadio = document.getElementById('married');
            const unmarriedRadio = document.getElementById('unmarried');
            const marriageDateDiv = document.getElementById('mrg_date_div');

            function toggleMarriageDate() {
                if (marriedRadio.checked) {
                    marriageDateDiv.style.display = 'block';
                } else {
                    marriageDateDiv.style.display = 'none';
                }
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
                    name: { required: true },
                    birthdate: { required: true },
                    relation: { required: true },
                    marital_status: { required: true },
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
                    name: { required: "Please enter name" },
                    birthdate: { required: "Please enter birthdate" },
                    relation: { required: "Please select relation" },
                    marital_status: { required: "Please select marital status" },
                    mariage_date: { required: "Please enter marriage date" },
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
