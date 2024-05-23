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
        

       
        if (isset($_POST["email"]) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["mdp"])) {
            $email = $_POST["email"];
            $verification_code = "123"; 
            
           
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth = true;
            $mail->Username = 'rideawaycontact@gmail.com';
            $mail->Password = 'ClementAxelLeo';

        };       
        
        
        $subject = 'code';
        $message = 'testestestestestes';
        $headers = 'rideawaycontact@gmail.com' . "\r\n" .
            'Reply-To: rideawaycontact@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        // Création de l'objet PHPMailer
        require_once('../../PHPMailer/vendor/autoload.php');
        $mail = new PHPMailer();
        

        // Ajout du content type pour le mail
        $mail->isHTML(true);

        // Configuration de l'email à envoyer
        $mail->setFrom('rideawaycontact@gmail.com', 'RideAway');
        $mail->addReplyTo('rideawaycontact@gmail.com', 'RideAway');
        $mail->addAddress($email);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->addCustomHeader('Return-Path', 'rideawaycontact@gmail.com');
        

        // Envoi de l'email
        if (!$mail->send()) {
            echo 'Erreur lors de l\'envoi du message : ' . $mail->ErrorInfo;
        } else {
            echo 'L\'alerte pour les absences a bien été envoyée par mail.';
        }

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
    
    <div class="background">
    </div>
    
    <form class="formsign" method="post">
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

                <input type="text" placeholder="exemple@mail.com" name="mail">

                <label>Mot de passe :</label>
                <input type="password" placeholder="Mot de passe :" name="mdp">
            </div>
        </div>
        <button type="submit">S'incrire</button>
       
    </form>
</body>
</html>