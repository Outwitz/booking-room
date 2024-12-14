<?php
// Include database connection
include('db.php');

session_start();
$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['phone'])) {
    $new_username = $_POST['username'];
    $new_password = $_POST['password'];
    $new_phone = $_POST['phone'];

    // Update the user's profile information in the member table
    $sql = "UPDATE member SET Username = '$new_username', Password = '$new_password', Phone = '$new_phone' WHERE MemberID = $user_id";

    if ($connect->query($sql) === TRUE) {
        // Redirect back to the edit_profile.php page with a success message
        header("Location: edit_profile.php?success=1");
        exit();
    } else {
        // Redirect back to the edit_profile.php page with an error message
        header("Location: edit_profile.php?error=1");
        exit();
    }
}

// Close the database connection
$connect->close();
?>
