<!DOCTYPE html>
<html>
<head>
    <title>Forum avec Cartes GPX</title>
    <link rel="stylesheet" href="style.css">
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
    <h1>Upload de Fichiers GPX</h1>
    
    <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data" target="uploadTarget">
        <label for="gpxFile">Upload GPX File:</label>
        <input type="file" name="gpxFile" id="gpxFile" accept=".gpx">
        <input type="submit" value="Upload">
    </form>
    
    <div id="notification" class="notification"></div>
    <div id="map"></div>

    <iframe id="uploadTarget" name="uploadTarget"></iframe>
    
    <button id="openInGoogleMaps">Ouvrir dans Google Maps</button>

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
                    generateGoogleMapsUrl(data);
                })
                .catch(error => {
                    console.error('Erreur lors du chargement du fichier GPX: ', error);
                });
        }

        function simplifyPath(points, tolerance) {
            if (points.length < 3) return points;

            var sqTolerance = tolerance !== undefined ? tolerance * tolerance : 1;

            function getSqDist(p1, p2) {
                var dx = p1[0] - p2[0], dy = p1[1] - p2[1];
                return dx * dx + dy * dy;
            }

            function simplifyRadialDist(points, sqTolerance) {
                var prevPoint = points[0], newPoints = [prevPoint];
                for (var i = 1, len = points.length; i < len; i++) {
                    var point = points[i];
                    if (getSqDist(point, prevPoint) > sqTolerance) {
                        newPoints.push(point);
                        prevPoint = point;
                    }
                }
                if (prevPoint !== points[points.length - 1]) {
                    newPoints.push(points[points.length - 1]);
                }
                return newPoints;
            }

            function getSqSegDist(p, p1, p2) {
                var x = p1[0], y = p1[1];
                var dx = p2[0] - x, dy = p2[1] - y;
                if (dx !== 0 || dy !== 0) {
                    var t = ((p[0] - x) * dx + (p[1] - y) * dy) / (dx * dx + dy * dy);
                    if (t > 1) {
                        x = p2[0];
                        y = p2[1];
                    } else if (t > 0) {
                        x += dx * t;
                        y += dy * t;
                    }
                }
                dx = p[0] - x;
                dy = p[1] - y;
                return dx * dx + dy * dy;
            }

            function simplifyDPStep(points, first, last, sqTolerance, simplified) {
                var maxSqDist = sqTolerance, index;
                for (var i = first + 1; i < last; i++) {
                    var sqDist = getSqSegDist(points[i], points[first], points[last]);
                    if (sqDist > maxSqDist) {
                        index = i;
                        maxSqDist = sqDist;
                    }
                }
                if (maxSqDist > sqTolerance) {
                    if (index - first > 1) simplifyDPStep(points, first, index, sqTolerance, simplified);
                    simplified.push(points[index]);
                    if (last - index > 1) simplifyDPStep(points, index, last, sqTolerance, simplified);
                }
            }

            function simplifyDouglasPeucker(points, sqTolerance) {
                var last = points.length - 1;
                var simplified = [points[0]];
                simplifyDPStep(points, 0, last, sqTolerance, simplified);
                simplified.push(points[last]);
                return simplified;
            }

            var simplified = simplifyRadialDist(points, sqTolerance);
            return simplifyDouglasPeucker(simplified, sqTolerance);
        }

        function generateGoogleMapsUrl(geoJsonData) {
            var coordinates = geoJsonData.features[0].geometry.coordinates;
            var simplifiedCoordinates = simplifyPath(coordinates, 0.001); // Ajustez la tolérance selon les besoins
            var waypoints = simplifiedCoordinates.map(coord => coord[1] + ',' + coord[0]).join('|'); // Inverser lat et lon pour Google Maps
            var googleMapsUrl = 'https://www.google.com/maps/dir/?api=1&waypoints=' + waypoints;
            console.log('Google Maps URL:', googleMapsUrl);

            var button = document.getElementById('openInGoogleMaps');
            button.style.display = 'block'; // Afficher le bouton
            button.onclick = function() {
                window.open(googleMapsUrl, '_blank');
            };
        }

        // Configure the iframe onload event after the DOM is fully loaded
        window.onload = function() {
            document.getElementById('uploadTarget').onload = handleUploadResponse;
        };
        
        document.getElementById('uploadForm').addEventListener('submit', function(event) {
           window.close();
        });

    </script>
</body>
</html>
