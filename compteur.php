<?php
session_start();

// Fichier pour stocker les sessions
$session_file = 'sessions.txt';

// Lire les sessions actuelles
$sessions = file_exists($session_file) ? json_decode(file_get_contents($session_file), true) : [];

// Ajouter ou mettre à jour la session actuelle
$sessions[session_id()] = time();

// Supprimer les sessions expirées (par exemple, expirées après 5 minutes)
$timeout = 300; // 5 minutes
foreach ($sessions as $session_id => $timestamp) {
    if (time() - $timestamp > $timeout) {
        unset($sessions[$session_id]);
    }
}

// Sauvegarder les sessions mises à jour
file_put_contents($session_file, json_encode($sessions));

// Compter les sessions actives
$active_sessions = count($sessions);

// Retourner le nombre de sessions actives
echo $active_sessions;
?>
