<?php 

    session_start();
    require_once('config/config.php');
    
    /*if (!isset($_SESSION['userId'])) {
        header('Location: login.php');
    }

    if ($_SESSION['userRank'] !== 1) {
        header('Location: user.php');
    } */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            min-height: 75rem;
            padding-top: 4.5rem;
            min-height: 75rem;
            padding-top: 4.5rem;
            font-family: Arial, sans-serif;
            background-image: url('bg.jpg');
            background-size: cover;  /* Optional: Adjust the background size */
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
        }
    </style>

</head>
<body>

    <?php require_once('nav.php'); ?>

    <main class="container">
    <br><br>
    <div class="bg-body-tertiary p-5 rounded">
        <?php require_once('alert.php'); ?>
        <?php 
            $database = new Database();
            $userData = $database->getUser($_SESSION['userId']);
        ?>
        <h3>Welcome Admin, <?php echo $userData['Username']; ?></h3>
        <p class="lead">ท้อแท้ ทำไมต้องทำงาน</p>
    </div>
    </main>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>