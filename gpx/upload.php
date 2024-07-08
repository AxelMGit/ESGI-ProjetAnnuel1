<?php
header('Content-Type: application/json');

function generateRandomFileName($extension) {
    return bin2hex(random_bytes(16)) . '.' . $extension;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['gpxFile'])) {
    $target_dir = "uploads/";
    $fileType = strtolower(pathinfo($_FILES["gpxFile"]["name"], PATHINFO_EXTENSION));

    // Vérifiez si le fichier est un GPX
    if ($fileType != "gpx") {
        echo json_encode(['success' => false, 'message' => 'Seuls les fichiers GPX sont autorisés.']);
        exit();
    }

    // Générer un nom de fichier unique
    $uniqueFileName = generateRandomFileName($fileType);
    $target_file = $target_dir . $uniqueFileName;

    // Vérifiez la taille du fichier
    if ($_FILES["gpxFile"]["size"] > 500000) {
        echo json_encode(['success' => false, 'message' => 'Désolé, votre fichier est trop volumineux.']);
        exit();
    }

    // Si tout est correct, essayez d'uploader le fichier
    if (move_uploaded_file($_FILES["gpxFile"]["tmp_name"], $target_file)) {
        // Enregistrer le nom du fichier dans un cookie de session
        session_start(); // Démarrez la session si ce n'est pas déjà fait
        setcookie('uploaded_gpx_file', $uniqueFileName, time() + (60 * 1), "/", "localhost");
        echo json_encode(['success' => true, 'file' => $uniqueFileName]);
    } else {
        $error_message = 'Erreur inconnue.';
        switch ($_FILES['gpxFile']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                $error_message = 'Le fichier téléchargé dépasse la directive upload_max_filesize dans php.ini.';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $error_message = 'Le fichier téléchargé dépasse la directive MAX_FILE_SIZE qui a été spécifiée dans le formulaire HTML.';
                break;
            case UPLOAD_ERR_PARTIAL:
                $error_message = 'Le fichier téléchargé n\'a été que partiellement téléchargé.';
                break;
            case UPLOAD_ERR_NO_FILE:
                $error_message = 'Aucun fichier n\'a été téléchargé.';
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $error_message = 'Il manque un dossier temporaire.';
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $error_message = 'Échec de l\'écriture du fichier sur le disque.';
                break;
            case UPLOAD_ERR_EXTENSION:
                $error_message = 'Une extension PHP a arrêté le téléchargement du fichier.';
                break;
            default:
                $error_message .= ' - Debug info: ';
                $error_message .= 'is_uploaded_file: ' . (is_uploaded_file($_FILES["gpxFile"]["tmp_name"]) ? 'true' : 'false') . '; ';
                $error_message .= 'target_file: ' . $target_file . '; ';
                $error_message .= 'move_uploaded_file: ' . (move_uploaded_file($_FILES["gpxFile"]["tmp_name"], $target_file) ? 'true' : 'false') . '; ';
                $error_message .= 'tmp_name: ' . $_FILES["gpxFile"]["tmp_name"] . '; ';
                $error_message .= 'error_code: ' . $_FILES['gpxFile']['error'];
                break;
        }
        echo json_encode(['success' => false, 'message' => 'Désolé, une erreur est survenue lors de l\'upload de votre fichier : ' . $error_message]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Aucun fichier reçu.']);
}
?>
