<html lang="en">
<head>
  
    <title>login</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="stylesignup.css">
    
</head>

    <?php include('connexionbase.php'); 
    session_start();
    if (isset($_SESSION['id_user'])) {
        header('Location: accueilrideaway.php'); 
        exit();
    }
    ?>

    <?php
        require_once('vendor/autoload.php');
        use phpmailer\phpmailer\PHPMailer;
        
        require 'vendor\phpmailer\phpmailer\src\Exception.php';
        require 'vendor\phpmailer\phpmailer\src\PHPMailer.php';
        require 'vendor\phpmailer\phpmailer\src\SMTP.php';

         

       
        if (isset($_POST["mail"]) && isset($_POST["mdp"])) {
            
            try {
                $mail = new PHPMailer();
                
                echo "PhpMailer bien utilisé";
    
            } catch (Exception $e) {
                $e->getMessage();
            }
            
            
            $email = $_POST["mail"];
            $mdp = $_POST["mdp"];
            

            $requete = 'SELECT mail, mdp
            FROM utilisateur Where mail = :email';
            $ex_requete = $pdo->prepare($requete);
            $ex_requete->execute([':email' => $email]);
            $res_requete = $ex_requete->fetch(PDO::FETCH_ASSOC);

            $emailbase = $res_requete['mail'];
            $mdpbase = $res_requete['mdp'];
            
            if($emailbase == $email && password_verify($mdp, $mdpbase)){
                session_start();
                $code = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

           
                $_SESSION['verifcode'] = $code;
                    
                
                
                $_SESSION['email'] = $email;
                $_SESSION['mdp'] = $hashmdp;


                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAuth = true;
                $mail->Username = 'rideawaycontact@gmail.com';
                $mail->Password = 'scxg okmt cbkf ntmv';


                $subject = 'Code de verification RideAway';
                $message ='Votre code de verification est :  '. $code;
                $headers = 'rideawaycontact@gmail.com' . "\r\n" .
                    'Reply-To: rideawaycontact@gmail.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                $mail->isHTML(true);

            
                $mail->setFrom('rideawaycontact@gmail.com', 'RideAway');
                $mail->addReplyTo('rideawaycontact@gmail.com', 'RideAway');
                $mail->addAddress($email);
                $mail->Subject = $subject;
                $mail->Body = $message;
                $mail->addCustomHeader('Return-Path', 'rideawaycontact@gmail.com');
                

                
                if (!$mail->send()) {
                    echo 'Erreur lors de l\'envoi du message : ' . $mail->ErrorInfo;
                } else {
                    if($email == "lele23.meuret@gmail.com"){

                        $requete = 'SELECT id_user, mail
                        FROM utilisateur Where mail = :email';
                        $ex_requete = $pdo->prepare($requete);
                        $ex_requete->execute([':email' => $email]);
                        $res_requete = $ex_requete->fetch(PDO::FETCH_ASSOC);

                        $id_user = $res_requete['id_user'];
                        $_SESSION['id_user'] = $id_user;

                        unset($_SESSION['verifcode']);
                        unset($_SESSION['email']);
                        unset($_SESSION['mdp']);

                        header('Location: accueilrideaway.php');
                        exit();

                    } else { 
                        
                        header('Location: confirmationlogin.php');
                        exit();
                    }
                };
            }else {
                echo "Erreur de mot de passe ou de nom d'utilisateur.";
            }
                
        };       
        
        
        

    ?>
<body>
        
    <div class="container">
        <div class="contener_top">
            
            <a href="index.php">
                <img src="img/logo.png" alt="logo">
            </a>
            
            <a href="signup.php"><button class="button_con_ins">Inscription</button></a>
            
        </div>

        <div class="contener_mid">
            <form class="formsignlogin" method="post" >
            
                <h3>Connexion</h3>
                    
                <label >Mail :</label>
                <input type="text" placeholder="exemple@mail.com" name="mail">

                <label>Mot de passe :</label>
                <input type="password" placeholder="Mot de passe :" name="mdp">
                
                <button class="bttconnexion" type="submit">Se connecter</button>
            </form>
        </div>
    

        <div class="contener_bottom">
            <?php include('footer.php'); ?>
        </div>
</body>
</html>


        
        
         