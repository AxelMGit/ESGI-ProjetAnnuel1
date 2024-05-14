<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="chatbot.js"></script>
    <title>RideAway</title>
</head>
<body>




    <div class="page">
      <header tabindex="0"><a href="index.php">RideAway</a></header>
        <div id="nav-container">
            <div class="bg"></div>
            <div class="button" tabindex="0">
                <span class="icon-bar jaune"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar jaune"></span>
            </div>
            <div id="nav-content" tabindex="0">
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="ajouter.php">Poster</a></li>
                    <li><a href="#0">BlaBla</a></li>
                    <li><a href="#0">Entretiens</a></li>
                    <li><a href="#0">Nous contacter</a></li>
                </ul>
            </div>
        </div>

        <div class="login-buttons">
            <a href="login.php" class="login-button">Connexion</a>
            <a href="signup.php" class="signup-button">Inscription</a>

        </div>
    </div>
    
    <div class="groupement-video">

        <video class="background-video" preload="auto" autoplay loop muted>
            <source src="img\videobg2.mp4" type="video/mp4">
        </video>

    </div>

    <iframe id="chatbot" 
            src="https://copilotstudio.microsoft.com/environments/Default-c371d4f5-b34f-4b06-9e66-517fed904220/bots/cr4c5_esgiProjetAnnuel1/webchat?__version__=2" 
            frameborder="0">
    </iframe>

</body>
</html>