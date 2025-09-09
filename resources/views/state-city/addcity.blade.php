<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add City</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>


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


        
<body class="bg-light">
    <div class="container py-4">
        
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card-header bg-primary rounded mb-3 pt-2 pb-2 text-white text-center">
                       <a href="/admin/state-city/city" class="text-white text-decoration-none">
                         <h4 class="mb-0">
                            <i class="bi bi-arrow-right me-2"></i>Go  back
                        </h4>
                       </a>
                    </div>
                <div class="card">
                    
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">
                            <i class="bi bi-plus-circle me-2"></i>Add City
                        </h4>
                    </div>
                    
                    <div class="card-body">
                        <form action="{{ route('store.city') }}" method="post">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="states" class="form-label">
                                    <i class="bi bi-map text-primary me-1"></i>State
                                </label>
                                <select name="states" id="states" class="form-select">
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}"
                                            {{ old('states', $selectedStateId ?? '') == $state->id ? 'selected' : '' }}>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>



                                





                                @error('states')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="city" class="form-label">
                                    <i class="bi bi-buildings text-primary me-1"></i>City Name
                                </label>
                                <input type="text" id="city" name="city" class="form-control" 
                                       placeholder="Enter city name" value="{{ old('city') }}">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>