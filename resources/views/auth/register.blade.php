<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: 1s ease-in-out;
        }
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
        input[type="text"], input[type="email"], input[type="password"] {
             width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; 
            }
        .danger{
            color: red;
            font-size: 10px;
            margin-bottom: 5px;
            font-style: italic;
       }
        input[type="submit"] { 
            width: 100%; padding: 10px; background: #007cba; color: white; border: none; border-radius: 4px; cursor: pointer; 
        }
        input[type="submit"]:hover { 
            background: #005a87;
         }

         .msgsuccess{
            color: #198754;
            font-size: 13px;
            text-align: center;
            margin-bottom: 10px;
            padding: 10px 20px ;
            border-radius: 30px;
            background-color: #8ef7c6ff;
         }
         .msgerror{
            color: #dc3545;
            font-size: 13px;
            text-align: center;
            margin-bottom: 10px;
            padding: 10px 20px ;
            border-radius: 30px;
            background-color: #f8d7da;
         }
         .nodisplay{
            display: none;
         }

    </style>
</head>
<body>
    @if(session('success'))
        <h2 class="msgsuccess">{{ session('success') }}</h2>
    @endif

    @if(session('error'))
        <h2 class="msgerror">{{ session('error') }}</h2>
    @endif
    
    <h1>Enter Admin Details</h1>
    <form action="{{ route('register-user') }}" method="post">
        @csrf
        
        <label for="first_name">First Name:</label>
        <p class="danger"> @error('first_name')
            * {{ $message }}
        @enderror</p>
        <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}">
        

        
        <label for="last_name">Last Name:</label>
         <p class="danger"> @error('last_name')
            * {{ $message }}
        @enderror</p>
        <input type="text" name="last_name" id="last_name" value="{{ old('last_name')  }}">
        


        
        <label for="email">Email:</label>
        <p class="danger"> @error('email')
            * {{ $message }}
        @enderror</p>
        <input type="email" name="email" id="email" value="{{ old('email') }}">
       

        
        <label for="password">Password:</label>
        <p class="danger"> @error('password')
            * {{ $message }}
        @enderror</p>
        <input type="password" name="password" id="password" >
        
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>