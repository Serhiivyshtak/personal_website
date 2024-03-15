<?php

require "connection.php";

if (!isset($_SERVER["HTTP_REFERER"])) {
    header("Location: ../index.html");
} else {
    if (isset($_GET["msg"])) {
        $message_id = $_GET["msg"];
        $connection->query("DELETE FROM messages WHERE message_id = '$message_id'");
        header("Location: ../admin.php");
    } elseif (isset($_GET["post"])) {
        $post_id = $_GET["post"];
        $response = $connection->query("SELECT image FROM blog_contents WHERE blog_content_id = '$post_id'");
        $data = $response->fetch_array(MYSQLI_NUM);
        $image_name = $data[0];
        unlink("../uploads/$image_name");
        $connection->query("DELETE FROM blog_contents WHERE blog_content_id = '$post_id'");
        header("Location: ../admin.php?blog");
    } elseif (isset($_GET["admin"])) {
        $admin_id = $_GET["admin"];
        $connection->query("DELETE FROM admins WHERE admin_id = '$admin_id'");
        header("Location: ../admin.php?roles");
    }
}