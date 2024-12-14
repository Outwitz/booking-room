<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name_room = $_POST['name_room'];
    $room_qt = $_POST['roomqt'];
    
    include("config/db.php");

    $sql = "INSERT INTO room (RoomName,RoomQty) VALUES ('$name_room','$room_qt')";

    if ($connect->query($sql) === TRUE) {
        echo '<script>alert("User added successfully.");</script>';
        echo '<script>window.location.href = "room_list_add_user.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }

    $connect->close(); // Close the database connection
}
?>
<?php
