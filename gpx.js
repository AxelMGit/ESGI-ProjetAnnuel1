function loadGPXFile(file) { 
    console.log('File:', file);
    fetch('gpx/gpx_to_geojson.php?gpx_id=' + file)
        .then(response => response.json())
        .then(data => {
            console.log('Data GeoJSON:', data); // Ajouter cette ligne pour vérifier les données GeoJSON
            var geoJsonLayer = L.geoJSON(data);
            geoJsonLayer.addTo(map);
            var bounds = geoJsonLayer.getBounds();
            console.log('Bounds:', bounds); // Ajouter cette ligne pour vérifier les bounds
            map.fitBounds(bounds);
        })
        .catch(error => {
            console.error('Erreur lors du chargement du fichier GPX: ', error);
        });
}