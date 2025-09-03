<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 100%;
        max-width: 400px;
    }

    .header {
        background: #2c3e50;
        color: white;
        padding: 30px;
        text-align: center;
    }

    .form-content {
        padding: 30px;
    }

    h1 {
        font-size: 1.8em;
        margin: 0;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #555;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 12px;
        border: 2px solid #e1e5e9;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.3s;
        margin-bottom: 5px;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
        outline: none;
        border-color: #667eea;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        margin: 20px 0;
    }

    input[type="checkbox"] {
        margin-right: 8px;
    }

    .checkbox-label {
        font-weight: normal;
        color: #666;
    }

    input[type="submit"] {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s;
    }

    input[type="submit"]:hover {
        transform: translateY(-2px);
    }

    .danger {
        color: #e74c3c;
        font-size: 12px;
        margin-bottom: 15px;
    }

    .error {
        background: #fee;
        color: #c33;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        border-left: 4px solid #e74c3c;
    }
    .forgot-password {
        text-align: right;
        margin-bottom: 20px;
        margin-top: 10px;
    }
    .forgot-password a {
        color: #667eea;
        text-decoration: none;
    }
    .forgot-password a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Admin Login</h1>
        </div>
        <div class="form-content">
            @if (session('error'))
                <div class="error alert alert-success alert-dismissible fade show" role="alert">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
            @endif

            


            <form action="{{ route('login-user') }}" method="post">
                @csrf
                <label for="email">Email:</label>
                @error('email')
                <div class="danger">{{ $message }}</div>
                @enderror
                <input type="email" name="email" value="{{ old('email') }}" id="email">

                <label for="password">Password:</label>
                @error('password')
                <div class="danger">{{ $message }}</div>
                @enderror
                <input type="password" name="password" id="password">

                <div class="forgot-password">
                    <a href="{{ route('forgot.password') }}">Forgot Password?</a>
                </div>

                <input type="submit" value="Login">
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>