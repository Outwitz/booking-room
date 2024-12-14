<?php 

    session_start();
    require_once('config/config.php');
    // Example usage:
    $database = new Database();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anuphan:wght@100..700&display=swap" rel="stylesheet">
    

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
    <div class="bg-body-tertiary p-5 rounded">
        <br><br>
        <h1>ระบบจองห้องประชุม</h1>
        <p class="lead">ระบบจองห้องประชุมเป็นเครื่องมือที่มีประโยชน์สำหรับองค์กรที่มีห้องประชุมหลายห้อง ช่วยให้จัดการการจองห้องประชุมได้อย่างมีประสิทธิภาพ สะดวก รวดเร็ว และประหยัดเวลา
        </p>
        <br><br>
        <img src="img/index.png" width="800" height="400" align="center">
    </div>
    </main>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>