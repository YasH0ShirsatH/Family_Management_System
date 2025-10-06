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
        .active-class-2{
            background-color: #198754;
            color : white;
            transform: translateX(5px);
        }
    </style>

</head>
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
                            <p class="mb-0 mt-2">Update family head information(City/State)</p>
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

                            <form id="updateForm" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')


                                <div class="mb-3 form-group">
                                    <label class="form-label fw-semibold">Address</label>
                                    <textarea name="address" class="form-control rounded-4" rows="3"
                                        required>{{ $head->address }}</textarea>
                                    <div class="validation-error"></div>
                                    @error('address')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3 form-group">
                                        <label class="form-label fw-semibold">State</label>
                                        <div class="validation-error"></div>
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
                                    <div class="col-md-4 mb-3 form-group">
                                        <label class="form-label fw-semibold">City</label>
                                        <div class="validation-error"></div>
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
                                    <div class="col-md-4 mb-3 form-group">
                                        <label class="form-label fw-semibold">Pincode</label>
                                        <div class="validation-error"></div>
                                        <input type="number" name="pincode" class="form-control rounded-pill"
                                            value="{{ $head->pincode }}" required>
                                        @error('pincode')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <hr class="my-4">

                        @error('path')<div class="text-danger">{{ $message }}</div>@enderror



                        <button type="submit" class="btn mb-5 py-3  mx-auto btn-primary rounded-pill"
                            style="width : 80%">
                            <i class="bi bi-check-circle me-2"></i>Update Family Head
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
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


    <script>
    jQuery(document).ready(function() {


        $('#updateForm').validate({
            submitHandler: function(form) {
                var formData = new FormData(form);
                formData.append('_method', 'PUT');
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin-member.postCityState',$head->id) }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if (response.status === 'success') {
                            alert(response.message + ' User: ' + response.name + ' ' + response.surname);
                            window.location.href = '/admin';
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
            },
            rules: {

                address: {
                    required: true
                },
                state: {
                    required: true
                },
                city: {
                    required: true
                },
                pincode: {
                    required: true,
                    rangelength: [6, 6]
                },


            },
            messages: {

                address: {
                    required: "Please enter your address"
                },
                state: {
                    required: "Please select a state"
                },
                city: {
                    required: "Please select a city"
                },
                pincode: {
                    required: "Please enter your pincode",
                    rangelength: "Pincode must be 6 digits"
                },

            },


            errorPlacement: function(error, element) {
                var $container;

                if (element.attr("name") === "hobbies[]") {
                    $container = element.closest('.form-group').find('.validation-error');
                } else {
                    $container = element.closest('.form-group').find('.validation-error');
                }

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
</body>

</html>
