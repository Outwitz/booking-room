<?php

session_start();
require_once('config/config.php');

require('config/dbconnection.php');
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
         echo "Connection failed: " . $e->getMessage();
    }

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
    <title>ข้อมูลสมาชิก</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
    <link rel="icon" href="logo.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anuphan:wght@100..700&display=swap" rel="stylesheet">

</head>
<body>
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
        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #F5F5F5;
            box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;
        }
    </style>
<?php require_once('nav.php'); ?>
    <div class="container">
        <center>
            <h3 class="mt-4">ตารางข้อมูลสมาชิก</h3>
        </center>
        <hr>
        <table id="myTable" class="table table-striped"">
            <thead>
                <th>ID</th>
                <th>USERNAME</th>
                <th>MEMBERtype</th>
                <th>PHONE</th>
                <th>RANK</th>
                <th>EDIT</th>
                <th>DELETE</th>
            </thead>
            <tbody>
        <?php
            $stmt = $conn->query("select * from member");
            $stmt->execute();

            $users = $stmt->fetchALL();
            foreach($users as $user){

        ?>
            <tr>
                <td><?php echo $row['MemberID']?></td>
                <td><?php echo $user['Username']?></td>
                <td><?php echo $user['MemberType']?></td>
                <td><?php echo $user['Phone']?></td>
                <td><?php echo $user['rank']?></td>
                <td><a href="member_list_update.php?MemberID=<?php echo $user['MemberID']; ?>" class="btn btn-primary">Edit</a></td>
                <td><a href="member_list_del.php?MemberIDdel=<?php echo $user['MemberID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this member?')">Delete</a></td>
            </tr>
        <?php
        }
        ?>
            </tbody>
        </table>
        <a href="member_list_add_user.php" class="btn btn-success">Go to Insert</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
</body>
</html>