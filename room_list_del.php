<?php
    if(isset($_GET['RoomIDdel'])) {
        $roomID = $_GET['RoomIDdel'];

        require('config/dbconnection.php');

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt_check = $conn->prepare("SELECT * FROM room WHERE RoomID = :roomID");
            $stmt_check->bindParam(':roomID', $roomID);
            $stmt_check->execute();

            if ($stmt_check->rowCount() > 0) {
            }
            $stmt_del_member = $conn->prepare("DELETE FROM room WHERE RoomID = :roomID");
            $stmt_del_member->bindParam(':roomID', $roomID);
            $stmt_del_member->execute();
            header("Location: room_list.php");
            exit();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "MemberIDdel is not provided.";
    }
?>
