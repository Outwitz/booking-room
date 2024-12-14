
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $selectedValue = $_POST["member_type"];
    $explodedValue = explode("|", $selectedValue);
    $rank = $explodedValue[0];
    $memtype = $explodedValue[1];

    include("config/db.php");

    $sql = "INSERT INTO member (Username, Password, MemberType, Phone,Rank) VALUES ('$username', 
            '$password', '$memtype', '$phone', '$rank')";

    if ($connect->query($sql) === TRUE) {
        echo '<script>alert("User added successfully.");</script>';
        echo '<script>window.location.href = "member_list_add_user.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }

    $connect->close(); // Close the database connection
}
?>
<?php
