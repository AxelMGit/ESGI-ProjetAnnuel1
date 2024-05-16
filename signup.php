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
        

        // Vérification si le code de sécurité est correct
        if (isset($_POST["email"]) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["mdp"])) {
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $email = $_POST["email"]; 
            $mdp = $_POST["mdp"];
            $hashmdp = password_hash($mdp, PASSWORD_DEFAULT);
            $verification_code = "123"; // Code de sécurité généré précédemment
            
            // Envoi de l'email de confirmation
            $to = $email;
            $subject = 'Code de Verification';
            $message = 'This is a test email message.';
            $headers = 'From: lele23.meuret@gmail.com' . "\r\n" .
                        'Reply-To: lele23.meuret@gmail.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

            
            mail($to, $subject, $message, $headers);

            header('Location: confirmation.php');
            exit();
            
        };        
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
    
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <form class="formsign" method="post" action="confirmation.php" >
        <h3>Inscription</h3>
        <div class= "formsign_row">
            <div class="formsign_gauche">
                <label> Prénom :</label>
                <input type="text" placeholder="---" name="prenom">

                <label >Nom :</label>
                <input type="text" placeholder="---" name="nom">
            </div>
            <div class="formsign_droite">

                <label >Mail :</label>
                <input type="text" placeholder="example@mail.com" name="email">

                <label>Mot de passe :</label>
                <input type="password" placeholder="Mot de passe :" name="mdp">
            </div>
        </div>
        <button type="submit">S'incrire</button>
       
    </form>
</body>
</html>