<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Forum avec Cartes GPX</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 600px;
            width: 100%;
        }
        .notification {
            position: fixed;
            top: 10px;
            right: 10px;
            padding: 10px;
            background-color: #f44336;
            color: white;
            display: none;
            border-radius: 5px;
        }
        iframe {
            display: none;
        }
        #openInGoogleMaps {
            display: none; /* Caché par défaut */
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="contener_top">
        <a href="index.php">
            <img src="../img/logo.png" alt="logo">
        </a>
    </div>

    <div class="contener_mid">
        <a href="index.php">
        </a> 
        
        <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data" target="uploadTarget">
            <label style="color: white; margin: 0.5%; text-align: center; word-wrap : break-word; font-family: 'Poppins', sans-serif;" or="gpxFile">Choissisez votre fichier :</label>
            <input style="color: white; margin: 0.5%; text-align: center; word-wrap : break-word; font-family: 'Poppins', sans-serif;" type="file" name="gpxFile" id="gpxFile" accept=".gpx">
            <input style="color: black; margin: 0.5%; text-align: center; word-wrap : break-word; font-family: 'Poppins', sans-serif;" type="submit" value="Envoyer">
            <button onclick='window.location.href = "http://127.0.0.1/ESGI-ProjetAnnuel1/ajouter.php?#demo-modal";' style="color: black; margin: 0.5%; text-align: center; word-wrap : break-word; font-family: 'Poppins', sans-serif;">Valider</button>
            
        </form>
        
        <div id="notification" class="notification"></div>
        <div id="map"></div>

        <iframe id="uploadTarget" name="uploadTarget"></iframe>

    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([51.505, -0.09], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        function handleUploadResponse() {
            var iframe = document.getElementById('uploadTarget');
            var responseText = iframe.contentDocument.body.innerText;
            try {
                console.log(responseText);
                var data = JSON.parse(responseText);
                if (data.success) {
                    console.log('Fichier uploadé avec succès!');
                    loadGPXFile(data.file);
                } else {
                    console.error(data.message);
                }
            } catch (e) {
                console.error('Erreur lors du traitement de la réponse: ', e);
            }
        }

        function loadGPXFile(file) {
            fetch('gpx_to_geojson.php?gpx_id=' + file)
                .then(response => response.json())
                .then(data => {
                    console.log('Data GeoJSON:', data); // Ajouter cette ligne pour vérifier les données GeoJSON
                    var geoJsonLayer = L.geoJSON(data);
                    geoJsonLayer.addTo(map);
                    // Utiliser fitBounds pour centrer la carte sur les données GPX
                    var bounds = geoJsonLayer.getBounds();
                    console.log('Bounds:', bounds); // Ajouter cette ligne pour vérifier les bounds
                    map.fitBounds(bounds);
                    // Générer l'URL de Google Maps
                    //generateGoogleMapsUrl(data);
                })
                .catch(error => {
                    console.error('Erreur lors du chargement du fichier GPX: ', error);
                });
        }

        // Configure the iframe onload event after the DOM is fully loaded
        window.onload = function() {
            document.getElementById('uploadTarget').onload = handleUploadResponse;
        };
        
        document.getElementById('uploadForm').addEventListener('submit', function(event) {
           //window.close();
        });

    </script>
</body>
</html>
