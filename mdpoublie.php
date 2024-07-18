<html lang="en">
<head>
  
    <title>mot de passe oublié</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="stylesignup.css">
    
</head>

<body>
<?php include('connexionbase.php'); 
        require_once('vendor/autoload.php');
        use phpmailer\phpmailer\PHPMailer;

        require 'vendor\phpmailer\phpmailer\src\Exception.php';
        require 'vendor\phpmailer\phpmailer\src\PHPMailer.php';
        require 'vendor\phpmailer\phpmailer\src\SMTP.php';
            
    if (isset($_POST["mail"])) {
        $requete = 'SELECT mail FROM utilisateur WHERE mail = :email';
        $ex_requete = $pdo->prepare($requete);
        $ex_requete->execute([':email' => $_POST["mail"]]);
        $res_requete = $ex_requete->fetch(PDO::FETCH_ASSOC);
        
        if ($res_requete) {
            try {
                $mail = new PHPMailer();
                
                echo "PhpMailer bien utilisé";
    
            } catch (Exception $e) {
                $e->getMessage();
            }
            $email = $_POST['mail'];
            
            $code = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
            session_start();
            $_SESSION['verifcodeoublie'] = $code;
            $_SESSION['emailoublie'] = $email;
            
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = 'rideawaycontact@gmail.com';
            $mail->Password = 'scxg okmt cbkf ntmv';
            $mail->isHTML(true);
            $mail->setFrom('rideawaycontact@gmail.com', 'RideAway');
            $mail->addReplyTo('rideawaycontact@gmail.com', 'RideAway');
            $mail->addAddress($email);
            $mail->Subject = 'Code de verification RideAway';
            $mail->Body = 'Votre code de verification est : ' . $code;

            if (!$mail->send()) {
                // echo 'Erreur lors de l\'envoi du message : ' . $mail->ErrorInfo;
            }else {
                header('Location: mdpoublieverif.php');
                exit();
            }
        }
         else {
            echo "L'adresse email n'existe pas.";
        };
        

            

    };


    if (isset($_POST["codeverif"])) {
         
        session_start();

        
        if (isset($_SESSION['verifcode'])) {
            $code = $_SESSION['verifcode'];
        };


        if ($_POST["codeverif"] == $code) {
            $email = $_SESSION['email']; 
            
           
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
            
            echo "Le code de sécurité est incorrect. Veuillez réessayer.";
        }
    };
    ?>
    
   
  
    
    
    <div class="container">
        <div class="contener_top">
 
            <a href="index.php">
                <img src="img/logo.png" alt="logo">
            </a>
        
        </div>


        <div class="contener_mid">
            <dialog id="maBoiteDeDialogue" class="classdialogue">

                    <video  preload="auto" autoplay loop muted>
                        <source src="img\videobmw.mp4" type="video/mp4">
                    </video>

                    <form method="post" >
                        <h3>Mot de passe oublié.</h3>

                        <p>Veuillez rentrer votre adresse mail RideAway</p>
                        <br>


                        <label> Veuillez saisir votre mail :</label>
                        <input type="mail" placeholder="ride@away.com" name="mail">

                        <button type="submit">Valider</button>
                        
                    
                    </form>  
            </dialog>
        </div>


        <div class="contener_bottom">
            <?php include('footer.php'); ?>
        </div>
    </div>
</body>
</html>