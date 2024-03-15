<?php


require "connection.php";

if (!isset($_SERVER['HTTP_REFERER'])) {
    header("Location: ../index.html");
} else {
    $message_id = $_GET["msg"];
    $connection->query("UPDATE messages SET state = 'normal' WHERE message_id = '$message_id'");
    header("Location: ../admin.php#$message_id");
}