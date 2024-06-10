<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Contact</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php 
include('connexionbase.php'); 
require_once('vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
?>

<?php include('navbar.php');?>

<div class="container">
    <div class="contener_top">
        <a href="index.php">
            <img src="img/logo.png" alt="logo">
        </a>
    </div>
</div>

<div class="contener_mid">
    <section class="contact">
        <h1>Contactez-nous</h1>
        <p>Nous serions ravis de répondre à vos questions et d'entendre vos suggestions. Veuillez remplir le formulaire ci-dessous pour nous contacter.</p>
        <br>

        <!-- PHP Mail Handling -->
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = filter_var(trim($_POST["name"]), FILTER_SANITIZE_STRING);
            $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
            $message = filter_var(trim($_POST["message"]), FILTER_SANITIZE_STRING);

            if (!empty($name) && !empty($email) && !empty($message)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $mail = new PHPMailer(true);

                    try {
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com'; 
                        $mail->SMTPAuth = true;
                        $mail->Username = 'rideawaycontact@gmail.com'; 
                        $mail->Password = 'scxg okmt cbkf ntmv'; 
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587;

                        $mail->setFrom('rideawaycontact@gmail.com', 'Contact Form');
                        $mail->addAddress('rideawaycontact@gmail.com'); 
                        $mail->addReplyTo($email, $name);

                        $mail->isHTML(false);
                        $mail->Subject = 'Nouveau message de contact';
                        $mail->Body = "Nom: $name\nEmail: $email\nMessage:\n$message";

                        $mail->send();
                        echo "<p class='success-message'>Votre message a bien été envoyé.</p>";
                    } catch (Exception $e) {
                        echo "<p class='error-message'>Erreur lors de l'envoi du message. Mailer Error: {$mail->ErrorInfo}</p>";
                    }
                } else {
                    echo "<p class='error-message'>Adresse e-mail invalide.</p>";
                }
            } else {
                echo "<p class='error-message'>Tous les champs sont requis.</p>";
            }
        }
        ?>

        <!-- Contact Form -->
        <form action="contact.php" method="post">
            <div class="form-group">
                <label for="name">Nom :</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Message :</label>
                <textarea id="message" name="message" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Envoyer</button>
            </div>
        </form>
    </section>
</div>

<div class="contener_bottom">
    <?php include('footer.php'); ?>
</div>

</body>
</html>
