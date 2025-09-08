<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <title>Edit State</title>

    <style>
           section {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>

    

    <section>
        <div class="col-lg-5 justify-content-center">
                <div class="card shadow rounded-4 justify-content-center" style="top: 20px;">
                    <div class="card-header bg-success text-white py-3 rounded-top-4">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-geo-alt-fill me-2"></i>Edit State ({{ $state->name  }})</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('state.update', $state->id) }}" method="post">
                                @csrf
                                @method('PUT')
                            <div class="mb-3">
                                <input id="statename" class="form-control form-control-lg" type="text"
                                                name="name" value="{{ $state->name }}" class='form-controll rounded-pill'
                                                placeholder="{{ empty($state->name) ? 'name is not available in database' : 'Enter name of state' }}">
                                @error('name')<div class="text-danger mt-1">{{ $message }}</div>@enderror
                            </div>

                            
                            
                            <div class="mb-3">
                                <input class="form-control form-control-lg" type="text"
                                                name="type" value="{{ $state->type }}" class='form-controll rounded-pill'
                                                placeholder="{{ empty($state->type) ? 'type is not available in database' : 'Enter type of state' }}">
                               
                            </div>
                            
                            
                            <div class="mb-3">
                                <input class="form-control form-control-lg" type="number" name="level"
                                                value="{{ $state->level }}" class='form-controll rounded-pill'
                                                placeholder="{{ empty($state->level) ? 'level is not available in database' : 'Enter level of state' }}">
                                
                            </div>
                            
                            <div class="mb-4">
                                <input class="form-control form-control-lg" type="number" step="any"
                                                name="latitude" value="{{ $state->latitude }}" class='form-controll rounded-pill'
                                                placeholder="{{ empty($state->latitude) ? 'latitude is not available in database' : 'Enter latitude of state' }}">
                                
                            </div>

                            <div class="mb-4">
                               <input class="form-control form-control-lg" type="number" step="any"
                                                name="longitude" value="{{ $state->longitude }}" class="form-control rounded-pill"
                                                placeholder="{{ empty($state->longitude) ? 'longitude is not available in database' : 'Enter longitude of state' }}">
                                
                            </div>
                            
                            <button type="submit" class="btn btn-success w-100 rounded-pill py-2">
                                <i class="bi bi-geo-alt-fill me-2"></i>Update State
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
