<?php
session_start();
require_once('config/config.php');

require('config/dbconnection.php');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['MemberID'])) {
        $memberID = $_GET['MemberID'];

        $stmt = $conn->prepare("SELECT * FROM member WHERE MemberID = :memberID");
        $stmt->bindParam(':memberID', $memberID);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user) {
            echo "Member not found.";
            exit();
        }
    } else {
        echo "MemberID is not provided.";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $memberType = $_POST['memberType'];
        $phone = $_POST['phone'];
        $rank = $_POST['rank'];

        $updateStmt = $conn->prepare("UPDATE Member SET Username = :username, MemberType = :memberType, Phone = :phone, rank = :rank WHERE MemberID = :memberID");
        $updateStmt->bindParam(':username', $username);
        $updateStmt->bindParam(':memberType', $memberType);
        $updateStmt->bindParam(':phone', $phone);
        $updateStmt->bindParam(':rank', $rank);
        $updateStmt->bindParam(':memberID', $memberID);
        $updateStmt->execute();

        echo "<script>alert('Updated Successfully!');</script>";
        echo "<script>window.location.href='member_list.php'</script>";
    
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
    <title>แก้ไขข้อมูลสมาชิก</title>
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
        <h3 class="mt-4">แก้ไขข้อมูลสมาชิก</h3>
        <hr>
        <form action="" method="POST">
            <?php if (isset($user)) : ?>
                <input type="hidden" name="MemberID" value="<?php echo $user['MemberID']; ?>">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($user['Username']) ? $user['Username'] : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="memberType" class="form-label">Member Type</label>
                    <input type="text" class="form-control" id="memberType" name="memberType" value="<?php echo isset($user['MemberType']) ? $user['MemberType'] : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo isset($user['Phone']) ? $user['Phone'] : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="rank" class="form-label">Rank</label>
                    <input type="text" class="form-control" id="rank" name="rank" value="<?php echo isset($user['rank']) ? $user['rank'] : ''; ?>">
                </div>
                <a href="member_list.php" class="btn btn-secondary btn-back">กลับ</a> <!-- Back button -->
                <button type="submit" class="btn btn-primary" onclick="return confirm('คุณแน่ใจหรือไม่ว่าต้องการอัปเดตข้อมูลสมาชิกนี้ ?')">อัปเดต</button>
            <?php else : ?>
                <p>Member not found.</p>
            <?php endif; ?>
        </form>
    </div>

</body>
</html>
