<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="page">
        <div id="nav-container">
            <div class="bg"></div>
            <div class="button" tabindex="0">
                <span class="icon-bar jaune"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar jaune"></span>
            </div>
            <div id="nav-content" tabindex="0">
                <ul>
                    <li><a href="ajouter.php">Poster</a></li>
                    <li><a href="#0">Forum</a></li>
                    <li><a href="#0">Entretiens</a></li>
                    <li><a href="#0">GPS moto</a></li>
                    <li><a href="#0">Contact</a></li>
                </ul>
            </div>
        </div>

        <div id="logo">
    <a href="index.php">
        <img src="img/logo.png" alt="logo">
    </a>
</div>

        <div class="login-buttons">
            <a href="login.php" class="login-button">Connexion</a>
            <a href="signup.php" class="signup-button">Inscription</a>

        </div>
    </div>
        
    <div id="body2">
        <form method="post" id="post">
            
            <?php
            $requete = 'SELECT author.id aid, FirstName, LastName
                FROM author;';
            $ex_requete = $pdo->prepare($requete);
            $ex_requete->execute();
            $res_requete = $ex_requete->fetchAll();
            ?>
            <label for="auteur">Auteurs:</label>
            <select id="auteur" name="auteur">
                <option value="" hidden selected disabled required></option>
                <?php
                foreach ($res_requete as $valeur) {
                    echo '<option value="' . $valeur['aid'] . '">' . $valeur['FirstName'] . ' ' . $valeur['LastName'] . '</option>';
                }
                ;

                ?>
            </select>
            <?php
        
            $requete = 'SELECT category.id cid, category.name
            FROM category;';
            $ex_requete = $pdo->prepare($requete);
            $ex_requete->execute();
            $res_requete = $ex_requete->fetchAll();
            ?>
            <h3 class="h3">
                <label for="categorie">Votre Catégorie</label>
                <select id="categorie" name="categorie">
                    <option value="" hidden selected disabled required></option>
                    <?php
                    foreach ($res_requete as $valeur) {
                        echo '<option value="' . $valeur['cid'] . '">' . $valeur['name'] . '</option>';
                    }
                    ;
                    ?>
                </select>
            </h3>      

            <input type="submit" value="Publier!">

        </form>
    </div>
        <?php
        if (isset($_POST['categorie']) && isset($_POST['title']) && isset($_POST['publi']) && isset($_POST['auteur'])) {


            $dateDuJour = date("Y-m-d H:i:s");
            $requete1 = 'INSERT INTO post(Category_Id, Title, Contents, Author_Id, CreationTimestamp)
                VALUES (:categorie , :title , :Contents, :author, :CreationTimestamp)';
            $ex_requete1 = $pdo->prepare($requete1);
            $ex_requete1->execute(['categorie' => $_POST['categorie'], 'title' => $_POST['title'], 'Contents' => $_POST['publi'], 'author' => $_POST['auteur'], 'CreationTimestamp' => $dateDuJour]);
            header('Location: ajouter.php?' . $_GET['idpost']);
            exit();
        }
        ;
        ?>
        <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <!-- affichage artcle pour pouvoir supprimer /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    
            <?php
            $requete = 'SELECT p.*, a.FirstName, a.LastName, c.Name
            FROM post p
            LEFT JOIN author a ON a.Id=p.Author_Id
            LEFT JOIN category c ON c.Id=p.Category_Id';
            $ex_requete = $pdo->prepare($requete);
            $ex_requete->execute();
            $res_requete = $ex_requete->fetchAll();
            foreach ($res_requete as $valeur) {

                echo '<a id="post" href="detail.php?idpost=' . $valeur['Id'] . '"><h2 class=h2>' . $valeur['Title'] . '</h2>' . ' par ' . '<h3 class=h3>' . $valeur['FirstName'] . ' ' . $valeur['LastName'] . '</h3>'

                    . '<h4 class=h4>' . '"' . substr($valeur['Contents'], 0, 100) . '"' . '</h4>'
                    . '<p class=p>' . $valeur['CreationTimestamp'] . ' ' . $valeur['Name'] . '</p></a>'

                    . '<button class="button modify-button"><a href="modifier.php?idpost='.$valeur['Id'].'"> Modifier article </a></button>' // Bouton Modifier article

                    . '<form method="post" class="delete-form" >
                        <input type="hidden" name="post_id" value="' . $valeur['Id'] . '">
                        <button type="submit" name="delete" class="button delete-button">Supprimer</button>
                    </form>';

            }
            ?>

            <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["delete"])) {

                    $sqlDeleteComments = "DELETE FROM comment WHERE post_id = :post_id";
                    $stmtDeleteComments = $pdo->prepare($sqlDeleteComments);
                    $stmtDeleteComments->execute(['post_id' => $_POST['post_id']]);


                    $sqlDeletePost = "DELETE FROM post WHERE Id = :post_id";
                    $stmtDeletePost = $pdo->prepare($sqlDeletePost);
                    $stmtDeletePost->execute(['post_id' => $_POST['post_id']]);

                    header('Location: ajouter.php?' . $_GET['idpost']);
                    exit();

                }
            }

            ?> 
    </div>
</body>
</html>
