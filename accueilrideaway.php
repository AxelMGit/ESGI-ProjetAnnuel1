<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="chatbot.js"></script>
    <title>RideAway</title>
</head>
<body class="accueil">
    
<?php include('connexionbase.php'); 
    session_start();
    if (!isset($_SESSION['id_user'])) {
        header('Location: index.php'); 
        exit();
    }
?>

    <div class="page">
        <div id="nav-container">
            <div class="bg"></div>
            <div class="button" tabindex="0">
                <span class="icon-bar jaune"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar jaune"></span>
            </div>
            <div id="nav-content" tabindex="0">
                <ul>
                    <li><a href="#0">Poster</a></li>
                    <li><a href="ajouter.php">Forum</a></li>
                    <li><a href="#0">Entretiens</a></li>
                    <li><a href="#0">GPS moto</a></li>
                    <li><a href="#0">Contact</a></li>
                    <li><a href="logout.php">Déconnexion</a></li>
                </ul>
            </div>
        </div>

        <div id="logo">
            <a href="index.php">
                <img src="img/logo.png" alt="logo">
            </a>
        </div>

        

    <iframe id="chatbot" 
            src="chatbot.php"
            frameborder="0">
    </iframe>

</body>
</html>

<footer>
<div class="footer">
<div class="row">

</div>

<div class="row">
<ul>
<li><a href="application.html">L'application</a></li>
<li><a href="contact.html">Assistance</a></li>
<li><a href="#">A propos de nous</a></li>
<li><a href="termes_conditions.html">Termes & Conditions</a></li>
</ul> 
</div>
</div>
</footer>