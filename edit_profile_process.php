<?php
include('config/db.php'); // Include database connection
session_start();
$user_id = $_SESSION['memberid'];

$data_rec_user_id = $_SESSION['datarec_name'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['phone'])) {
        $new_username = $_POST['username'];
        $new_password = $_POST['password'];
        $new_phone = $_POST['phone'];

        // Use prepared statements to prevent SQL injection
        $sql = "UPDATE member SET Username = ?, Password = ?, Phone = ? WHERE MemberID = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("sssi", $new_username, $new_password, $new_phone, $user_id);

        $sqld = "UPDATE data_rec SET use_name = '$new_username' WHERE use_name = '$data_rec_user_id'";
        $stmtd = $connect->prepare($sqld);

        if ($stmt->execute()) {
            $stmtd->execute();
            // JavaScript alert for success message as a pop-up
            echo "<script>alert('Profile updated successfully Please log in again.');</script>";
            // Redirect back to edit_profile.php after the alert
            echo "<script>window.location.href = 'logout.php?success=1';</script>";
        } else {
            echo "Error updating profile: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Form fields not set.";
    }

    // Close the database connection
    $connect->close();
} else {
    echo "Invalid request method.";
}
?>
