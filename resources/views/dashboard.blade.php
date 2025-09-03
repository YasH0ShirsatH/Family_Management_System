<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        padding: 20px;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }

    .header {
        background: #2c3e50;
        color: white;
        padding: 30px;
        text-align: center;
    }

    .content {
        padding: 40px;
    }

    h1 {
        font-size: 2.5em;
        margin-bottom: 10px;
    }

    .welcome {
        font-size: 1.2em;
        color: #555;
        margin-bottom: 30px;
    }

    .logout-btn {
        display: inline-block;
        background: #e74c3c;
        color: white;
        padding: 12px 24px;
        text-decoration: none;
        border-radius: 6px;
        transition: background 0.3s;
    }

    .logout-btn:hover {
        background: #c0392b;
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
            <h1>Dashboard</h1>
        </div>
        <div class="content">
            @if (session('error'))
                <div class="error alert alert-success alert-dismissible fade show" role="alert">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
            @endif

            <p class="welcome">Welcome Mr. {{ $user->first_name }} {{ $user->last_name }}</p>
            <a href="logout" class="logout-btn">Logout</a>
            
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>