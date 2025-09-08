<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <title>Edit city</title>

    <style>
    section {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f8f9fa;
    }
    label{
        font-weight: bold;
        font-size: 20px;
        color: #333;
        margin-bottom: 5px;
        display: block;
        text-align: left;
        margin-left: 5px;
        
        
    }
    input{
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        border-radius: 20px;
        font-size : 18px;
    }
    </style>
</head>

<body>



    <section>
        <div class="col-lg-5 justify-content-center">
            <div class="card shadow rounded-4 justify-content-center" style="top: 20px;">
                <div class="card-header bg-success text-white py-3 rounded-top-4">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-geo-alt-fill me-2"></i>Edit city ({{ $city->name  }})</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('city.update', $city->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="cityname" class="form-label">Name : </label>
                            <input id="cityname" class="" type="text" name="name"
                                value="{{ $city->name }}" class='form-controll rounded-pill'
                                placeholder="{{ empty($city->name) ? 'name is not available in database' : 'Enter name of city' }}">
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

                            <input class="" type="number" step="any" name="latitude"
                                value="{{ $city->latitude }}" class='form-controll rounded-pill'
                                placeholder="{{ empty($city->latitude) ? 'latitude is not available in database' : 'Enter latitude of city' }}">

                        </div>

                        <div class="mb-4">
                            <label for="state_id">Longitude : </label>

                            <input class="" type="number" step="any" name="longitude"
                                value="{{ $city->longitude }}" class="form-control rounded-pill"
                                placeholder="{{ empty($city->longitude) ? 'longitude is not available in database' : 'Enter longitude of city' }}">

                        </div>

                        <button type="submit" class="btn btn-success w-100 rounded-pill py-2">
                            <i class="bi bi-geo-alt-fill me-2"></i>Update city
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS (Optional, for interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>