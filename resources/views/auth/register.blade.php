<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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

    input[type="text"],
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

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        outline: none;
        border-color: #667eea;
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
        margin-top: 10px;
    }

    input[type="submit"]:hover {
        transform: translateY(-2px);
    }

    .danger {
        color: #e74c3c;
        font-size: 12px;
        margin-bottom: 15px;
    }

    .success {
        background: #d4edda;
        color: #155724;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        border-left: 4px solid #28a745;
    }

    .error {
        background: #fee;
        color: #c33;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        border-left: 4px solid #e74c3c;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Admin Registration</h1>
        </div>
        <div class="form-content">
            @if(session('success'))
            <div class="success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
            <div class="error">{{ session('error') }}</div>
            @endif

            <form action="{{ route('register-user') }}" method="post">
                @csrf

                <label for="first_name">First Name:</label>
                @error('first_name')
                <div class="danger">{{ $message }}</div>
                @enderror
                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}">

                <label for="last_name">Last Name:</label>
                @error('last_name')
                <div class="danger">{{ $message }}</div>
                @enderror
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}">

                <label for="email">Email:</label>
                @error('email')
                <div class="danger">{{ $message }}</div>
                @enderror
                <input type="email" name="email" id="email" value="{{ old('email') }}">

                <label for="password">Password:</label>
                @error('password')
                <div class="danger">{{ $message }}</div>
                @enderror
                <input type="password" name="password" id="password">

                <input type="submit" value="Register">
            </form>
        </div>
    </div>
</body>

</html>