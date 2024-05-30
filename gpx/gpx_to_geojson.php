<?php
if (isset($_GET['file'])) {
    $file = 'uploads/' . basename($_GET['file']);
    if (file_exists($file)) {
        // Parse the GPX file
        $xml = simplexml_load_file($file);
        $json = json_encode($xml);
        $array = json_decode($json, TRUE);

        // Convert to GeoJSON
        $geojson = [
            'type' => 'FeatureCollection',
            'features' => []
        ];

        if (isset($array['trk']['trkseg']['trkpt'])) {
            $coordinates = [];
            foreach ($array['trk']['trkseg']['trkpt'] as $trkpt) {
                $coordinates[] = [(float)$trkpt['@attributes']['lon'], (float)$trkpt['@attributes']['lat']];
            }
            $geojson['features'][] = [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'LineString',
                    'coordinates' => $coordinates
                ],
                'properties' => new stdClass()
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($geojson);
    } else {
        header("HTTP/1.0 404 Not Found");
        echo json_encode(['error' => 'File not found']);
    }
} else {
    header("HTTP/1.0 400 Bad Request");
    echo json_encode(['error' => 'No file specified']);
}
?>
