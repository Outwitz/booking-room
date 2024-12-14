<?php 

    session_start();
    require_once('config/config.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>

<?php require_once('nav.php'); ?> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@400;700&display=swap');
        body {
            font-family: 'Sarabun', sans-serif;
            margin: 0;
            padding: 20px;
            background-image: url('bg.jpg');
            background-size: cover;
            background-position: center;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            font-family: 'Georgia', serif;
            font-size: 28px;
            text-transform: uppercase;
        }

        form {
            display: grid;
            gap: 20px;
        }

        label {
            font-weight: bold;
            color: #555;
            font-size: 16px;
        }

        select,
        input[type="date"],
        input[type="time"],
        input[type="submit"],
        input[type="button"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4285F4;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-align: center;
        }

        input[type="submit"]:hover {
            background-color: #357AE8;
        }

        .cancel-button {
            background-color: #ff5757;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-align: center;
        }

        .cancel-button:hover {
            background-color: #e04848;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
        }

    </style>
</head>
<body>
    <br><br><br><br>
    <div class="container">
        
        <h2>แก้ไขรายการจอง</h2>
        <form method="post" action="process_edit.php">
        <?php
            if (isset($_GET['booking_id'])) {
                $booking_id = $_GET['booking_id'];
                //echo "<p>Booking ID: $booking_id</p>";
                echo '<input type="hidden" name="booking_id" value="' . $booking_id . '">';
            } else {
                echo "<p>Error: Booking ID not provided.</p>";
            }
        ?>
        <?php echo "รหัสการจอง: " . $booking_id;?>
            <!-- Rest of the form fields -->
            <div>
            <label for="date">วันที่</label>
            <span id="basic-addon1"><i class="bi bi-calendar3"></i></span>
            <input type="date" id="date" name="date" required>
            </div>
           <div>
            <label for="time">เวลา:</label>
            <span id="basic-addon1"><i class="bi bi-clock"></i></span>
            <select  id="time" name="time" required>
            <option value="08.00-11.00">08.00-11.00</option>
            <option value="11.00-14.00">11.00-14.00</option>
            <option value="14.00-15.00">14.00-15.00</option>
            <option value="15.00-18.00">15.00-18.00</option>
            </select>
            </div>
            <div>
            <label for="room_name">ชื่อห้อง:</label>
            <span  id="basic-addon1"><i class="bi bi-check2-circle"></i></span>
            <select id="room_name" name="room_name" required>
                <?php
                // Include database connection
                require('config/dbconnection.php');
                $connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $sql = "SELECT RoomName FROM room";
                $result = $connect->query($sql);
                ?>
                <?php 
                if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $roomName = $row["RoomName"];
                    echo "<option value='$roomName'>$roomName</option>";
                }
                } 
                 ?>
            </select>
            </div>
            <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
            <div class="button-container">
                <input type="button" class="cancel-button" onclick="window.location.href='booking_list.php'" value="ยกเลิก">
                <input type="submit" name="submit" value="เสร็จสิ้น">
            </div>
        </form>
    </div>
</body>
</html>