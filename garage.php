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
    

    <?php include('connexionbase.php'); 
        session_start();
        if (!isset($_SESSION['id_user'])) {
            header('Location: index.php'); 
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
            <dialog id="maBoiteDeDialogue" class="classdialoguegarage">
                <div class="dialog_gauche">
                    <form method="post" >
                        
                        <?php
                            $requete = 'SELECT id_moto, marque, modele, annee 
                                FROM motos order by marque ASC;';
                            $ex_requete = $pdo->prepare($requete);
                            $ex_requete->execute();
                            $res_requete = $ex_requete->fetchAll();
                        ?>
                        <label >Veuillez choisir votre moto :</label>
                        <select id="moto" name="moto">
                            <option value="" hidden selected disabled required></option>
                            <?php
                            foreach ($res_requete as $valeur) {
                                echo '<option value="' . $valeur['id_moto'] . '">' . $valeur['marque'] . ' ' . $valeur['modele'] .  '  ' . $valeur['annee'] .'</option>';
                            }
                            ; 

                            ?>
                        </select>

                        <label> Veuillez saisir le kilometrage de la moto :</label>
                        <input type="text" placeholder="------" name="kmtotale">
                        
                        <button type="submit">Valider</button>
                        
                    </form>  
                </div>
                <div class="dialog_droite">
                    
                </div>
            </dialog>
        </div>

        


        <div class="contener_bottom">
            <?php include('footer.php'); ?>
        </div>
    </div>

    
</body>
</html>