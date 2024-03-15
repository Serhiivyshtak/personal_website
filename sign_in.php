

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/vars.css">
    <link rel="stylesheet" href="styles/media_queries.css">
    <link rel="stylesheet" href="styles/sign_in.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Cabin:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <title>Sign in to the admin page - Serhii Vyshtak</title>
</head>
<body>

    <div class="wrapper">
        <form class="sign_in_form" action="app/sign_in_validation.php" method="post">
            <div class="heading_container">
                <h1 class="heading">
                    Admin-Tools
                </h1>
            </div>
            <div class="password_input_container">  
                <input class="password_input" placeholder="Zugangsсode" type="password" name="password" id="">
            </div>
            <div class="button_container" id="button_container">
                <input class="submit_button" type="submit" value="Einloggen">
            </div>
            <div class="error_container" id="error_container">
                Ihr Zugangscode ist unwirksam oder existiert nicht
            </div>
        </form>
    </div>


    <script src="js/sign_in.js"></script>
</body>
</html>