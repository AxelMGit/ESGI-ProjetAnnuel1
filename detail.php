<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('connexionbase.php'); 
    session_start();
    if (!isset($_SESSION['id_user'])) {
        header('Location: index.php'); 
        exit();
    }
    else {
        $id_user = $_SESSION['id_user'];
    }
    
   
    
    if (isset($_POST['comment'])) {
        $dateDuJour = date("Y-m-d H:i:s");
        $requete1 = 'INSERT INTO comment(Contents, CreationTimestamp, id_user, id_post)
            VALUES (:Contents, :CreationTimestamp, :id_user, :id_post)';
        $ex_requete1 = $pdo->prepare($requete1);
        $ex_requete1->execute(['Contents' => $_POST['comment'], 'CreationTimestamp' => $dateDuJour, 'id_user' => $id_user, 'id_post' => $_GET["idpost"]]);
        header('Location: detail.php?idpost=' . $_GET['idpost']);
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
            <div id="bodyrow">
                <?php 
                    $requete1 = 'SELECT p.*, u.nom, u.prenom 
                    FROM post p
                    LEFT JOIN utilisateur u ON u.id_user = p.id_user Where id_post = :idpost';
                    $ex_requete1 = $pdo->prepare($requete1);
                    $ex_requete1->execute(['idpost' => $_GET['idpost']]);
                    $res_requete1 = $ex_requete1->fetchAll();
                    
                    foreach ($res_requete1 as $key => $valeur1) {
                        
                        echo '<div id="post" style="margin-left:20%;margin-top:3%" ><h3 class="h3"><img style ="width: 35px;color:white;margin-right:10px;"; src="img/profil-de-lutilisateur3.png">'.$valeur1['nom'].' '.$valeur1['prenom'].'</h3>' 
                            .'<p class="p">'.$valeur1['CreationTimestamp'].'</p>'
                            .'<h4 class="h4">'.substr($valeur1['Contents'], 0, 100).'</h4></div>';
                            
                    };
                ?>
            
                <div class="scroll-container">
                    <div class="scroll-content" id="content">
                        <div class="scrooll_haut">
                            <?php 
                                $requete2 = 'SELECT Contents, CreationTimestamp, nom, prenom, utilisateur.id_user From comment Join utilisateur on utilisateur.id_user = comment.id_user Where comment.id_post = :idpost';
                                $ex_requete2 = $pdo->prepare($requete2);
                                $ex_requete2->execute([':idpost' => $_GET['idpost']]);
                                $res_requete2 = $ex_requete2->fetchAll();
                                echo '<div class="comblock" style="background-color:rgba(255,255,255,0.13);font-size:25px;text-align:center;margin:0;padding:12.5px;"><h3 class="h3"> Commentaires </h3></div>';
                                foreach ($res_requete2 as $key2 => $valeur2) {
                                    
                                    echo '<div class="comblock"><h3 class="h3">'.$valeur2['nom'].' '.$valeur2['prenom'].'</h3>' 
                                    .'<p class="p">'.$valeur2['CreationTimestamp'].'</p>'
                                    .'<h4 class="h4">'.substr($valeur2['Contents'], 0, 100).'</h4></div>';
                                        
                                }
                            ?>
                        </div>
                        <form method="post">
                            <div class="scrool_bas">
                           
                                <textarea name="comment" placeholder="Écrire un commentaire..."></textarea>
                                <button type="submit" class="custom-button">&#10148;</button>
                            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                
        </div>

        <div id="footer" class="contener_bottom">
            <?php include('footer.php'); ?>
        </div>
    </div>
</body>
</html>

