<?php
    if(isset($_GET['MemberIDdel'])) {
        $memberID = $_GET['MemberIDdel'];

        require('config/dbconnection.php');

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt_check = $conn->prepare("SELECT * FROM Member WHERE MemberID = :memberID");
            $stmt_check->bindParam(':memberID', $memberID);
            $stmt_check->execute();

            if ($stmt_check->rowCount() > 0) {
            }
            $stmt_del_member = $conn->prepare("DELETE FROM Member WHERE MemberID = :memberID");
            $stmt_del_member->bindParam(':memberID', $memberID);
            $stmt_del_member->execute();
            header("Location: member_list.php");
            exit();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "MemberIDdel is not provided.";
    }
?>
