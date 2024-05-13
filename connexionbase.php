<?php
include('config.php');
try {
    $dsn = "mysql:host=$SQLhost;dbname=$SQLdb;charset=utf8";
    $pdo = new PDO($dsn, $SQLlogin, $SQLpass);
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
    exit();
}
?>