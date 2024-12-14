<?php 

    session_start();
    require('config/config.php');
    // Example usage:
    $database = new Database();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "web icon" type = "x-icon" href="logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anuphan:wght@100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <title>หน้าแสดงห้องประชุม</title>
    <style>
        body {
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

        h1 {
            color: #000000;
            text-align: center;
            background: linear-gradient(to right, #d4ffb4, #96ff91);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th{
            background-color: #04AA6D;
            color: white;
            text-align: center;
        }
        td{
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        tr{
            background-color: #F5F5F5;
        }
    </style>
</head>
<body>
<?php require_once('nav.php'); ?> 
      <br><br>
    <div class="container">
        <h1>รายชื่อห้องประชุม</h1>
        <table>
            <tr>
                <th>เลขห้อง</th>
                <th>ชื่อห้อง</th>
                <th>ความจุ</th>
            </tr>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            
            <?php
            include('config/dbconnection.php');
            // สร้างคำสั่ง SQL เพื่อดึงข้อมูลห้องประชุม
            $sql = "SELECT RoomID, RoomName, RoomQty FROM room";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["RoomID"] . "</td>
                            <td>" . $row["RoomName"] . "</td>
                            <td>" . $row["RoomQty"] . "</td>
                        </tr>";
                }
            }
            echo "</table>";
            ?>
        </table>

        <!-- Booking form -->
<form  action= "table_process.php" method="post">
  <fieldset> <legend>จองห้องประชุม</legend> 
  <div class="col-md-4">
      <label for="use_name" class="form-label">ชื่อผู้จอง</label>
      <span class="col-md-4" id="basic-addon1"><i class="bi bi-person-circle"></i></span>
      <input type="text" class="form-control" id="use_name" name="use_name" required>
    </div>

    <div class="col-md-4">
      <label for="phone_num" class="form-label">เบอร์โทรศัพท์</label>
      <span class="col-md-4" id="basic-addon1"><i class="bi bi-phone"></i></span>
      <input type="text" class="form-control" id="phone_num" name="phone_num" required>
    </div>

    <div class="col-md-4">
      <label for="roomID" class="form-label">เลือกห้อง</label>
      <span class="col-md-4" id="basic-addon1"><i class="bi bi-check2-circle"></i></span>
      <select class="form-control" id="roomID" name="roomID" required>
        <option value="" disabled selected style="color: #888;">กรุณาเลือกห้อง</option>
        <?php
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $sql = "SELECT RoomID, 	RoomName FROM room";
        $result = $conn->query($sql);
        ?>
        <?php 
        if ($result->rowCount() > 0) {
          while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $roomID = $row["RoomID"];
            $roomName = $row["RoomName"];
            echo "<option value='$roomID|$roomName'>$roomName</option>";
          }
        } 
        ?>
      </select>
    </div>

    <div class="col-md-4">
      <label for="date" class="form-label">วันที่</label>
      <span class="col-md-4" id="basic-addon1"><i class="bi bi-calendar3"></i></span>
      <input type="date" id="date" name="date" required class="form-control">
    </div>

    <div class="col-md-4">
      <label for="time_room" class="form-label">เวลา</label>
      <span class="col-md-4" id="basic-addon1"><i class="bi bi-clock"></i></span>
      <select class="form-control" id="time_room" name="time_room" required>
        <option value="08.00-11.00">08.00-11.00</option>
        <option value="11.00-14.00">11.00-14.00</option>
        <option value="14.00-15.00">14.00-15.00</option>
        <option value="15.00-18.00">15.00-18.00</option>
      </select>
    </div>
    <br><br>
    <div class="d-grid gap-2 col-1 mx-auto">
    <button type="submit" name="submit" class="btn btn-primary">จอง</button>
    </div>
  </fieldset>
</form>
    </div>
</body>
</html>
