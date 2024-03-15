<?php

require "connection.php";




if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["message"])) {
     
    $name = trim(htmlspecialchars($_POST["name"]));
    $email = trim(htmlspecialchars($_POST["email"]));
    $text = trim(htmlspecialchars($_POST["message"]));

    if (empty($name)) {
        $message = "Name ist ein Pflichtfeld";
        header("Location: ../index.html?message=$message");
    } elseif (empty($email)) {
        $message = "Email ist ein Pflichtfeld";
        header("Location: ../index.html?message=$message");
    } elseif (empty($text)) {
        $message = "Nachricht ist ein Pflichtfeld";
        header("Location: ../index.html?message=$message");
    } elseif (strlen($name) < 3 || strlen($name) > 30) {
        $message = "Name kann 3 bis 20 Symbolen enthalten";
        header("Location: ../index.html?message=$message");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Nicht exestierte Email-Adresse";
        header("Location: ../index.html?message=$message");
    } elseif (strlen($text) > 300) {
        $message = "Nachricht kann maximal 300 Symbole enthalten";
        header("Location: ../index.html?message=$message");
    } else {
        $connection->query("INSERT INTO messages (message, name, email, state) VALUES ('$text', '$name', '$email', 'normal')");
        header("Location: ../index.html?message=Nachricht erfolgreich gesendet");
    }
} else {
    header("Location: ../index.html");
}
