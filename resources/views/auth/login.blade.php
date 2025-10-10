<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/qbl3xfq.css">
    <style>
        .new-font{
            font-family: "lora", serif;
            font-weight: 400;
            font-style: normal;
        }
    </style>
</head>
   

<body class="bg-light d-flex align-items-center min-vh-100">
    <div class="container" >
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow rounded-4">
                    <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                        <h2 class="mb-0 fw-bold new-font"><i class="bi bi-shield-lock me-2"></i>Admin Login</h2>
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

                        <form action="{{ route('login-user') }}" method="post">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email Address</label>
                                <input type="email" name="email" value="{{ old('email') }}" id="email" 
                                       class="form-control rounded-pill @error('email') is-invalid @enderror" 
                                       placeholder="Enter your email" required>
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <input type="password" name="password" id="password" 
                                       class="form-control rounded-pill @error('password') is-invalid @enderror" 
                                       placeholder="Enter your password" required>
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end mb-3">
                                <a href="{{ route('forgot.password') }}" class="text-primary text-decoration-none">
                                    <i class="bi bi-question-circle me-1"></i>Forgot Password?
                                </a>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>