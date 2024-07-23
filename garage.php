<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="chatbot.js"></script>
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

        
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_moto = $_POST['moto'];
            $id_user = $_SESSION['id_user'];  
            $kilometrage_initial = $_POST['kilometrage_initial'];
            
            $requete1 = "INSERT INTO user_motos (id_user, id_moto, kilometrage_total)
            VALUES (:id_user, :id_moto, :kilometrage_total);";
            $ex_requete1 = $pdo->prepare($requete1);
            $ex_requete1->execute([':id_user' => $id_user, ':id_moto'=> $id_moto, ':kilometrage_total'=> $kilometrage_initial ]);   
            
            
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
            <dialog id="maBoiteDeDialogue" class="classdialoguegarage">
                <div class="dialog_gauche">
                    <form method="post" >
                        <div class="comblock" style="background-color:rgba(255,255,255,0.13);font-size:25px;text-align:center;margin:0;padding:12.5px;width: 80%;">
                            <h3 class="h3"> Ajouter une moto : </h3>
                        </div>
                        
                        <?php
                            $requete = 'SELECT id_moto, marque, modele, annee FROM motos ORDER BY marque ASC;';
                            $ex_requete = $pdo->prepare($requete);
                            $ex_requete->execute();
                            $res_requete = $ex_requete->fetchAll();
                        ?>
                        
                        <label>Veuillez choisir votre moto :</label>
                        <select id="moto" name="moto" required>
                            <option value="" hidden selected disabled></option>
                            <?php
                            foreach ($res_requete as $valeur) {
                                echo '<option value="' . $valeur['id_moto'] . '">' . $valeur['marque'] . ' ' . $valeur['modele'] .  ' ' . $valeur['annee'] .'</option>';
                            }
                            ?>
                        </select>
                        <br>

                        <label> Veuillez saisir le kilometrage de la moto :</label>
                        <input type="number" placeholder="------" name="kilometrage_initial" required>
                        <br><br>

                        <button type="submit">Valider</button>
                    </form>  
                </div>
                
                <div class="dialog_droite">
                    <?php 
                        $id_user = $_SESSION['id_user'];
                        $requete2 = 'SELECT motos.modele, motos.marque, motos.annee, user_motos.kilometrage_total, user_motos.id_user_moto 
                                     FROM motos
                                     JOIN user_motos ON motos.id_moto = user_motos.id_moto 
                                     WHERE user_motos.id_user = :user';
                        $ex_requete2 = $pdo->prepare($requete2);
                        $ex_requete2->execute([':user' => $id_user]);
                        $res_requete2 = $ex_requete2->fetchAll();

                        echo '<div class="comblock" style="background-color:rgba(255,255,255,0.13);font-size:25px;text-align:center;margin:0;padding:12.5px;"><h3 class="h3"> Mes motos : </h3></div>';
                        foreach ($res_requete2 as $valeur2) {
                            echo '<a href="entretien.php?id_user_moto='.$valeur2['id_user_moto'].'"><div class="comblock"><h3 class="h3">'.$valeur2['marque'].' '.$valeur2['modele'].'</h3>' 
                                 .'<p class="p">'.$valeur2['annee'].'</p>'
                                 .'<h4 class="h4">'.substr($valeur2['kilometrage_total'], 0, 100).' km</h4></div><br></a>';
                        }
                    ?>
                </div>
            </dialog>
        </div>

        <div class="contener_bottom">
            <?php include('footer.php'); ?>
        </div>
    </div>
</body>
</html>