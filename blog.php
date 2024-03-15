<?php
require "app/connection.php";


$response = $connection->query("SELECT * FROM blog_contents ORDER BY blog_content_id DESC");

$data = $response->fetch_all(MYSQLI_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Serhii Vyshtak</title>
    <link rel="stylesheet" href="styles/vars.css">
    <link rel="stylesheet" href="styles/media_queries.css">
    <link rel="stylesheet" href="styles/blog.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/scrollbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cabin:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
</head>
<body>

    <header class="header" id="header">
        <div class="header_inner">
            <a class="header_logo" id="header_logo" href="blog.php">BLOG - VSHTK.</a>
            <a href="<?php echo isset($_GET["blog_item"]) ? "blog.php" : "index.html" ?>">
                <svg class="back_button" id="back_button" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                    <path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/>
                </svg>
            </a>
        </div>
    </header>

    <div class="content_area">
        <div class="content_area_inner" id="content_area_inner">
        <?php 
        if (!isset($_GET["blog_item"])) {
            for ($i = 0; $i < count($data); $i++) {
                echo '<div class="content_item">
                <div class="item_image" style="background: url(uploads/'.$data[$i]["image"].');background-position: center;
                background-size: cover;background-repeat: no-repeat;"></div>
                <div class="content_item_text_container">
                    <div class="content_item_heading_container">
                        <h2 class="content_item_heading">
                            '.$data[$i]["heading"].'
                        </h2>
                    </div>
                    <div class="content_item_date_container">
                        <p class="content_item_date">
                        '.$data[$i]["content_created_at"].'
                        </p>
                    </div>
                    <div class="content_item_description_container">
                        <p class="content_item_description">
                        '.$data[$i]["description"].'
                        </p>
                    </div>
                    <div class="content_item_button_container">
                        <a href="?blog_item='.$data[$i]["blog_content_id"] .'" class="content_item_button">
                            Mehr lesen
                        </a>
                    </div>
                </div>
            </div>';
            }
        } else {
            $post_id = $_GET["blog_item"];
            $post_data_request = $connection->query("SELECT * FROM blog_contents WHERE blog_content_id = $post_id");
            $post_data = $post_data_request->fetch_array(MYSQLI_ASSOC);
            echo '<div class="single_ci">
                    <div class="content_item_heading_container">
                        <h2 class="content_item_heading">
                            '.$post_data["heading"].'
                        </h2>
                    </div>
                    <div class="content_item_date_container">
                        <p class="content_item_date">
                        '.$post_data["content_created_at"].'
                        </p>
                    </div>
                    <div class="ci_content_container">
                        <div class="ci_image" style="background: url(uploads/'.$post_data["image"].');background-position: center;
                        background-size: cover;background-repeat: no-repeat;"></div>
                        <div class="ci_text_container">
                            <p class="content_item_description ci_text">
                            '.$post_data["main_text"].'
                            </p>
                            <div class="content_item_button_container">
                                <a href="blog.php" class="content_item_button">zurück</a>
                            </div>
                        </div>
                    </div>
                </div>';
        }
         ?>
        </div>
    </div>

    <footer class="footer">
        <a href="sign_in.php" target="_blank" class="admin_link">admin</a>
    </footer>


    <script src="js/blog.js"></script>
</body>
</html>