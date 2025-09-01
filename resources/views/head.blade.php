<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Enter the Information of Head of the family</h1>

    <form action="head" method="post" enctype="multipart/form-data">

    @csrf

        <!-- /// Personal info -->
        <input type="text" name="name" placeholder="Name" ><br><br>
        <input type="text" name="surname" placeholder="Surname" ><br><br>
        <input type="date" name="birthdate" id="birthdate" placeholder="Birthdate"><br><br>
        <input type="number" name="mobile" id="mobile" placeholder="Mobile Number"><br><br>
        <input type="text" name="address" id="address" placeholder="Address"><br><br>

        <label for="state">Enter State</label>
        <select name="state" id="state">
            <option value="">maharashtra</option>
        </select><br><br>

        <label for="city">Enter city</label>
        <select name="city" id="city">
            <option value="">nashik</option>
            <option value="">pune</option>
            <option value="">mumbai</option>
        </select><br><br>
        <input type="number" name="pincode" id="pincode" placeholder="Pincode"><br><br>

        <!-- ///City-State Data -->
        <label for="1">Married</label>
        <input type="radio" name="marital_status" id="1" value="1">
        <label for="0">Unmarried</label>
        <input type="radio" name="marital_status" id="0" value="0"><br><br>

        <!-- ///extra-details -->
        <input type="text" name="hobbies" id="hobbies" placeholder="Hobbies"><br><br>
        <input type="file" name="path" id="path" placeholder="Profile Picture"><br><br>
        

        <input type="submit" value="Submit">

    </form>
</body>
</html>
