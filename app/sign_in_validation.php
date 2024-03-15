<?php
session_start();

require "connection.php";

if (isset($_POST["password"])) {
    $password = htmlspecialchars(trim($_POST["password"]));

    $mysqli_admin_response = $connection->query("SELECT * FROM admins WHERE admin_pwd = '$password'");

    $mysqli_admin_data = $mysqli_admin_response->fetch_array(MYSQLI_ASSOC);

    if ($mysqli_admin_data === NULL) {
        header("Location: ../sign_in.php?error");
    } else {
        $_SESSION["password"] = $password;
        header("Location: ../admin.php");
    }
} else {
    header("Location: ../sign_in.php");
}