<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function updateConnectedUsers() {
            fetch('compteur.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('connected-users-count').innerText = data;
                });
        }

        setInterval(updateConnectedUsers, 5000); // Mettre à jour toutes les 5 secondes
        window.onload = updateConnectedUsers;
    </script>
</head>



<body>
    <div class="page">
        <?php include('connexionbase.php'); 
        session_start();
        if (!isset($_SESSION['id_user'])) {
            header('Location: index.php'); 
            exit();
        }?>




        
            <div id="logo">
                <a href="index.php">
                    <img src="img/logo.png" alt="logo">
                </a>
            </div>


            <?php include('navbar.php'); ?>


            <div id="connected-users">
                <strong>Personnes connectées : <span id="connected-users-count">0</span></strong>
            </div>
    </div>


    


    
    
</body>
</html>
