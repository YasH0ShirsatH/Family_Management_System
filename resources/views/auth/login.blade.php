<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Family Management System</title>
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
        
        .login-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            width: 100%;
            max-width: 420px;
            border: 1px solid var(--border-color);
        }
        
        .login-header {
            background: var(--primary-color);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .login-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .login-body {
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
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        
        .btn-primary {
            background: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        
        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }
        
        .forgot-link {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .forgot-link:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }
        
        .alert {
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
        }
        
        .text-danger {
            color: var(--danger-color) !important;
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1><i class="bi bi-shield-lock"></i> Admin Login</h1>
        </div>
        
        <div class="login-body">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('login-user') }}" method="post">
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

                <div class="form-floating mb-3">
                    <input type="password" name="password" id="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Password" required>
                    <label for="password"><i class="bi bi-lock me-2"></i>Password</label>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('forgot.password') }}" class="forgot-link">
                        <i class="bi bi-question-circle me-1"></i>Forgot Password?
                    </a>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>