<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Motard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('connexionbase.php'); ?>
    <header>
        <h1>Forum Motard</h1>
        <p>Détail</p>
    </header>

    <nav>
        <a href="index.php">Accueil</a>
        <a href="ajouter.php">Poster</a>
    </nav>  
    <div id="body2">

        <?php 
                if (isset($_POST['name']) && isset($_POST['commentaire'])) {
                    $prenom = $_POST["name"];
                    $commentaire = $_POST["commentaire"];
                    $dateDuJour = date("Y-m-d H:i:s");
                    $requete1 = 'INSERT INTO comment(Post_Id, Nickname, Contents,CreationTimestamp) VALUES (:Post_id,:Nickname, :Contents, :CreationTimestamp)';
                    $ex_requete1 = $pdo ->prepare($requete1);
                    $ex_requete1->execute(['Post_id' => $_GET['idpost'],'Nickname'=> $prenom,'Contents'=> $commentaire,'CreationTimestamp'=> $dateDuJour]);
                    header('Location: detail.php?idpost='.$_GET['idpost']);
                    exit();
                };


                $requete = 'SELECT p.*, a.FirstName, a.LastName, c.Name, co.Contents as commentaire , co.Nickname, co.CreationTimestamp as timecom
                FROM post p
                LEFT JOIN author a ON a.Id=p.Author_Id
                LEFT JOIN category c ON c.Id=p.Category_Id
                LEFT JOIN comment co ON co.Post_Id=p.Id
                WHERE p.Id = :idpost';
                $ex_requete = $pdo ->prepare($requete);
                $ex_requete->execute(['idpost' => $_GET['idpost']]);
                $res_requete = $ex_requete->fetchAll();
                
                        
                if (!empty($res_requete)) {
                    $valeur = $res_requete[0];
                    echo '<div id="post"><h2 class=h2>' .$valeur['Title']. '</h2>'. ' par '.'<h3 class=h3>' .$valeur['FirstName'].' ' .$valeur['LastName'] .'</h3>' 
                        .'<h4 class=h4>'.'"'.$valeur['Contents'].'"' .'</h4>'
                        .'<p class=p>' .$valeur['CreationTimestamp'].' ' .$valeur['Name'] .'</p></div>';
                    
                    echo '<h2>Commentaires :</h2>';
                }
                echo '<form  method="post">
                            <label for="nickname">Votre Prénon:</label>
                            <input id="nickname"  name="name">
                                
                            <label  for="commentaire">Votre commentaire:</label>
                            <input id="commentaire"  name="commentaire">

                            <input type="submit" value="Publier!">

                        </form>';

                foreach ($res_requete as $valeur) {
                    echo '<div id="postcom"><h2 class=h2>' .$valeur['Nickname']. '</h2>'.'<p class=pcom>' .$valeur['commentaire'].'<p class=p>' .$valeur['timecom'].'</p></div>';
                }; 
        ?>
    </div>
    <footer id="footer">
        <p>&copy; </p>
    </footer>

</body>
</html>