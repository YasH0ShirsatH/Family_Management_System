<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Family Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --success-color: #059669;
            --danger-color: #dc2626;
            --warning-color: #d97706;
            --light-bg: #f8fafc;
            --dark-text: #1e293b;
            --border-color: #e2e8f0;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, var(--light-bg) 0%, #e2e8f0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        .forgot-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            width: 100%;
            max-width: 420px;
            border: 1px solid var(--border-color);
        }
        
        .forgot-header {
            background: var(--warning-color);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .forgot-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .forgot-body {
            padding: 2rem;
        }
        
        .form-floating {
            margin-bottom: 1rem;
        }
        
        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 0.75rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        
        .form-control:focus {
            border-color: var(--warning-color);
            box-shadow: 0 0 0 3px rgba(217, 119, 6, 0.1);
        }
        
        .btn-warning {
            background: var(--warning-color);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            color: white;
        }
        
        .btn-warning:hover {
            background: #b45309;
            transform: translateY(-1px);
            color: white;
        }
        
        .alert {
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        
        .text-danger {
            color: var(--danger-color) !important;
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }
        
        .info-text {
            color: var(--secondary-color);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .back-link {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        
        .back-link:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="forgot-container">
        <div class="forgot-header">
            <h1><i class="bi bi-key"></i> Reset Password</h1>
        </div>
        
        <div class="forgot-body">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endforeach
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            <p class="info-text">
                <i class="bi bi-info-circle me-2"></i>
                We'll send a password reset link to your email address
            </p>
            
            <form action="{{ route('forgot.password.Post') }}" method="post">
                @csrf
                
                <div class="form-floating mb-3">
                    <input type="email" name="email" value="{{ old('email') }}" id="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           placeholder="name@example.com" required>
                    <label for="email"><i class="bi bi-envelope me-2"></i>Email Address</label>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-grid">
                    <button type="submit" class="btn btn-warning btn-lg">
                        <i class="bi bi-send me-2"></i>Send Reset Link
                    </button>
                </div>
            </form>
            
            <a href="/login" class="back-link">
                <i class="bi bi-arrow-left"></i> Back to Login
            </a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
