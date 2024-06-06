<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application - En cours de création</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page">
        <div id="nav-container">
            <div class="bg"></div>
            <div class="button" tabindex="0">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </div>
            
            <div id="nav-content" tabindex="0">
                <ul>
                    <li><a href="#0">Poster</a></li>
                    <li><a href="ajouter.php">Forum</a></li>
                    <li><a href="#0">Entretiens</a></li>
                    <li><a href="#0">GPS moto</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <header>
        <div id="logo" class="contact-logo">
            <a href="index.php">
                <img src="img/logo.png" alt="logo">
            </a>
        </div>
    </header>
    
    
    <section class="application">
        <h1>Notre application est en cours de création</h1>
        <div class="loader-container">
            <div class="loader"></div>
        </div>
        <p>Merci de votre patience. Nous travaillons dur pour vous offrir la meilleure expérience possible.</p>
    </section>

    <div class="contener_bottom">
        <?php include('footer.php'); ?>
    </div>

</body>
</html>