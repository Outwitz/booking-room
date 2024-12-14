<?php 

    session_start();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anuphan:wght@100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 75rem;
            padding-top: 4.5rem;
            background-image: url('bg.jpg');
            background-size: cover;  /* Optional: Adjust the background size */
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            font-family: "Anuphan", sans-serif;
            font-optical-sizing: auto;
            font-weight: weight;
            font-style: normal;
        }
    </style>

</head>
<body>

    <?php require_once('nav.php'); ?>
    <main class="container">
    <br><br>
    <br><br>
    <div class="bg-body-tertiary p-5 rounded">

    <?php require_once('alert.php') ?>

        <h1>สมัครสมาชิก</h1>
        <hr>
        <form action="register_db.php" method="POST">
            <div>
            <label for="username">Username</label>
            <span class="col-md-4" id="basic-addon1"><i class="bi bi-person-circle"></i></span>
            <input type="text" name="username" class="form-control my-2" placeholder="username">
            </div>

            <div>
            <label for="password">Password</label>
            <span class="col-md-4" id="basic-addon1"><i class="bi bi-lock-fill"></i></span>
            <input type="password" name="password" class="form-control my-2" placeholder="password">
            <div>

            <label for="password">Confirm Password</label>
            <span class="col-md-4" id="basic-addon1"><i class="bi bi-lock-fill"></i></span>
            <input type="password" name="c_password" class="form-control my-2" placeholder="confirm password">
            </div>

            <div>
            <label for="MemberType">Member Type</label>
            <span class="col-md-4" id="basic-addon1"><i class="bi bi-person-lines-fill"></i></span>
            <input type="text" name="MemberType" class="form-control my-2" placeholder="student ,teacher or orther">
            </div>

            <div>
            <label for="Phone">Phone</label>
            <span class="col-md-4" id="basic-addon1"><i class="bi bi-phone"></i></span>
            <input type="text" name="Phone" class="form-control my-2" placeholder="phone">
            </div>
            
            <input type="hidden" name="Rank" value="0">
            <button type="submit" class="btn btn-primary my-2" name="register">ยืนยันข้อมูล</button>
        </form>
    </div>
    </main>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>