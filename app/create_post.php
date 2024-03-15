<?php

require "connection.php";

if (isset($_POST["description"]) && isset($_POST["main_text"]) && isset($_POST["heading"])) {
    $description = htmlspecialchars(trim($_POST["description"]));
    $main_text = htmlspecialchars(trim($_POST["main_text"]));
    $heading = htmlspecialchars(trim($_POST["heading"]));
    $image_name = htmlspecialchars(trim($_FILES["image"]["name"]));

    var_dump($image_name);

    if (strlen($description) > 300 ||
        strlen($main_text) > 2000 ||
        strlen($heading) > 50 ||
        $description === "" ||
        $main_text === "" ||
        $heading === "") {
        header("Location: ../admin.php?blog");
    } else {
        if ($image_name === "") {
            $connection->query("INSERT INTO blog_contents (heading, description, main_text) VALUES ('$heading', '$description', '$main_text')");
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

            $connection->query("INSERT INTO blog_contents (heading, description, main_text, image) VALUES ('$heading', '$description', '$main_text', '$unique_image_name')");

            header("Location: ../admin.php?blog");
        }
    }
} else {
    header("Locaion: ../admin.php");
}