<?php 

include('config/dbconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, trim($_POST["use_name"])); // Escape and trim username
    $selectedValue = $_POST["roomID"];
    $explodedValue = explode("|", $selectedValue);
    $id = $explodedValue[0];
    $name = $explodedValue[1];
    $time_room = $_POST["time_room"];
    $date = $_POST["date"];
    $phone_num = $_POST["phone_num"];

    $bookingsts = "รออนุมัติ";

    // Create SQL update statement
    $sql_check = "SELECT * FROM data_rec WHERE date = '$date' AND time = '$time_room' AND use_room_name = '$name'";
    $result = $conn->query($sql_check);

    if($result->num_rows > 0) 
    { 
        echo '<script>alert("ห้องนี้ถูกจองแล้ว")</script>'; 
        echo "<script>window.location.href='table.php'</script>";
        
    }
    else
    {   
        echo '<script>alert("จองสำเร็จ")</script>'; 
        echo "<script>window.location.href='table.php'</script>";

        $sql2 = "INSERT INTO data_rec(use_name, use_room_name, time, date, phone_num, bookingsts) VALUES ('$username','$name','$time_room', '$date','$phone_num','$bookingsts')";

        $conn->query($sql2);

    }
  }
?>