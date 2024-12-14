<?php
session_start();
require_once('config/config.php');

require('config/dbconnection.php');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['RoomID'])) {
        $roomID = $_GET['RoomID'];

        $stmt = $conn->prepare("SELECT * FROM room WHERE RoomID = :roomID");
        $stmt->bindParam(':roomID', $roomID);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            echo "Room not found.";
            exit();
        }
    } else {
        echo "RoomID is not provided.";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $room_name = $_POST['room_name'];
        $roomqty = $_POST['roomqty'];
        
        $updateStmt = $conn->prepare("UPDATE room SET RoomName = :roomname, RoomQty = :roomqty WHERE RoomID = :roomID");
        $updateStmt->bindParam(':roomname', $room_name);
        $updateStmt->bindParam(':roomqty', $roomqty);
        $updateStmt->bindParam(':roomID', $roomID);
        $updateStmt->execute();

        echo "<script>alert('Updated Successfully!');</script>";
        echo "<script>window.location.href='room_list.php'</script>";
    
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <main class="container">
    <div class="bg-body-tertiary p-5 rounded">
        <?php 
            $database = new Database();
            $userData = $database->getUser($_SESSION['userId']);
        ?>
        <hr>
        <h3>Welcome Admin, <?php echo $userData['Username']; ?></h3>
    </div>
    </main>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลห้องประชุม</title>
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
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
        }

        .btn-back {
            margin-right: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h3 class="mt-4">แก้ไขข้อมูลห้องประชุม</h3>
        <hr>
        <form action="" method="POST">
            <?php if (isset($user)) : ?>
                <input type="hidden" name="RemberID" value="<?php echo $user['RoomID']; ?>">
                <div class="mb-3">
                    <label for="room_name" class="form-label">ชื่อห้องประชุม</label>
                    <input type="text" class="form-control" id="room_name" name="room_name" value="<?php echo isset($user['RoomName']) ? $user['RoomName'] : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="roomqty" class="form-label">ความจุห้องประชุม</label>
                    <input type="text" class="form-control" id="roomqty" name="roomqty" value="<?php echo isset($user['RoomQty']) ? $user['RoomQty'] : ''; ?>">
                </div>

                <a href="room_list.php" class="btn btn-secondary btn-back">กลับ</a> <!-- Back button -->
                <button type="submit" class="btn btn-primary" onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการอัปเดตข้อมูลสมาชิกนี้ ?')">อัปเดต</button>
            <?php else : ?>
                <p>Member not found.</p>
            <?php endif; ?>
        </form>
    </div>

</body>
</html>
