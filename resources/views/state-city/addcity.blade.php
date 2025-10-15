<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add City</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/heading.css')  }}">
    <link rel="stylesheet" href="https://use.typekit.net/qbl3xfq.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <style>

    body{
        font-family: "Exo", sans-serif;
                     font-optical-sizing: auto;
                     font-weight: 400;
                     font-style: normal;
                     letter-spacing: 0.5px;
    }
    .validation-error label {
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

        .active-class-6{
            background-color: #0dcaf0;
            color : white;
            transform: translateX(5px);
        }
        .dropdown-wrapper{
        display : none;
        }
        /* Select2 Bootstrap 5 Styling */
        .select2-container--default .select2-selection--single {
            height: 38px;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            padding: 6px 12px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #495057;
            line-height: 26px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }

        .select2-dropdown {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #0d6efd;
        }

        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        @media (max-width: 1000px) {
            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 10px;
            }
            
            .col-md-6 {
                max-width: 100%;
                padding: 0 15px;
            }
            
            .alert .d-flex {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }
            
            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>




<body class="bg-light">
    <div id="mainContent">
        @include('partials.navbar2',['shouldShowDiv' => true])

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

                    <div class="d-flex justify-content-between">
                        <div class="text-center mb-4 mt-4">
                            <a href="{{ route('state.index') }}" class="btn btn-outline-primary rounded-pill">
                                <i class="bi bi-arrow-left me-2"></i>Back to Manage states
                            </a>
                        </div>
                        <div class="text-center mb-4 mt-4">
                            <a href="{{ route('city.index') }}" class="btn btn-outline-primary rounded-pill">
                                Back to Manage Cities<i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card">

                        <div class="card-header bg-primary text-white text-center">
                            <h4 class="mb-0">
                                <i class="bi bi-plus-circle me-2"></i>Add City
                            </h4>
                        </div>

                        <div class="card-body">
                            <form id="formSubmit" action="{{ route('store.city') }}" method="post">
                                @csrf

                                <div class="mb-3 form-group">
                                    <label for="states" class="form-label">
                                        <i class="bi bi-map text-primary me-1"></i>State
                                    </label>
                                    <select name="states" id="states" class="form-select select2">
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                        <option value="{{ $state->id }}"
                                            {{ old('states', $selectedStateId ?? '') == $state->id ? 'selected' : '' }}>
                                            {{ $state->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="validation-error"></div>
                                    @error('states')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 form-group">
                                    <label for="city" class="form-label">
                                        <i class="bi bi-buildings text-primary me-1"></i>City Name
                                    </label>
                                    <input type="text" id="city" name="city" class="form-control"
                                        placeholder="Enter city name" value="{{ old('city') }}">
                                    <div class="validation-error"></div>
                                    @error('city')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check me-1"></i>Add City
                                    </button>
                                </div>
                            </form>
                        <div class="alert alert-info border-0 mt-4" style="background: linear-gradient(135deg, #d1ecf1, #bee5eb); border-radius: 7px;">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-info-circle-fill text-info me-2" style="font-size: 1.2rem;"></i>
                                    <span class="text-dark fw-medium">Is the state missing<br> from the list?</span>
                                </div>
                                <a href="{{ route('create.state') }}" class="btn btn-info  px-3 py-2">
                                    <i class="bi bi-plus-circle me-1"></i>Add New State
                                </a>
                            </div>
                        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
    jQuery(document).ready(function() {


        $('#formSubmit').validate({
            rules: {
                states: {
                    required: true
                },
                city: {
                    required: true
                },

            },
            messages: {
                state: {
                    required: "Please enter state name"
                },
                city: {
                    required: "Please enter city name"
                },
            },
            errorPlacement: function(error, element) {
                var $container = element.closest('.form-group').find('.validation-error');
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
                         url: "{{ route('store.city') }}",
                         data: formData,
                         contentType: false,
                         processData: false,
                         success: function(response){
                             if(response.status === 'success'){
                                 alert(response.message + ' => ' + response.city + ', ' + ' You can add another city now.');
                                 $('#city').val('');
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
     <script>
         $(document).ready(function() {
                     // Initialize Select2 with custom styling
                     $('.select2').select2({
                         theme: 'default',
                         width: '100%',
                         placeholder: function() {
                             return $(this).data('placeholder');
                         },
                         allowClear: false
                     });
                 });
     </script>
</body>

</html>
