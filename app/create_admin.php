<?php

require "connection.php";

if (isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["role"])) {
    var_dump($_POST);
    $name = htmlspecialchars(trim($_POST["name"]));
    $password = htmlspecialchars(trim($_POST["password"]));
    $role = htmlspecialchars(trim($_POST["role"]));

    if ($name === "" || strlen($password) < 8 || $role === "" ||
        strlen($name) > 50 || strlen($password) > 100 || strlen($role) > 100) {
        header("Location: ../admin.php?roles");
    } else {
        $connection->query("INSERT INTO admins (admin_name, admin_pwd, role) VALUES ('$name', '$password', '$role')");
        header("Location: ../admin.php?roles");
    }
} else {
    header("Location: ../admin.php");
}
