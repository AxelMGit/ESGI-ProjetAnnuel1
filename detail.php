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
    
        if (isset($_POST['publi'])) {


            $dateDuJour = date("Y-m-d H:i:s");
            $requete1 = 'INSERT INTO post(Contents, CreationTimestamp, id_user)
                VALUES (:Contents, :CreationTimestamp, :id_user)';
            $ex_requete1 = $pdo->prepare($requete1);
            $ex_requete1->execute(['Contents' => $_POST['publi'], 'CreationTimestamp' => $dateDuJour, 'id_user' => $id_user]);
            header('Location: ajouter.php?' . $_GET['idpost']);
            exit();
        }
        ;

    
     ?>
    

    <?php include('navbar.php'); ?>
        
    <div class="container">
        <div class="contener_top">
            <a href="index.php">
                <img src="img/logo.png" alt="logo">
            </a>
        </div>

        <div class="contener_mid">
            <div id="body2">
                <?php 
                    $requete1 = 'SELECT p.*, u.nom, u.prenom 
                    FROM post p
                    LEFT JOIN utilisateur u ON u.id_user = p.id_user Where id_post = :idpost';
                    $ex_requete1 = $pdo->prepare($requete1);
                    $ex_requete1->execute(['idpost' => $_GET['idpost']]);
                    $res_requete1 = $ex_requete1->fetchAll();
                    
                    foreach ($res_requete1 as $key => $valeur1) {
                        
                        echo '<div id="post" style="margin-left:-20%;margin-bottom:5%;" ><h3 class="h3">'.$valeur1['nom'].' '.$valeur1['prenom'].'</h3>' 
                            .'<h4 class="h4">'.'"'.substr($valeur1['Contents'], 0, 100).'"</h4>'
                            .'<p class="p">'.$valeur1['CreationTimestamp'].'</p></div>';
                    }
                ?>
                
        </div>

        <div id="footer" class="contener_bottom">
            <?php include('footer.php'); ?>
        </div>
    </div>
</body>
</html>

