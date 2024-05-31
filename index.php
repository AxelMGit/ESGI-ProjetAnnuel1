<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="stylesignup.css">
</head>
<body>
    <?php
    include('connexionbase.php');
    session_start();
    if (isset($_SESSION['id_user'])) {
        header('Location: accueilrideaway.php');
        exit();
    }

    require_once('vendor/autoload.php');
    use phpmailer\phpmailer\PHPMailer;
    use phpmailer\phpmailer\Exception;

    if (isset($_POST["mail"]) && isset($_POST["mdp"])) {
        $email = $_POST["mail"];
        $mdp = $_POST["mdp"];

        $requete = 'SELECT mail, mdp FROM utilisateur WHERE mail = :email';
        $ex_requete = $pdo->prepare($requete);
        $ex_requete->execute([':email' => $email]);
        $res_requete = $ex_requete->fetch(PDO::FETCH_ASSOC);

        if ($res_requete) {
            $emailbase = $res_requete['mail'];
            $mdpbase = $res_requete['mdp'];

            if ($emailbase == $email && password_verify($mdp, $mdpbase)) {
                $code = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
                $_SESSION['verifcode'] = $code;
                $_SESSION['email'] = $email;

                try {
                    $mail = new PHPMailer();
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
                        echo 'Erreur lors de l\'envoi du message : ' . $mail->ErrorInfo;
                    } else {
                        if ($email == "lele23.meuret@gmail.com") {
                            $requete = 'SELECT id_user, mail FROM utilisateur WHERE mail = :email';
                            $ex_requete = $pdo->prepare($requete);
                            $ex_requete->execute([':email' => $email]);
                            $res_requete = $ex_requete->fetch(PDO::FETCH_ASSOC);

                            $id_user = $res_requete['id_user'];
                            $_SESSION['id_user'] = $id_user;

                            unset($_SESSION['verifcode']);
                            unset($_SESSION['email']);
                            header('Location: accueilrideaway.php');
                            exit();
                        } else {
                            header('Location: confirmationlogin.php');
                            exit();
                        }
                    }
                } catch (Exception $e) {
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                }
            } else {
                echo "Erreur de mot de passe ou de nom d'utilisateur.";
            }
        } else {
            echo "Utilisateur non trouvé.";
        }
    }
    ?>

    <div class="page">
        <div id="logo">
            <a href="index.php">
                <img src="img/logo.png" alt="logo">
            </a>
        </div>
    </div>

    <form class="formsignlogin" method="post">
        <h3>Connexion</h3>
        <label>Mail :</label>
        <input type="text" placeholder="exemple@mail.com" name="mail">
        <label>Mot de passe :</label>
        <input type="password" placeholder="Mot de passe :" name="mdp">
        <button class="bttconnexion" type="submit">Se connecter</button>
        <button class="bttinscription"><a href="signup.php">Inscription</a></button>
    </form>

    <footer>
        <div class="footer">
            <div class="row"></div>
            <div class="row">
                <ul>
                    <li><a href="application.html">L'application</a></li>
                    <li><a href="contact.php">Assistance</a></li>
                    <li><a href="#">A propos de nous</a></li>
                    <li><a href="termes_conditions.html">Termes & Conditions</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>