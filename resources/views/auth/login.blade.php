<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
             font-family: Arial, sans-serif; max-width: 400px; margin: 50px auto; padding: 20px; 
            }
        h1 {
             text-align: center; color: #333; 
            }
        form {
             background: #f9f9f9; padding: 20px; border-radius: 8px; 
            }
        label {
             display: block; margin-bottom: 5px; font-weight: bold; 
            }
        input[type="email"], input[type="password"] {
             width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; 
            }
        input[type="checkbox"] {
             margin-right: 8px; 
            }
        input[type="submit"] { 
            width: 100%; padding: 10px; background: #007cba; color: white; border: none; border-radius: 4px; cursor: pointer; 
        }
        input[type="submit"]:hover {
             background: #005a87; 
            }
    </style>
</head>
<body>
    <h1>Admin Login Details</h1>
    <form  method="post">
        @csrf
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <input type="checkbox" name="remember_me" id="remember_me" value="Remember me">
        <label for="remember_me" style="display: inline; font-weight: normal;">Remember Me</label><br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>