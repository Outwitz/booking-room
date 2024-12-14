<?php 

    session_start();
    require_once('config/config.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php require_once('nav.php'); ?> 
    <br><br>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการจองของฉัน</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anuphan:wght@100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <link rel="icon" href="logo.png" type="image/x-icon">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@400;700&display=swap');
        body {
           
            padding: 20px;
            font-family: "Anuphan", sans-serif;
            font-optical-sizing: auto;
            font-weight: weight;
            font-style: normal;
            background-image: url('bg.jpg');
            background-size: cover;  /* Optional: Adjust the background size */
            background-repeat: no-repeat;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-family: "Anuphan", sans-serif;
            font-optical-sizing: auto;
            font-weight: weight;
            font-style: normal;
            
        }
        h2 {
            color: #000;
            margin-bottom: 20px;
            text-align: center;
            background: linear-gradient(to right, #d4ffb4, #96ff91);
            font-size: 28px;
            font-weight: bold;
            letter-spacing: 1px;
            padding: 8px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        .booking-item {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .booking-item p {
            margin: 5px 0;
        }
        .status-label {
            font-weight: bold;
            margin-right: 10px;
        }
        .status-อนุมัติ {
            color: green;
            font-weight: bold;
        }

        .status-รออนุมัติ {
            color: orange;
            font-weight: bold;
        }

        .status-ยกเลิก {
            color: red;
            font-weight: bold;
        }
        .cancel-button {
            background-color: #ff5757;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        .cancel-button:hover {
            background-color: #e04848;
        }
        .edit-button {
            background-color: #4285F4;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        .edit-button:hover {
            background-color: #357AE8;
        }
        .back-button {/* ปุ่มกลับหน้าหลัก */
            display: block;
            width: 100px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .back-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>รายการจองของฉัน</h2>
        <?php
            include('config/db.php'); //เชื่อมดาต้าเบส
            // ใส่ผู้ใช้ปัจจุบัน
             // เปลี่ยนให้ตรงกับ user
             $user_name = $_SESSION['userId'];
             echo "Hello, " . $user_name;
            // $sql = "SELECT * FROM bookings WHERE user_id = $user_id ORDER BY booking_date DESC";
            $sql = "SELECT * FROM data_rec WHERE use_name = '$user_name'";

            $result = $connect->query($sql);
            
        if ($result->num_rows > 0) {
            
            // แสดงผล
            while ($row = $result->fetch_assoc()) {
                $date = date_create($row['date']);
                echo "<div class='Booking-item'>";
                echo "<p><strong>รหัสการจอง:</strong> " . $row["test_id"] . "</p>";
                echo "<p><strong>ชื่อห้องประชุม:</strong> " . $row["use_room_name"] . "</p>";
                echo "<p><strong>วันที่:</strong> " . $date->format('d/m/Y') . "</p>";
                echo "<p><strong>เวลา:</strong> " . $row["time"] . "</p>";
                echo "<p><strong>ชื่อผู้จอง:</strong> " . $row["use_name"] . "</p>";
                echo "<p><strong>เบอร์โทร:</strong> " . $row["phone_num"] . "</p>";
                echo "<p class='status-label'>สถานะการจอง: <span class='status-{$row["bookingsts"]}'>" . ucfirst($row["bookingsts"]) . "</span></p>";
                echo "<hr>";

                // ฟอร์มยกเลิก/แก้ไขการจองถ้าสถานะเป็น รออนุมัติ
                if ($row["bookingsts"] == "รออนุมัติ") {
                    echo '<form method="post">';
                    // ปุ่มแก้ไขข้อมูลการจอง
                    echo '<input type="hidden" name="BookingID" value="' . $row["test_id"] . '">';
                    echo '<a href="edit_booking.php?booking_id=' . $row["test_id"] . '" class="edit-button">แก้ไข</a>';
                    // ปุ่มยกเลิกการจอง
                    echo '<input type="hidden" name="BookingID" value="' . $row["test_id"] . '">';
                    echo '<input type="submit" name="cancel_booking" value="ยกเลิกการจอง" class="cancel-button" onclick="return confirmCancellation();">';
                    echo '</form>';
                }
                
                echo "</div>"; // ปิด booking-item div
            }
            echo '<a href="index.php" class="back-button">กลับหน้าหลัก</a>'; //ปุ่มกลับหน้าหลัก
        } else {
            echo "<p>ไม่พบรายการจอง.</p>";
        }
        // ยกเลิกการจอง
        if (isset($_POST['cancel_booking'])) {
                $booking_id = $_POST['BookingID'];
                //ไปหน้า cancel_booking.php
                header("Location: cancel_booking.php?booking_id=$booking_id");
                exit();
            }
            $connect->close();
        
        ?>
    </div>

    <script>
        // JavaScript ยืนยันการยกเลิก
        function confirmCancellation() {
            return confirm("ยืนยันการยกเลิกการจอง?");
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>