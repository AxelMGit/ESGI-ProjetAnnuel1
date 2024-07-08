<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="stylesignup.css">
</head>

    <?php include('connexionbase.php');?>
    <?php
        require_once('vendor/autoload.php');
        use phpmailer\phpmailer\PHPMailer;
        require 'vendor/phpmailer/phpmailer/src/Exception.php';
        require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
        require 'vendor/phpmailer/phpmailer/src/SMTP.php';

        if (isset($_POST["mail"]) && isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["mdp"])) {
            $requete = 'SELECT mail, mdp FROM utilisateur WHERE mail = :email';
            $ex_requete = $pdo->prepare($requete);
            $ex_requete->execute([':email' => $_POST["mail"]]);
            $res_requete = $ex_requete->fetch(PDO::FETCH_ASSOC);

            if ($res_requete != NULL) {
                echo "L'adresse mail est déjà utilisée";
            } else {
                try {
                    $mail = new PHPMailer();
                    // echo "PhpMailer bien utilisé";
                } catch (Exception $e) {
                    $e->getMessage();
                }
                $nom = $_POST["nom"];
                $prenom = $_POST["prenom"];
                $email = $_POST["mail"];
                $mdp = $_POST["mdp"];
                $hashmdp = password_hash($mdp, PASSWORD_DEFAULT);

                session_start();
                $code = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
                $_SESSION['verifcode'] = $code;
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['email'] = $email;
                $_SESSION['mdp'] = $hashmdp;

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
                } else {
                    header('Location: confirmationsignup.php');
                    exit();
                }
            }
        }
    ?>
<body>
    <div class="container">
        <div class="contener_top">
            
            <a href="index.php">
                <img src="img/logo.png" alt="logo">
            </a>
            
            <a href="index.php"><button class="button_con_ins">Connexion</button></a>
            
        </div>

        <div class="contener_mid">
            <form class="formsign" method="post">
                <h3>Inscription</h3>
                <div class="formsign_row">
                    <div class="formsign_gauche">
                        <label>Prénom :</label>
                        <input type="text" placeholder="---" name="prenom">
                        <label>Nom :</label>
                        <input type="text" placeholder="---" name="nom">
                    </div>
                    <div class="formsign_droite">
                        <label>Mail :</label>
                        <input type="text" placeholder="exemple@mail.com" name="mail">
                        <label>Mot de passe :</label>
                        <input type="password" placeholder="Mot de passe :" name="mdp">
                    </div>
                </div>
                <button class="bttconnexion" type="submit">S'inscrire</button>
            </form>
        </div>

        <div class="contener_bottom">
            <?php include('footer.php'); ?>
        </div>
    </div>
</body>
</html>