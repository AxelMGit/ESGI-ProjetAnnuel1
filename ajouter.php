<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="style.css">
    <script>
        
        
        window.addEventListener('scroll', function() {
            const buttonWrapper = document.querySelector('.wrapper.fixed-bottom-right');
            const footer = document.getElementById('footer');
            const footerRect = footer.getBoundingClientRect();
            const windowHeight = window.innerHeight;

            
            if (footerRect.top <= windowHeight) {
                
                buttonWrapper.style.position = 'absolute';
                buttonWrapper.style.top = `${window.scrollY + footerRect.top - buttonWrapper.offsetHeight - 20}px`;
                buttonWrapper.style.bottom = 'auto';
            } else {
                
                buttonWrapper.style.position = 'fixed';
                buttonWrapper.style.bottom = '20px';
                buttonWrapper.style.top = 'auto';
            }
        });


    </script>
    
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
                LEFT JOIN utilisateur u ON u.id_user = p.id_user Order by id_post DESC';
                $ex_requete1 = $pdo->prepare($requete1);
                $ex_requete1->execute();
                $res_requete1 = $ex_requete1->fetchAll();
                
                foreach ($res_requete1 as $key => $valeur1) {
                    $lastClass = ($key === array_key_last($res_requete1)) ? 'last-post' : '';
                    echo '<a id="post" href="detail.php?idpost='.$valeur1['id_post'].'"><div class="'.$lastClass.'"><h3 class="h3">'.$valeur1['nom'].' '.$valeur1['prenom'].'</h3>' 
                        .'<h4 class="h4">'.'"'.substr($valeur1['Contents'], 0, 100).'"</h4>'
                        .'<p class="p">'.$valeur1['CreationTimestamp'].'</p></div></a>';
                }
                ?>
                <div id="demo-modal" class="modal">
                    <div class="modal__content">
                        <h1>Ajouter un post !</h1>
                        <form method="post">
                            <textarea name="publi"></textarea>
                            <button type="submit">Poster</button>
                        </form>
                        <div class="modal__footer"></div>
                        <a href="#" class="modal__close">&times;</a>
                    </div>
                </div>
            </div>
            
            <div class="wrapper fixed-bottom-right">
                <a href="#demo-modal">+</a>
            </div>
        </div>

        <div id="footer" class="contener_bottom">
            <?php include('footer.php'); ?>
        </div>
    </div>
</body>
</html>

