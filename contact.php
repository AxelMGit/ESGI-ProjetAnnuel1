<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Contact</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include('connexionbase.php'); ?>

    
    <?php include('navbar.php'); ?>
    

   
    
    <div class="contact">
        <h1>Contactez-nous</h1>
        <p>Nous serions ravis de répondre à vos questions et d'entendre vos suggestions. Veuillez remplir le formulaire ci-dessous pour nous contacter.</p>
            <br>
        <form action="submit_contact.php" method="post">
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
    </div>

    <footer>
        <div class="footer">
            <div class="row"></div>
            <div class="row">
                <ul>
                    <li><a href="application.html">L'application</a></li>
                    <li><a href="contact.php">Assistance</a></li>
                    <li><a href="#">À propos de nous</a></li>
                    <li><a href="termes_conditions.html">Termes & Conditions</a></li>
                </ul> 
            </div>
        </div>
    </footer>
</body>
</html>
