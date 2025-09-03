<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        *{
            box-sizing: border-box;
        }
        .card-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #212529; /* Dark text for contrast */
        }
        .d-grid button {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #212529;
            border: none;
            transition : background 0.3s ease;

           
        }
        .d-grid button:hover {
            background: linear-gradient(135deg, #764ba2, #667eea);
            border: 1px solid #212529;
            transition : background 0.3s ease;
        }
    </style>
</head>
<body class="bg-light">

<div class="mt-5">
    @if($errors->any())
        <div class="col-12">
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">{{$error}}</div>
    @endforeach
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
    @endif

    @if(session()->has('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
</div>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h3 class="mb-0">Reset Password</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-4">We will send a link to your email to change your password</p>
                        
                        <form action="{{ route('forgot.password.Post') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control" placeholder="Enter your email" required>
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-warning btn-lg">Send Reset Link</button>
                            </div>
                        </form>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
