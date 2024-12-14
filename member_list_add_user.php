<?php 

    session_start();
    require_once('config/config.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <main class="container">
    <div class="bg-body-tertiary p-5 rounded">
       
        <h3>Welcome Admin</h3>
    </div>
    </main>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="icon" href="logo.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('bg.jpg');
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }
        input[type="text"],
        input[type="password"],
        select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
            font-size: 14px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .cancel-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
            font-size: 14px;
        }
        .cancel-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>เพิ่มสมาชิก</h2>
        <form method="POST" action="member_list_add_process.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="text" id="password" name="password" required>

            <label for="member_type">Member Type:</label>
            <select id="member_type" name="member_type">
                <option value="1|Student">Student</option>
                <option value="1|Teacher">Teacher</option>
                <option value="0|Admin">Admin</option>
                
            </select>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required pattern="\d{10}" title="Please enter 10-digit phone number">

            <input type="submit" name="submit" value="submit">
            <a href="member_list.php" class="cancel-btn">Cancel</a>
        </form>
    </div>
    <script>

        function validateForm() {
            var phoneInput = document.getElementById("phone").value;
            var phonePattern = /\d{10}/;

            if (!phonePattern.test(phoneInput)) {
                alert("Please enter a 10-digit phone number.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
