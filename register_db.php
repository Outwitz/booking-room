<?php 

    session_start();
    require_once('config/config.php');

    $database = new Database();

    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $MemberType = $_POST['MemberType'];
        $Phone = $_POST['Phone'];
        $rank = $_POST['Rank'];
        $database->regUser($username, $password, $c_password, $MemberType, $Phone, $rank);
    }

?>