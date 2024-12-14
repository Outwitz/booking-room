<?php
session_start();
require_once('config/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="icon" href="logo.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anuphan:wght@100..700&display=swap" rel="stylesheet">
    <title>Admin Approval</title>
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

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            max-width: 1200px;
            margin: 20px auto;
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: #fff;
        }

        td {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        select, input[type=submit] {
            padding: 10px 15px;
            border: none;
            background-color: #4CAF50;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        select:hover, input[type=submit]:hover {
            background-color: #45a049;
        }

        select {
            width: auto;
        }
    </style>
</head>
<body>
    
<?php require_once('nav.php'); ?>
        <br><br>
        <h1 style="color: white;">ตารางรายการจอง</h1>
    <table>
        <tr>
            <th>เลขที่จอง</th>
            <th>ชื่อห้องที่ใช้</th>
            <th>ชื่อผู้จอง</th>
            <th>วันที่</th>
            <th>เวลา</th>
            <th>วันที่จอง/เวลา</th>
            <th>สถานะ</th>
            <th>อนุมัติ/ไม่อนุมัติ</th>
        </tr>
        <?php
        
        require('config/dbconnection.php');
        
        // ตรวจสอบว่าแอดมินเลือกการดำเนินการได้หรือไม่
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
            $roomID = $_POST['test_id'];
            
            // อัพเดทสถานะของการจอง
            $sql_update = "";
            if ($action == 'approve') {
                $sql_update = "UPDATE data_rec SET bookingsts = 'อนุมัติ' WHERE test_id = '$roomID'";
            } elseif ($action == 'reject') {
                $sql_update = "UPDATE data_rec SET bookingsts = 'ไม่อนุมัติ' WHERE test_id = '$roomID'";
            }

            if ($conn->query($sql_update) === TRUE) {
                echo "<script>
                          $(document).ready(function() {
                            Swal.fire({
                              title: 'อัพเดทสถานะสำเร็จ',
                              text: '',
                              icon: 'success',
                            });
                          });
                        </script>";
            } else {
                echo "เกิดข้อผิดพลาดในการอัพเดทสถานะ: " . $conn->error;
            }
        }

        // ดึงข้อมูลการจองที่ยังไม่ได้รับการอนุมัติจากฐานข้อมูล
        $sql = "SELECT * FROM data_rec ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["test_id"] . "</td>";
                echo "<td>" . $row["use_room_name"] . "</td>";
                echo "<td>" . $row["use_name"] . "</td>";
                echo "<td>" . date("d/m/Y", strtotime($row["date"])) . "</td>";
                echo "<td>" . $row["time"] . "</td>";
                echo "<td>" . date('d/m/Y | H:i:s', strtotime($row["timestamp"])) . "</td>"; 
                echo "<td>";
                if ($row["bookingsts"] == "รออนุมัติ") {
                    echo "<span style='color: orange;'>".$row["bookingsts"]."</span>";
                } elseif ($row["bookingsts"] == "อนุมัติ") {
                    echo "<span style='color: green;'>".$row["bookingsts"]."</span>";
                } elseif($row["bookingsts"] == "ไม่อนุมัติ") {
                    echo "<span style='color: red;'>".$row["bookingsts"]."</span>";
                } elseif($row["bookingsts"] == "ยกเลิก") {
                        echo "<span style='color: red;'>".$row["bookingsts"]."</span>";
                } else {
                    echo $row["bookingsts"]; 
                }
                echo "</td>";
                echo "<td>
                        <form action='' method='post'>
                            <input type='hidden' name='test_id' value='{$row["test_id"]}'>
                            <select name='action'>
                                <option value='approve'>อนุมัติ</option>
                                <option value='reject'>ไม่อนุมัติ</option>
                            </select>
                            <input type='submit' value='ยืนยัน'>
                        </form>
                      </td>";
                echo "</tr>";
            }
   } else {
        echo "<tr><td colspan='5'>ไม่มีข้อมูลการจองที่รอการอนุมัติ</td></tr>";
    }

    $conn->close();
    ?>
</table>
</body>
</html>
