<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>RideAway</title>
</head>
<body>
    
    <?php
    include('connexionbase.php');
    session_start();
    if (!isset($_SESSION['id_user'])) {
        header('Location: index.php');
        exit();
    }

    $id_user_moto = $_GET["id_user_moto"];
    
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['kilometrage_total'])) {
            $new_kilometrage = (int)$_POST['kilometrage_total'];
            if ($id_user_moto > 0 && $new_kilometrage > 0) {
                $requete1 = "UPDATE user_motos SET kilometrage_total = :km WHERE id_user_moto = :user_moto";
                $ex_requete1 = $pdo->prepare($requete1);
                $ex_requete1->execute([':user_moto' => $id_user_moto, ':km' => $new_kilometrage]);
            }
        }

        if (isset($_POST['id_entretien_done']) && isset($_POST['kilometrage_done'])) {
            $id_entretien = (int)$_POST['id_entretien_done'];
            $kilometrage_done = (int)$_POST['kilometrage_done'];
            $date_done = date('Y-m-d');

            if ($id_user_moto > 0 && $id_entretien > 0 && $kilometrage_done > 0) {
                $requete2 = "INSERT INTO suivi_entretien (id_user_moto, id_entretien, date, kilometrage) 
                             VALUES (:id_user_moto, :id_entretien, :date_entretien, :kilometrage_entretien)
                             ON DUPLICATE KEY UPDATE date = VALUES(date), kilometrage = VALUES(kilometrage)";
                $ex_requete2 = $pdo->prepare($requete2);
                $ex_requete2->execute([
                    ':id_user_moto' => $id_user_moto,
                    ':id_entretien' => $id_entretien,
                    ':date_entretien' => $date_done,
                    ':kilometrage_entretien' => $kilometrage_done
                ]);
            }
        }
    }

   
    $requete3 = "SELECT 
                    motos.modele, 
                    motos.marque, 
                    motos.annee,
                    user_motos.kilometrage_total,
                    entretiens.id_entretien,
                    entretiens.description, 
                    entretiens.interval_km,
                    suivi_entretien.date AS derniere_date_entretien,
                    suivi_entretien.kilometrage AS dernier_km_entretien
                FROM 
                    user_motos
                JOIN 
                    motos ON user_motos.id_moto = motos.id_moto
                JOIN 
                    entretiens ON entretiens.id_moto = motos.id_moto
                LEFT JOIN 
                    suivi_entretien ON suivi_entretien.id_user_moto = user_motos.id_user_moto AND suivi_entretien.id_entretien = entretiens.id_entretien
                WHERE 
                    user_motos.id_user_moto = :user_moto";
    $ex_requete3 = $pdo->prepare($requete3);
    $ex_requete3->execute([':user_moto' => $id_user_moto]);
    $entretiens = $ex_requete3->fetchAll();
    ?>

    <?php include('navbar.php'); ?>
    
    <div class="container">
        <div class="contener_top">
            <a href="index.php">
                <img src="img/logo.png" alt="logo"> 
            </a>
        </div>

        <div class="contener_mid">
            <dialog id="maBoiteDeDialogue" class="classdialoguegarageentretien">
                <div class="modal-content">
                    <h1>Suivi d'entretien pour la moto</h1>
                    <form method="post" action="entretien.php?id_user_moto=<?= htmlspecialchars($id_user_moto) ?>">
                        <label for="kilometrage_total">Mettre à jour le kilométrage total :</label>
                        <input type="number" id="kilometrage_total" name="kilometrage_total" value="<?= $entretiens[0]['kilometrage_total'] ?? 0 ?>">
                        <button type="submit">Mettre à jour</button>
                    </form>
                    <br>
                    <br>

                    <table>
                        <thead>
                            <tr>
                                
                                <th>Description de l'entretien</th>
                                <th>Intervalle (km)</th>
                                <th>Dernière Date d'Entretien</th>
                                <th>Dernier Kilométrage d'Entretien</th>
                                <th>Statut</th>
                                <th>Mettre à jour l'entretien</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($entretiens as $entretien): 
                                $status = '';
                                if ($entretien['dernier_km_entretien'] && ($entretien['kilometrage_total'] - $entretien['dernier_km_entretien']) < $entretien['interval_km']) {
                                    $status = 'A jour !';
                                    $statuscouleur = 'green';
                                } elseif ($entretien['kilometrage_total'] - ($entretien['dernier_km_entretien'] ?? 0) >= $entretien['interval_km']) {
                                    $status = 'A faire rapidement !';
                                    $statuscouleur = 'red';
                                } else {
                                    $status = 'A prévoir bientôt !';
                                    $statuscouleur = 'blue';
                                }
                            ?>
                            <tr class="<?= htmlspecialchars($status) ?>">
                                
                            <tr class="<?= htmlspecialchars($status) ?>">
                            <td style="background-color:<?= $statuscouleur ?>;"><?= htmlspecialchars($entretien['description']) ?></td>
                            <td style="color:<?= $statuscouleur ?>;"><?= htmlspecialchars($entretien['interval_km']) . ' km' ?></td>
                            <td style="color:<?= $statuscouleur ?>;"><?= htmlspecialchars($entretien['derniere_date_entretien']) ?></td>
                            <td style="color:<?= $statuscouleur ?>;"><?= htmlspecialchars($entretien['dernier_km_entretien']) . ' km' ?></td>
                            <td style="color:<?= $statuscouleur ?>;"><?= ucfirst(htmlspecialchars($status)) ?></td>
                            <td>
                                <form method="post" action="entretien.php?id_user_moto=<?= htmlspecialchars($id_user_moto) ?>">
                                    <input type="hidden" name="id_entretien_done" value="<?= htmlspecialchars($entretien['id_entretien']) ?>">
                                    <label for="kilometrage_done">Km:</label>
                                    <input type="number" id="kilometrage_done" name="kilometrage_done" required>
                                    <button type="submit">Confirmer</button>
                                </form>
                            </td>
</tr>
                                
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="contener_bottom">
            <?php include('footer.php'); ?>
        </div>
    </div>

</body>
</html>