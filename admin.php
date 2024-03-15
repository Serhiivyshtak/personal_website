<?php
session_start();

require "app/connection.php";

$password = "";
$role = "";
$name = "";

if (empty($_SESSION["password"])) {
    header("Location: sign_in.php");
} else {
    $password = htmlspecialchars(trim($_SESSION["password"]));
    $response = $connection->query("SELECT * FROM admins WHERE admin_pwd = '$password'");
    $data = $response->fetch_array(MYSQLI_ASSOC);
    $name = $data["admin_name"];
    $role = $data["role"];
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Serhii Vyshtak</title>
    <link rel="stylesheet" href="styles/vars.css">
    <link rel="stylesheet" href="styles/media_queries.css">
    <link rel="stylesheet" href="styles/admin.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cabin:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="delete_box_container" id="delete_box_container">
        <div class="delete_box">
            <div class="delete_box_heading_container">
                <h2 class="delete_box_heading">
                    Sind Sie sicher?
                </h2>
            </div>
            <div class="delete_box_message_container">
                <p class="delete_box_message" id ="delete_box_message">
                    Möchten Sie die Nachricht von Serhii Vyshtak löschen?
                </p>
            </div>
            <div class="delete_box_buttons_container">
                <button class="delete_box_cancel_button" id="cancel_delete_button">
                    Abbrechen
                </button>
                <a class="delete_box_delete_button" id="completely_delete_btn">
                    Löschen
                </a>
            </div>
        </div>
    </div>



    
    <div class="nci_box_container modal_window">
        <div class="nci_box">
            <button class="box_close_button">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                    <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/>
                </svg>
            </button>
            <div class="nci_box_heading_container">
                <h2 class="nci_box_heading" id="nci_box_heading">
                    Eine neue Veröffentlichung erstellen
                </h2>
            </div>
            <form class="nci_box_form" id ="nci_box_form" action="app/create_post.php" method="post" enctype="multipart/form-data">
                <div class="nci_box_textarea_container">
                    <input class="nci_box_text_area" name="heading" id="" placeholder="Überschrift (max 50 Symbole)">
                </div>
                <div class="nci_box_textarea_container">
                    <textarea class="nci_box_text_area" name="description" id="" cols="30" rows="2" placeholder="kurze Beschreibung (max 300 Symbole)"></textarea>
                </div>
                <div class="nci_box_textarea_container">
                    <textarea class="nci_box_text_area" name="main_text" id="" cols="30" rows="6" placeholder="ganzer Text (max 2000 Symbole)"></textarea>
                </div>
                <div class="nci_box_image_picker_container">
                    <label class="nci_box_image_picker_label" for="nci_box_filepicker" id="nci_box_image_picker_label">Bild hochladen</label>
                    <input class="nci_box_image_picker" type="file" name="image" id="nci_box_filepicker">
                </div>            
                <div class="nci_box_submit_button_container">
                    <button class="nci_box_submit_button" id="nci_box_submit_button">
                        Erstellen
                    </button>
                </div>
            </form>
        </div>
    </div>




    <div class="email_box_container modal_window" id="email_box_container">
        <div class="email_box">
            <button class="box_close_button">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                    <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/>
                </svg>
            </button>
            <div class="email_box_heading_container">
                <h2 class="email_box_heading" id="email_box_heading">
                    Antwort an  Serhii senden
                </h2>
            </div>
            <form style="width: 100%" action="app/send_mail.php" method="post" id="email_send_form">
                <div class="email_box_text_field_container">
                    <input class="email_box_text_field" type="text" name="email" readonly id="email_input">
                </div>
                <div class="email_box_text_field_container">
                    <input class="email_box_text_field" type="text" name="subject" id="" placeholder="Betreff">
                </div>
                <div class="email_box_text_field_container">
                    <textarea class="email_box_text_field" placeholder="Antwort" name="answer" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="email_box_button_container">
                    <input class="email_box_button" type="submit" value="Antwort senden">
                </div>
            </form>
        </div>
    </div>


    <header class="header">
        <div class="header_inner">
            <a href="admin.php" class="header_logo">
                Admin - VYSHT.
            </a>
            <nav class="navigation_container">
                <a href="admin.php" class="nav_link">Nachrichten</a>
                <a href="?blog" class="nav_link">Blog Inhalt</a>
                <?php 
                    if ($role === "superadmin") {
                        echo '<a href="?roles" class="nav_link">Rollen</a>';
                    } else {
                        echo "";
                    }
                    echo '<p class="username">'.$name.'</p>';
                ?>
            </nav>
        </div>
    </header>

    <?php
        $queries = ["blog", "roles"];

        if (in_array($_SERVER["QUERY_STRING"], $queries)) {
            require "admin_pages/".$_SERVER["QUERY_STRING"].".php";
        } elseif (empty($_SERVER["QUERY_STRING"])) {
            require "admin_pages/messages.php";
        }
    ?>


    <footer class="footer">
        <a href="app/logout.php" class="admin_link">log out</a>
    </footer>


    <script src="js/admin.js"></script>
</body>
</html>