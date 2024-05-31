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
    
    <?php 
        include('connexionbase.php'); 
        session_start();
        if (!isset($_SESSION['id_user'])) {
            header('Location: index.php'); 
            exit();
        }
    ?>

    <div class="page">
        <?php include('navbar.php'); ?>
        
        <iframe id="chatbot" src="chatbot.php" frameborder="0"></iframe>
    </div>

    <footer>
        <div class="footer">
            <div class="row"></div>
            <div class="row">
                <ul>
                    <li><a href="application.html">L'application</a></li>
                    <li><a href="contact.html">Assistance</a></li>
                    <li><a href="#">À propos de nous</a></li>
                    <li><a href="termes_conditions.html">Termes & Conditions</a></li>
                </ul> 
            </div>
        </div>
    </footer>
</body>
</html>
