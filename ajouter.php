<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function updateConnectedUsers() {
            fetch('compteur.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('connected-users-count').innerText = data;
                });
        }

        setInterval(updateConnectedUsers, 5000); // Mettre à jour toutes les 5 secondes
        window.onload = updateConnectedUsers;
    </script>
</head>



<body>
    
    <?php include('connexionbase.php'); 
    session_start();
    if (!isset($_SESSION['id_user'])) {
        header('Location: index.php'); 
        exit();
    }?>



    <?php include('navbar.php'); ?>

    <div id="logo">
        <a href="index.php">
            <img src="img/logo.png" alt="logo">
        </a>
    </div>

    <div class="wrapper fixed-bottom-right">
            <a href="#demo-modal" >+</a>
    </div>


    <div id="connected-users">
        <strong>Personnes connectées : <span id="connected-users-count">0</span></strong>
    </div>
    
    <div id="body2">
     
        <?php 
        $requete1 = 'SELECT p.*, a.FirstName, a.LastName, c.Name
        FROM post p
        LEFT JOIN author a ON a.Id=p.Author_Id
        LEFT JOIN category c ON c.Id=p.Category_Id';
        $ex_requete1 = $pdo ->prepare($requete1);
        $ex_requete1->execute();
        $res_requete1 = $ex_requete1->fetchAll();
        

        





        foreach ($res_requete1 as $valeur1) {
              
            echo '<a id="post" href="detail.php?idpost='.$valeur1['Id'].'"><div><h3 class=h3>' .$valeur1['FirstName'].' ' .$valeur1['LastName'] .'</h3>' 
               
              .'<h4 class=h4>'.'"'.substr($valeur1['Contents'],0,100).'"' .'</h4>'
              .'<p class=p>' .$valeur1['CreationTimestamp'].' </p></div></a>'      
            
            ;

        }
        
        ?>
        

        <div id="demo-modal" class="modal">
            <div class="modal__content">
                

                <h1>Ajouter un post !</h1>
                <form method="post" >
                    
                    <textarea name="publi"></textarea>
                    
                    

                </form>
                

                <div class="modal__footer">
                   
                </div>

                <a href="#" class="modal__close">&times;</a>
            </div>
        </div>
    </div>




    


    
    
</body>
</html>
