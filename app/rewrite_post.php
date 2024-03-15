<?php

require "connection.php";


if (isset($_POST["heading"]) && isset($_POST["description"]) && isset($_POST["main_text"]) ) {
    $heading = htmlspecialchars(trim($_POST["heading"]));
    $description = htmlspecialchars(trim($_POST["description"]));
    $main_text = htmlspecialchars(trim($_POST["main_text"]));
    $image_name = htmlspecialchars(trim($_FILES["image"]["name"]));

    $post_id = $_GET["post"];

    if ($heading === "" ||
        $description === "" ||
        $main_text === "" ||
        strlen($heading) > 50 ||
        strlen($description) > 300 ||
        strlen($main_text) > 200) {
        header("Location: ../admin.php?blog");
    } else {
        if ($image_name === "") {
            $connection->query("UPDATE blog_contents 
            SET heading = '$heading', description = '$description', main_text = '$main_text' 
            WHERE blog_content_id = $post_id");
            header("Location: ../admin.php?blog");
        } else {
            $file_name = $_FILES["image"]["name"];
            $file_tmp_name = $_FILES["image"]["tmp_name"];
            $file_size = $_FILES["image"]["size"];
            $file_error = $_FILES["image"]["error"];
            $file_ext = strtolower(pathinfo($file_name)["extension"]);

            $unique_image_name;

            $allowed_files = ["jpg", "jpeg", "png"];

            if ($file_error > 0 ||
                !in_array($file_ext, $allowed_files) ||
                $file_size > 100000) {
                header("Location: ../admin?blog");
            } else {
                $unique_image_name = time().".".$file_ext;
                $file_destination = "../uploads/$unique_image_name";
                move_uploaded_file($file_tmp_name, $file_destination);
            }

            $connection->query("UPDATE blog_contents
            SET heading = '$heading', description = '$description', main_text = '$main_text', image = '$unique_image_name'
            WHERE blog_content_id = $post_id");
            header("Location: ../admin.php?blog");
        }
    }
} else {
    header("Locaion: ../admin.php");
}