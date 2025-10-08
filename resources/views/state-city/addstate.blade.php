<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add State</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/heading.css')  }}">
    <style>
        .validation-error  label {
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
        .active-class-5{
            background-color: #0dcaf0;
            color : white;
            transform: translateX(5px);
        }
    </style>
</head>

<body class="bg-light">
    <div id="mainContent">

        @include('partials.navbar2', ['shouldShowDiv' => true])

        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    <div class="text-center mb-4 mt-4">
                        <a href="{{ route('state.index') }}" class="btn btn-outline-primary rounded-pill">
                            <i class="bi bi-arrow-left me-2"></i>Back to Manage states
                        </a>
                    </div>

                    <div class="card">
                        <div class="card-header bg-primary text-white text-center">
                            <h4 class="mb-0">
                                <i class="bi bi-plus-circle me-2"></i>Add State
                            </h4>
                        </div>

                        <div class="card-body">
                            <form id="formSubmit"  method="post">
                                @csrf

                                <div class="mb-3 form-group">
                                    <label for="state" class="form-label">
                                        <i class="bi bi-map text-primary me-1"></i>State Name
                                    </label>
                                    <input type="text" id="state" name="state" class="form-control"
                                        placeholder="Enter state name" value="{{ old('state') }}">
                                        <div class="validation-error"></div>
                                    @error('state')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 form-group">
                                    <label for="type" class="form-label">
                                        <i class="bi bi-pen text-primary me-1"></i>State Type (optional)
                                    </label>
                                    <input type="text" id="type" name="type" class="form-control"
                                        placeholder="Enter state type" value="{{ old('type') }}">
                                        <div class="validation-error"></div>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="level" class="form-label">
                                        <i class="bi bi-geo-alt text-primary me-1"></i>State level (optional)
                                    </label>
                                    <input type="text" id="level" name="level" class="form-control"
                                        placeholder="Enter state level" value="{{ old('level') }}">
                                        <div class="validation-error"></div>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="latitude" class="form-label">
                                        <i class="bi bi-globe text-primary me-1"></i>State latitude (optional)
                                    </label>
                                    <input type="number" id="latitude" name="latitude" class="form-control"
                                        placeholder="Enter state latitude" value="{{ old('latitude') }}">
                                        <div class="validation-error"></div>
                                </div>
                                <div class="mb-3 form-group">
                                    <label for="longitude" class="form-label">
                                        <i class="bi bi-globe text-primary me-1"></i>State longitude (optional)
                                    </label>
                                    <input type="number" id="longitude" name="longitude" class="form-control"
                                        placeholder="Enter state longitude" value="{{ old('longitude') }}">
                                        <div class="validation-error"></div>
                                </div>

                                <div class="mb-3 form-group">
                                    <label for="country_id" class="form-label">
                                        <i class="bi bi-globe text-primary me-1"></i>Country_id (optional)
                                    </label>
                                    <input type="number" id="country_id" name="country_id" class="form-control"
                                        placeholder="Enter Country Id " value="{{ old('country_id') }}">
                                        <div class="validation-error"></div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check me-1"></i>Add State
                                    </button>
                                </div>

                                <div class="d-grid mt-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-buildings me-1 "></i>Add Corrosponding Cities
                                    </button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        jQuery(document).ready(function () {


            $('#formSubmit').validate({
                rules: {
                    state: { required: true },

                },
                messages: {
                    state: { required: "Please enter state name" },
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
<script>
             $(document).ready(function(){
                 $('#formSubmit').on('submit', function(e){
                     e.preventDefault();

                     if(!$(this).valid()){
                         return;
                     }

                     var formData = new FormData(this);
                     formData.append('_method', 'POST');
                     formData.append('_token', '{{ csrf_token() }}');

                     $.ajax({
                         type: 'POST',
                         url: "{{ route('store.state') }}",
                         data: formData,
                         contentType: false,
                         processData: false,
                         success: function(response){
                             if(response.status === 'success'){
                                 alert(response.message);
                                 window.location.href = response.redirect;
                                 $('#state').val('');
                             } else {
                                 alert('Error: ' + response.message);
                             }
                         },
                         error: function(xhr, status, error){
                             if(xhr.status === 422) {
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
