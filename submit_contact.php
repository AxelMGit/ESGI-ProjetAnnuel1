<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $to = "rideawaycontact@gmail.com";

    $subject = "Nouveau message de contact";

    $body = "Nom: $name\n";
    $body .= "Email: $email\n";
    $body .= "Message:\n$message";

    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "Votre message a bien été envoyé.";
    } else {
        echo "Erreur lors de l'envoi du message.";
    }
}
?>
