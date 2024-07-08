<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A propos de nous</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('navbar.php');?>
    
        <div class="contener_top">
            <a href="index.php">
                <img src="img/logo.png" alt="logo">
            </a>
        </div>

        <div class="contener_mid">
            <section class="a_propos">
                <h1>Pourquoi avons-nous créé ce site ?</h1>
                <div class="about_boxes">
                    <div class="about_box">
                        <h2>Léo-Paul</h2>
                        <img style ="width: 260px"; src="img/moto2_l.jpg">
                    </div>
                    <div class="about_box">
                        <h2>Clément</h2>
                        <img style ="width: 250px"; src="img/moto1_c.jpg">
                    </div>
                    <div class="about_box">
                        <h2>Axel</h2>
                        <p></p>
                    </div>
                </div>
            </section>
        </div>

        <div class="contener_bottom">
            <?php include('footer.php'); ?>
        </div>
    </div>
</body>
</html>