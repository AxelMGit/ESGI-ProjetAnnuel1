<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var maps = {}; // Store references to all maps

        window.addEventListener('scroll', function() {
            const buttonWrapper = document.querySelector('.wrapper.fixed-bottom-right');
            const footer = document.getElementById('footer');
            const footerRect = footer.getBoundingClientRect();
            const windowHeight = window.innerHeight;

            if (footerRect.top <= windowHeight) {
                buttonWrapper.style.position = 'absolute';
                buttonWrapper.style.top = `${window.scrollY + footerRect.top - buttonWrapper.offsetHeight - 20}px`;
                buttonWrapper.style.bottom = 'auto';
            } else {
                buttonWrapper.style.position = 'fixed';
                buttonWrapper.style.bottom = '20px';
                buttonWrapper.style.top = 'auto';
            }
        });

        function loadGPXFile(gpxFile, mapId) {
            fetch('gpx/gpx_to_geojson.php?gpx_id=' + gpxFile)
                .then(response => response.json())
                .then(data => {
                    if (maps[mapId]) {
                        maps[mapId].remove();
                    }

                    var map = L.map(mapId).setView([51.505, -0.09], 13);
                    maps[mapId] = map;

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                    }).addTo(map);

                    var geoJsonLayer = L.geoJSON(data);
                    geoJsonLayer.addTo(map);

                    var bounds = geoJsonLayer.getBounds();
                    map.fitBounds(bounds);
                })
                .catch(error => {
                    console.error('Error loading GPX data:', error);
                });
        }
    </script>
</head>
<body>
    <?php 
    include('connexionbase.php');
    session_start();
    if (!isset($_SESSION['id_user'])) {
        header('Location: index.php'); 
        exit();
    } else {
        $id_user = $_SESSION['id_user'];
    }

    if (isset($_POST['publi'])) {
        $dateDuJour = date("Y-m-d H:i:s");
        $requete1 = 'INSERT INTO post(Contents, CreationTimestamp, id_user, gpx_id)
            VALUES (:Contents, :CreationTimestamp, :id_user, :gpx_id)';
        $ex_requete1 = $pdo->prepare($requete1);
        $ex_requete1->execute(['Contents' => $_POST['publi'], 'CreationTimestamp' => $dateDuJour, 'id_user' => $id_user, 'gpx_id' => $_COOKIE['uploaded_gpx_file']]);
        header('Location: ajouter.php?' . $_GET['idpost']);
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
            <div id="body2">
                <?php 
                $requete1 = 'SELECT p.*, u.nom, u.prenom 
                FROM post p
                LEFT JOIN utilisateur u ON u.id_user = p.id_user Order by id_post DESC';
                $ex_requete1 = $pdo->prepare($requete1);
                $ex_requete1->execute();
                $res_requete1 = $ex_requete1->fetchAll();

                foreach ($res_requete1 as $key => $valeur1) {
                    $lastClass = ($key === array_key_last($res_requete1)) ? 'last-post' : '';
                    echo '<a id="post">
                              <div class="'.$lastClass.'">
                                  <h3 class="h3">'.$valeur1['nom'].' '.$valeur1['prenom'].'</h3>' 
                                  .'<h4 class="h4">'.'"'.substr($valeur1['Contents'], 0, 100).'"</h4>'
                                  .'<p class="p">'.$valeur1['CreationTimestamp'].'</p>';

                    // Vérifier si un fichier GPX est associé à ce post
                    if (!empty($valeur1['gpx_id'])) {
                        echo '<div id="map-' . $valeur1['id_post'] . '" class="map" style="height: 400px;"></div>';
                        echo '<script>loadGPXFile("' . $valeur1['gpx_id'] . '", "map-' . $valeur1['id_post'] . '");</script>';
                        echo $valeur1['gpx_id'];
                    } else {
                        echo 'Aucun fichier GPX associé';
                    }

                    echo '</div></a>';
                }
                ?>

                <div id="demo-modal" class="modal">
                    <div class="modal__content">
                        <h1>Ajouter un post !</h1>
                        <form method="post">
                            <textarea name="publi"></textarea>

                            <?php
                            if (isset($_COOKIE['uploaded_gpx_file'])) {
                                echo '<span>Fichier GPX trouvé</span>';
                            } else {
                                echo '<a href="gpx/index.php" target="_blank">Ajouter fichier GPX</a>';
                            }
                            ?>

                            <button type="submit">Poster</button>
                        </form>
                        <div class="modal__footer"></div>
                        <a href="#" class="modal__close">&times;</a>
                    </div>
                </div>
            </div>
            
            <div class="wrapper fixed-bottom-right">
                <a href="#demo-modal">+</a>
            </div>
        </div>

        <div id="footer" class="contener_bottom">
            <?php include('footer.php'); ?>
        </div>
    </div>
</body>
</html>
