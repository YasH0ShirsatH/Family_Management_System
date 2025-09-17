<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/heading.css')  }}">


    <title>Edit city</title>

    <style>
    section {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f8f9fa;
    }

    label {
        font-weight: bold;
        font-size: 20px;
        color: #333;
        margin-bottom: 5px;
        display: block;
        text-align: left;
        margin-left: 5px;


    }

    input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        border-radius: 20px;
        font-size: 18px;
    }

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
    </style>
</head>

<body>
    <div id="mainContent">

        @include('partials.navbar2',['shouldShowDiv' => true])


        <section>
            <div class="col-lg-5 justify-content-center">
                <div class="card shadow rounded-4 justify-content-center" style="top: 20px;">
                    <div class="card-header bg-primary text-white py-3 rounded-top-4">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-geo-alt-fill me-2"></i>Edit city ({{ $city->name  }})
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <form id="formSubmit" action="{{ route('city.update', $city->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 form-group">
                                <label for="cityname" class="form-label">Name : </label>
                                <input id="cityname" class="" type="text" name="name" value="{{ $city->name }}"
                                    class='form-controll rounded-pill'
                                    placeholder="{{ empty($city->name) ? 'name is not available in database' : 'Enter name of city' }}">
                                <div class="validation-error"></div>
                                @error('name')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="state_id">State Id :</label>
                                <input id="state_id" class="" type="number" name="state_id"
                                    value="{{ $city->state_id }}" class='form-controll rounded-pill'
                                    placeholder="{{ empty($city->state_id) ? 'state_id is not available in database' : 'Enter state_id of city' }}">

                            </div>


                            <div class="mb-4">
                                <label for="state_id">Latitude : </label>

                                <input class="" type="number" step="any" name="latitude" value="{{ $city->latitude }}"
                                    class='form-controll rounded-pill'
                                    placeholder="{{ empty($city->latitude) ? 'latitude is not available in database' : 'Enter latitude of city' }}">

                            </div>

                            <div class="mb-4">
                                <label for="state_id">Longitude : </label>

                                <input class="" type="number" step="any" name="longitude" value="{{ $city->longitude }}"
                                    class="form-control rounded-pill"
                                    placeholder="{{ empty($city->longitude) ? 'longitude is not available in database' : 'Enter longitude of city' }}">

                            </div>

                            <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">
                                <i class="bi bi-geo-alt-fill me-2"></i>Update city
                            </button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    </section>

    <!-- Bootstrap JS (Optional, for interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        jQuery(document).ready(function () {
      

            $('#formSubmit').validate({
                rules: {
                    name: { required: true },
                   
                },
                messages: {
                    name: { required: "Please enter state name" },
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