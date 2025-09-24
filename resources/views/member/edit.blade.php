@if($member->status == '0')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile Inactive - Family Management System</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/heading.css') }}">
        <style>
            .active-class-31 {
                background-color: #198754;
                color: white;
                transform: translateX(5px);
            }
            .status-icon {
                font-size: 4rem;
                color: #ffc107;
                margin-bottom: 1rem;
                animation: pulse 2s infinite;
            }
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.1); }
                100% { transform: scale(1); }
            }
        </style>
    </head>
    <body class="bg-light">
        <div id="mainContent">
            @include('partials.navbar2', ['shouldShowDiv' => true])

            <div class="container py-4">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card shadow rounded-4">
                            <div class="card-header bg-warning text-dark text-center py-3 rounded-top-4">
                                <h2 class="mb-1 fw-bold"><i class="bi bi-person-slash me-2"></i>Profile Inactive</h2>
                                <p class="mb-0 opacity-75">Member profile is currently inactive</p>
                            </div>
                            <div class="card-body p-5 text-center">
                                <div class="status-icon">
                                    <i class="bi bi-person-slash"></i>
                                </div>
                                <h4 class="fw-bold text-dark mb-3">Access Restricted</h4>
                                <p class="text-muted mb-4 lead">
                                    This family member's profile is currently inactive and cannot be edited at this time.
                                </p>
                                <div class="alert alert-warning border-0 mb-4">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Contact your Database administrator to activate this profile.
                                </div>
                                <a href="{{ route('admin.members') }}" class="btn btn-primary rounded-pill px-4">
                                    <i class="bi bi-arrow-left me-2"></i>Back to Family Members
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>

@else
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
            .active-class-31{
                       background-color: #198754;
                       color : white;
                       transform: translateX(5px);
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
                                           value="{{ $member->birthdate }}">
                                       <div class="validation-error"></div>
                                       @error('birthdate')
                                           <div class="invalid-feedback">{{ $message }}</div>
                                       @enderror
                                   </div>

                                   <div class="mb-3 form-group">
                                       <label class="form-label fw-semibold"><i class="bi bi-people me-2"></i>Relation</label>
                                       <select name="relation" class="form-select rounded-pill @error('relation') is-invalid @enderror">
                                           <option value="">Select Relation</option>
                                           <option value="spouse" {{ $member->relation == 'spouse' ? 'selected' : '' }}>Spouse</option>
                                           <option value="son" {{ $member->relation == 'son' ? 'selected' : '' }}>Son</option>
                                           <option value="daughter" {{ $member->relation == 'daughter' ? 'selected' : '' }}>Daughter</option>
                                           <option value="father" {{ $member->relation == 'father' ? 'selected' : '' }}>Father</option>
                                           <option value="mother" {{ $member->relation == 'mother' ? 'selected' : '' }}>Mother</option>
                                           <option value="brother" {{ $member->relation == 'brother' ? 'selected' : '' }}>Brother</option>
                                           <option value="sister" {{ $member->relation == 'sister' ? 'selected' : '' }}>Sister</option>
                                           <option value="grandfather" {{ $member->relation == 'grandfather' ? 'selected' : '' }}>Grandfather</option>
                                           <option value="grandmother" {{ $member->relation == 'grandmother' ? 'selected' : '' }}>Grandmother</option>
                                           <option value="uncle" {{ $member->relation == 'uncle' ? 'selected' : '' }}>Uncle</option>
                                           <option value="aunt" {{ $member->relation == 'aunt' ? 'selected' : '' }}>Aunt</option>
                                           <option value="nephew" {{ $member->relation == 'nephew' ? 'selected' : '' }}>Nephew</option>
                                           <option value="niece" {{ $member->relation == 'niece' ? 'selected' : '' }}>Niece</option>
                                           <option value="cousin" {{ $member->relation == 'cousin' ? 'selected' : '' }}>Cousin</option>
                                           <option value="other" {{ $member->relation == 'other' ? 'selected' : '' }}>Other</option>
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
                                               value="1" @checked($member->marital_status == '1' && $member->relation == 'spouse')>
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

                                   <div class="mb-3 mx-3" id="photoSection">
                                       <div class="d-flex align-items-center justify-content-between p-2 bg-light rounded-3 border">
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
                                               <label class="form-label fw-semibold mb-0">Member Photo</label>
                                               <button type="button" id="removephoto" class="btn btn-outline-secondary btn-sm rounded-pill">
                                                   <i class="bi bi-x"></i>
                                               </button>
                                           </div>

                                           <div class="d-flex align-items-center gap-2">
                                               <div class="flex-shrink-0">
                                                   @if ($member->photo_path != null)
                                                       <img src="{{ asset('/uploads/images/').'/'.$member->photo_path }}"
                                                            alt="Current"
                                                            class="rounded-circle"
                                                            style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #007bff;">
                                                   @else
                                                       <img src="{{ asset('/uploads/images/noimage.png') }}"
                                                            alt="No Image"
                                                            class="rounded-circle"
                                                            style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #007bff;">
                                                   @endif
                                               </div>
                                               <div class="flex-grow-1">
                                                   @if ($member->photo_path != null)
                                                       <div class="form-check mb-2">
                                                           <input class="form-check-input" type="checkbox" name="remove_image" id="removeImageCheck">
                                                           <label class="form-check-label fw-semibold" for="removeImageCheck">
                                                               <i class="bi bi-trash"></i> Remove current image
                                                           </label>
                                                       </div>
                                                   @endif
                                                   <input type="file" name="photo_path" class="form-control form-control-sm rounded-pill" accept="image/*">
                                                   <small class="text-muted">JPG, PNG, max 2MB</small>
                                                   <div class="validation-error"></div>
                                               </div>
                                           </div>
                                       </div>
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
           const removephoto = document.getElementById('removephoto');
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

           if (removephoto) {
               removephoto.addEventListener('click', function (event) {
                   const uploadPhoto = document.getElementById('uploadPhoto');
                   if (uploadPhoto) {
                       uploadPhoto.style.display = 'none';
                       photoSection.style.display = 'block';
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
                       relation: { required: true },
                       marital_status: { required: true },
                       mariage_date: {
                           required: {
                               depends: function (element) {
                                   return $("#married").is(":checked");
                               }
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
                       relation: { required: "Please select relation" },
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

@endif
