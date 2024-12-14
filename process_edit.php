<?php
include('config/db.php'); // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $booking_id = $_POST['booking_id']; // Get booking ID from the form
    $date = $_POST['date'];
    $time = $_POST['time'];
    // $start_time = $_POST['start_time'];
    // $end_time = $_POST['end_time'];
    $room_name = $_POST['room_name'];

    // Update booking details in the database
    $sql = "UPDATE data_rec SET use_room_name = '$room_name', date = '$date', time = '$time' WHERE test_id = '$booking_id'";
            
    if ($connect->query($sql) === TRUE) {
        // JavaScript alert for success message as a pop-up
        echo "<script>alert('Booking updated successfully');</script>";
        // Redirect back to booking_list.php after the alert
        echo "<script>window.location.href = 'booking_list.php';</script>";
    } else {
        echo "Error updating booking: " . $connect->error;
    }

    $connect->close(); // Close the database connection
}
?>
