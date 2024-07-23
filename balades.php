<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header('Location: index.php');
    exit();
}
?>


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

    <div style="display: flex; justify-content: center; align-items: center;"class="contener_mid">
        <div class="map_container">
            <iframe class="frame_map" src="https://www.google.com/maps/d/u/0/embed?mid=1uW1ypxOXaeoHi1AmwdCquGKXmWrspcM&ehbc=2E312F&noprof=1" width="400" height="300"></iframe>
            <iframe class="frame_map" src="https://www.google.com/maps/d/u/0/embed?mid=1uW1ypxOXaeoHi1AmwdCquGKXmWrspcM&ehbc=2E312F&noprof=1" width="400" height="300"></iframe>
            <iframe class="frame_map" src="https://www.google.com/maps/d/u/0/embed?mid=1uW1ypxOXaeoHi1AmwdCquGKXmWrspcM&ehbc=2E312F&noprof=1" width="400" height="300"></iframe>
        </div>
    </div>

    <div class="contener_bottom">
        <?php include('footer.php'); ?>
    </div>
</body>
</html>