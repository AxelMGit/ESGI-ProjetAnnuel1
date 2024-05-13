<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page">
      <header tabindex="0"><a href="index.php">Ride Away</a></header>
        <div id="nav-container">
            <div class="bg"></div>
            <div class="button" tabindex="0">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </div>
            <div id="nav-content" tabindex="0">
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="ajouter.php">Poster</a></li>
                    <li><a href="#0">Photos</a></li>
                    <li><a href="#0">BlaBla</a></li>
                    <li><a href="#0">Nous contacter</a></li>
                </ul>
            </div>
        </div>

        <div class="login-buttons">
            <a href="#" class="login-button">Connexion</a>
            <a href="#" class="signup-button">Inscription</a>
        </div>
    </div>

    <?php include('connexionbase.php'); ?>

</body>
</html>
