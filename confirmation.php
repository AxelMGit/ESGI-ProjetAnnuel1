<html lang="en">
<head>
  
    <title>signup</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="stylesignup.css">
    
</head>

<body>
    <?php include('connexionbase.php'); ?>
    <?php
    

    // Vérification du code de sécurité
    if (isset($_POST["codeverif"])) {
        $verification_code = "123"; 
        
        // Si le code de sécurité entré correspond au code attendu
        if ($_POST["codeverif"] == $verification_code) {
            // Enregistrement final en base de données
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $email = $_POST["email"]; 
            $mdp = $_POST["mdp"];
            $hashmdp = password_hash($mdp, PASSWORD_DEFAULT);

            $requete1 = 'INSERT INTO utilisateur(nom, prenom, `mail`, mdp) VALUES (:nom, :prenom, :email, :mdp)';
            $ex_requete1 = $pdo->prepare($requete1);
            $ex_requete1->execute([':nom' => $nom, ':prenom'=> $prenom, ':email'=> $email, ':mdp'=> $hashmdp]);
            
            
            header('Location: index.php');
            exit();
        } else {
            // Afficher un message d'erreur ou réafficher la boîte de dialogue
            echo "Le code de sécurité est incorrect. Veuillez réessayer.";
        }
    }
?>
    
    ?>
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
                    <li><a href="index.php">Poster</a></li>
                    <li><a href="ajouter.php">Forum</a></li>
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
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    

    <dialog id="maBoiteDeDialogue" class="classdialogue">

            <video  preload="auto" autoplay loop muted>
                <source src="img\videor3.mov" type="video/mp4">
            </video>

            <form method="post" >
                <h3>Inscription</h3>

                <p>Vous allez recevoir un email de confirmation,</p>
                <p>si vous ne le recevez pas, veuillez vérifier votre boite de spam</p>


                <label> Veuillez saisir le code :</label>
                <input type="text" placeholder="------" name="codeverif">

                <button type="submit">Valider</button>
                
            
            </form>

            
            
            
    </dialog>

    <script>
            function ouvrirBoiteDialogue(event, idAuditeur) {
                event.preventDefault(); 

                
                
                var maBoiteDeDialogue = document.getElementById('maBoiteDeDialogue');
                maBoiteDeDialogue.showModal();

                var boutonFermer = document.getElementById('fermerDialogue');

               
                boutonFermer.addEventListener('click', function() {
                    maBoiteDeDialogue.close();
                    window.location.reload();
                });
                
            }
            
            
    </script>
    
    
    
</body>
</html>