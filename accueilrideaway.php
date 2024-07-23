<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <title>RideAway - Profil</title>
    <style>
        #map {
            margin-top: 100px;
            height: 300px;
            width: 50%;
        }
    </style>
</head>
<body>
    <?php
    include('connexionbase.php');
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

        </div>

        <div class="contener_mid">
            <?php include('profile-menu.php'); ?>

            <h3 style="margin-top: 3%; margin-left: 28%; position: absolute; color: white; word-wrap: break-word; font-family: 'Poppins', sans-serif;">Balade de la semaine</h3>
            <div class="map" id="map" style="margin-left:150px; display:inline-block;"></div>

            <div style="position=absolute; width:300px; margin-top: 5%; height:auto; margin-right:25px; display:inline-block;" id="ww_18eb57279f057" v='1.3' loc='id' a='{"t":"responsive","lang":"fr","sl_lpl":1,"ids":["wl3992"],"font":"Arial","sl_ics":"one_a","sl_sot":"celsius","cl_bkg":"#455A64","cl_font":"#FFFFFF","cl_cloud":"#FFFFFF","cl_persp":"#81D4FA","cl_sun":"#FFC107","cl_moon":"#FFC107","cl_thund":"#FF5722","cl_odd":"#0000000a","sl_tof":"5"}'>Plus de prévisions: <a href="https://oneweather.org/fr/paris/30_jours/" id="ww_18eb57279f057_u" target="_blank">Meteo a 30 jours</a></div><script async src="https://app2.weatherwidget.org/js/?id=ww_18eb57279f057"></script>
        </div>

        <div class="contener_bottom">
            <?php include('footer.php'); ?>
            <div style="display: flex; float: left; justify-content:start;" id="rasa-chat-widget" 
            data-websocket-url="http://localhost:5005"
            data-close-on-outside-click
            data-initial-payload="Bonjour !"
            data-primary="#434343"
            data-primary-highlight=""
            ></div>
            <script src="https://unpkg.com/@rasahq/rasa-chat" type="application/javascript"></script>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([51.505, -0.09], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            title: "ma map",
        }).addTo(map);

        loadGPXFile("4be48d13cd688bcfe69670b2108cd1dc.gpx");

        function loadGPXFile(file) {
            fetch('gpx/gpx_to_geojson.php?gpx_id=' + file)
                .then(response => response.json())
                .then(data => {
                    console.log('Data GeoJSON:', data);
                    var geoJsonLayer = L.geoJSON(data);
                    geoJsonLayer.addTo(map);
                    var bounds = geoJsonLayer.getBounds();
                    console.log('Bounds:', bounds);
                    map.fitBounds(bounds);
                })
                .catch(error => {
                    console.error('Erreur lors du chargement du fichier GPX: ', error);
                });
        }
    </script>
</body>
</html>
