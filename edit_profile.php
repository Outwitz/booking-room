<?php 
    session_start();
    require_once('config/config.php');
    if (isset($_SESSION['userId'])) {
        $user_id = $_SESSION['userId'];
    } else {
        echo "User ID not found in session.";
    }

    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<div class="alert alert-success" role="alert">Profile updated successfully!</div>';
    } elseif (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<div class="alert alert-danger" role="alert">Error updating profile. Please try again.</div>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('nav.php'); ?> 

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลส่วนตัว</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="logo.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anuphan:wght@100..700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@400;700&display=swap');
        body {
            background-color: #f2f2f2;
            padding: 20px;
            background-image: url('bg.jpg');
            background-size: cover;
            background-position: center;
            font-family: "Anuphan", sans-serif;
            font-optical-sizing: auto;
            font-weight: weight;
            font-style: normal;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: black;
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-label {
            font-size: 18px;
            font-weight: bold;
            color: black;
        }
        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .invalid-feedback {
            display: none;
            color: red;
            margin-top: 5px;
            font-size: 14px;
        }
        .btn-primary {
            background-color: #4285F4;
            border: none;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #357AE8;
        }
        .btn-secondary {
            background-color: red;
            border: none;
            border-radius: 5px;
        }
        .btn-secondary:hover {
            background-color: lightcoral;
        }
        .alert {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <br><br>
    <div class="container">
        <h1>แก้ไขข้อมูลส่วนตัว</h1>
        <?php
            include('config/db.php'); //เชื่อมดาต้าเบส
            if (isset($_SESSION['userId'])) {
                $user_id = $_SESSION['userId'];
            } else {
                echo "User ID not found in session.";
            }
            $sql = "SELECT Username, Password, Phone FROM member WHERE MemberID = $user_id";
            $result = $connect->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $username = $row['Username'];
                $password = $row['Password'];
                $phone = $row['Phone'];
            }

        ?>
        <form method="post" action="edit_profile_process.php" onsubmit="return validateForm()">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <span class="col-md-4" id="basic-addon1"><i class="bi bi-person-circle"></i></span>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <span class="col-md-4" id="basic-addon1"><i class="bi bi-lock-fill"></i></span>
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <span class="col-md-4" id="basic-addon1"><i class="bi bi-lock-fill"></i></span>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="<?php echo $password; ?>">
                <div id="passwordError" class="invalid-feedback">Passwords do not match.</div>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <span class="col-md-4" id="basic-addon1"><i class="bi bi-phone"></i></span>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
            <a href="javascript:history.back()" class="btn btn-secondary cancel-button">Cancel</a>
        </form>
    </div>
    <script>
        function validateForm() {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            var passwordError = document.getElementById('passwordError');

            if (password !== confirmPassword) {
                passwordError.style.display = 'block';
                return false;
            } else {
                passwordError.style.display = 'none';
                return true;
            }
        }
    </script>
</body>
</html>
