<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Family Member - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/heading.css')  }}">
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
                            <h2 class="mb-1 fw-bold"><i class="bi bi-person-gear me-2"></i>Update Family Member</h2>
                            <p class="mb-0 opacity-75">Update member of your family</p>
                        </div>
                        <div class="card-body p-4">
                            <form id="formSubmit" action="{{ route('admin-member.update', $member->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3 form-group">
                                    <label class="form-label fw-semibold"><i class="bi bi-person me-2"></i>Full
                                        Name</label>
                                    <input type="text" name="name"
                                        class="form-control rounded-pill @error('name') is-invalid @enderror"
                                        placeholder="Enter full name" value="{{ $member->name }}">
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
                                        value="{{ $member->birthdate }}" @error('birthdate')>
                                            <div class="validation-error"></div>

                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                </div>

                                <div class="mb-3 form-group">
                                    <label class="form-label fw-semibold"><i class="bi bi-heart me-2"></i>Marital
                                        Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="marital_status" id="married"
                                            value="1" {{ $member->marital_status == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="married">Married</label>
                                    </div>
                                    <div class="form-check form-group">
                                        <input class="form-check-input" type="radio" name="marital_status"
                                            id="unmarried" value="0" {{ $member->marital_status == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="unmarried">Unmarried</label>


                                    </div>
                                    <div class="validation-error"></div>
                                    @error('marital_status')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror

                                    <div class="mt-3" id="mrg_date_div"
                                        style="display: {{ $member->marital_status == '1' ? 'block' : 'none' }}">
                                        <label class="form-label fw-semibold"><i
                                                class="bi bi-calendar-heart me-2"></i>Marriage Date</label>
                                        <input type="date" name="mariage_date"
                                            class="form-control rounded-pill @error('mariage_date') is-invalid @enderror"
                                            value="{{ $member->mariage_date }}">
                                        <div class="validation-error"></div>
                                        @error('mariage_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 form-group">
                                    <label class="form-label fw-semibold"><i
                                            class="bi bi-mortarboard me-2"></i>Education
                                        (Optional)</label>
                                    <input type="text" name="education"
                                        class="form-control rounded-pill @error('education') is-invalid @enderror"
                                        placeholder="Enter education qualification" value="{{ $member->education }}">
                                    <div class="validation-error"></div>

                                    @error('education')>
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                @if ($member->photo_path != null)
                                    <div class="mb-4 mx-4" id="photoSection">
                                        <p>Do You Want To Update/Remove Member Photo? <span id="addphoto"
                                                class="  btn btn-danger mx-3 py-0 px-3 rounded-pill">Yes</span> </p>
                                    </div>
                                @endif
                                @if ($member->photo_path == null)
                                    <div class="mb-4 mx-4" id="photoSection">
                                        <p>Do You Want To Update Member Photo? <span id="addphoto"
                                                class="  btn btn-danger mx-3 py-0 px-3 rounded-pill">Yes</span> </p>
                                    </div>
                                @endif
                                <div class="mb-4 form-group" id="uploadPhoto">


                                    @if ($member->photo_path != null)
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" name="remove_image"
                                                id="removeImageCheck">
                                            <label role="button" class=" form-check-label fw-semibold"
                                                for="removeImageCheck">
                                                <i class="bi bi-trash"></i> Click here to Remove Image
                                            </label>
                                        </div>
                                    @endif


                                    <label class="form-label fw-semibold"><i class="bi bi-camera me-2"></i>Photo
                                        (Optional)</label>
                                    <p style="margin-bottom : 3px" class="ms-2 fw-semibold"> Current Photo : </p>
                                    @if ($member->photo_path != null)
                                      <img style="width : 80px; border-radius : 5px " class="mb-2 mt-1 ms-2"
                                        src="{{ asset('/uploads/images/') . '/' . $member->photo_path }}" alt="">
                                    @else
                                        <img style="width : 80px; border-radius : 5px " class="mb-2 mt-1 ms-2"
                                        src="{{ asset('/uploads/images/') . '/' .'noimage.png'}}" alt="">
                                    @endif
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
                                        <i class="bi bi-check-circle me-2"></i>Update Family Member
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
        const addphoto = document.getElementById('addphoto');
        const photoSection = document.getElementById('photoSection');


        if (addphoto) {
            addphoto.addEventListener('click', function (event) {
                const uploadPhoto = document.getElementById('uploadPhoto');
                if (uploadPhoto) {
                    uploadPhoto.style.display = 'block';
                    photoSection.style.display = 'none';
                }
            });
        }
    </script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        jQuery(document).ready(function () {
            // Custom file size validator
            $.validator.addMethod("maxfilesize", function (value, element, param) {
                if (element.files && element.files.length > 0) {
                    var fileSize = element.files[0].size;
                    var maxSizeBytes = param * 1024 * 1024;
                    return fileSize <= maxSizeBytes;
                }
                return true;
            }, "File size exceeds the allowed limit.");

            $('#formSubmit').validate({
                rules: {
                    name: { required: true },
                    birthdate: { required: true },
                    marital_status: { required: true },
                    mariage_date: {
                        required: function () {
                            return $("#married").is(":checked");
                        }
                    },
                    photo_path: {
                        extension: "jpg|jpeg|png",
                        maxfilesize: 2 // MB
                    }
                },
                messages: {
                    name: { required: "Please enter name" },
                    birthdate: { required: "Please enter birthdate" },
                    marital_status: { required: "Please select marital status" },
                    mariage_date: { required: "Please enter marriage date" },
                    photo_path: {
                        extension: "Please upload a valid image (jpg, jpeg, png)",
                        maxfilesize: "Please upload image less than 2MB"
                    }
                },
                errorPlacement: function (error, element) {
                    var $container = element.closest('.form-group').find('.validation-error');
                    if ($container.length) {
                        $container.html(error);
                    } else {
                        error.insertAfter(element);
                    }
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