<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>RideAway - Profil</title>
</head>
<body>
    <?php include('connexionbase.php'); 
        session_start();
        if (!isset($_SESSION['id_user'])) {
            header('Location: index.php'); 
            exit();
        }
    ?>

    <?php include('navbar.php'); ?>
    
    <div class="container">
        <div class="contener_top">
            <a href="index.php">
                <img src="img/logo.png" alt="logo">
            </a>

            
            <div class="profile-icon">
                <img src="img/icon_profil.png" alt="Photo de profil" id="profileMenuToggle">
            </div>
        </div>

        <div class="contener_mid">
            <?php include('profile-menu.php'); ?>
            
        </div>

        <div class="contener_bottom">
            <?php include('footer.php'); ?>
        </div>
        
    </div>
    
</body>
</html>
