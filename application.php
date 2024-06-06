<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application - En cours de création</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('navbar.php');?>

    <div class="container">
        <div class="contener_top">
            <a href="index.php">
                <img src="img/logo.png" alt="logo">
            </a>
        </div>
        
        <div class="contener_mid"> 
            <section class="application">
                <h1>Notre application est en cours de création</h1>
                <div class="loader-container">
                    <div class="loader"></div>
                </div>
                <p>Merci de votre patience. Nous travaillons dur pour vous offrir la meilleure expérience possible.</p>
            </section>
        </div>

        <div class="contener_bottom">
            <?php include('footer.php'); ?>
        </div>
    </div>
</body>
</html>
