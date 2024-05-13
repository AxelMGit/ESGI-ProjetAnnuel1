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
        <p>Modififer</p>
    </header>

    <nav >
        <a href="index.php">Accueil</a>
        <a href="ajouter.php">Poster</a>
    </nav>  
    <div id="body2">
        <form id="post" method="post">
            <?php 
                
                $requete = 'SELECT p.*, a.FirstName, a.LastName, c.Name, c.Id
                FROM post p
                LEFT JOIN author a ON a.Id=p.Author_Id
                LEFT JOIN category c ON c.Id=p.Category_Id
                WHERE p.Id = :idpost';
                $ex_requete = $pdo ->prepare($requete);
                $ex_requete->execute([':idpost' => $_GET['idpost']]);
                $res_requete = $ex_requete->fetchAll();
                
                
                if (!empty($res_requete)) {
                    $valeur = $res_requete[0];
                    
                    echo '<h2 class=h2><input name="title" value="'. $valeur['Title'] . '"></h2>'

                    .'  par ';
                    
                    $requete2 = 'SELECT Author.Id, FirstName, LastName
                    FROM author
                    WHERE Author.Id != :aid';
                    $ex_requete2 = $pdo->prepare($requete2);
                    $ex_requete2->execute(['aid' => $valeur['Author_Id']]);
                    $res_requete2 = $ex_requete2->fetchAll();
                    
                    
                    echo '<h2 class="h2">
                            <select id="auteur" name="auteur">
                                <option value="' . $valeur['Id'] . '" >' . $valeur['FirstName'] . ' ' . $valeur['LastName'] . ' </option>';
                    
                                foreach ($res_requete2 as $valeur2) {
                                    echo '<option value="' . $valeur2['Id'] . '">' . $valeur2['FirstName'] . ' ' . $valeur2['LastName'] . '</option>';
                                };

                    echo '</select></h2>';
                    
                    echo '<h4 class="h4"><input class="h4" name="com" value="'. $valeur['Contents'] . '"></h4>';

                    $requete1 = 'SELECT c.Id, c.Name
                    FROM category c
                    WHERE c.Id != :cid';
                    $ex_requete1 = $pdo->prepare($requete1);
                    $ex_requete1->execute(['cid' => $valeur['Category_Id']]);
                    $res_requete1 = $ex_requete1->fetchAll(); 
                    
                    echo 
                        '<p class=p><select name="categorie">
                            <option value="' . $valeur['Id'] . '">' . $valeur['Name'] . '</option>';
                            foreach ($res_requete1 as $valeur1){
                            echo
                                '<option value="' . $valeur1['Id'] . '">' . $valeur1['Name'] . '</option>';}
                    echo  '</select>';
                    
                    echo '' .$valeur['CreationTimestamp'].'</p>';           
                    echo '<h4 class="h4"><input  type="submit" value="Modifier!"></h4>';
                } 
            ?>

        </form>
        <?php 
        
            if (isset($_POST['title']) && isset($_POST['auteur']) && isset($_POST['com'])&& isset($_POST['categorie'])){
                $requete1 = 'UPDATE post Set Title = :titre , Contents = :com, Author_Id = :auteur, Category_Id = :categorie
                WHERE post.Id = :idpost;';
                
                $ex_requete1 = $pdo->prepare($requete1);
                $ex_requete1->execute([':categorie' => $_POST['categorie'], ':titre' => $_POST['title'], ':com' => $_POST['com'], ':auteur' => $_POST['auteur'],':idpost' => $_GET['idpost']]);
                header('Location: ajouter.php?' . $_GET['idpost']);
                exit();
            };
        
        ?>
    </div>

    <footer id="footer">
        <p>&copy; </p>
    </footer>

</body>
</html>