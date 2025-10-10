<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Address - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.typekit.net/qbl3xfq.css">

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
        @include('partials.navbar2',['shouldShowDiv' => true])

        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow rounded-4">
                        <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                            <h2 class="mb-0 fw-bold"><i class="bi bi-geo-alt me-2"></i>Edit Address</h2>
                            <p class="mb-0 mt-2">Update address information</p>
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

                            <form id="addressForm" action="{{ route('admin.address.update', $head->id) }}" method="post">
                                @csrf
                                @method('PUT')

                                <div class="mb-3 form-group">
                                    <label class="form-label fw-semibold">Address</label>
                                    <textarea name="address" class="form-control rounded-4" rows="3" placeholder="Enter complete address">{{ $head->address }}</textarea>
                                    <div class="validation-error"></div>
                                    @error('address')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 form-group">
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
                                    <div class="col-md-6 mb-3 form-group">
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
                                </div>

                                <div class="mb-4 form-group">
                                    <label class="form-label fw-semibold">Pincode</label>
                                    <input type="text" maxlength="6" name="pincode" class="form-control rounded-pill" placeholder="Enter pincode" value="{{ $head->pincode }}">
                                    <div class="validation-error"></div>
                                    @error('pincode')<div class="text-danger">{{ $message }}</div>@enderror
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                                        <i class="bi bi-check-circle me-2"></i>Update Address
                                    </button>
                                    <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary rounded-pill">
                                        <i class="bi bi-arrow-left me-2"></i>Back to Families
                                    </a>
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

    <script>
    $(document).ready(function() {
        // State-City dropdown handling (same as newUpdate.blade.php)
        $('#stateSelect').on('change', function() {
            const stateName = $(this).val();
            $('#citySelect').html('<option value="">Select City</option>');

            if (stateName) {
                $.ajax({
                    url: `/get-cities/${stateName}`,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(key, city) {
                            $('#citySelect').append(`<option value="${city.name}">${city.name}</option>`);
                        });
                    },
                    error: function() {
                        console.error('Error loading cities');
                    }
                });
            }
        });

        // Validation (same rules as newUpdate.blade.php)
        $('#addressForm').validate({
            rules: {
                address: "required",
                state: "required",
                city: "required",
                pincode: { required: true, digits: true, minlength: 6, maxlength: 6 }
            },
            messages: {
                address: "Please enter address",
                state: "Please select state",
                city: "Please select city",
                pincode: { required: "Please enter pincode", digits: "Only numbers allowed", minlength: "Must be 6 digits", maxlength: "Must be 6 digits" }
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
</body>
</html>
