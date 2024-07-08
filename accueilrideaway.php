<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="chatbot.js"></script>
    <title>RideAway</title>
</head>
<body>
    

    <?php include('connexionbase.php'); 
        session_start();
        if (!isset($_SESSION['id_user'])) {
            header('Location: index.php'); 
            exit();
        }
    ?>

    
    <?php include('navbar.php'); ?>
        
    <div class="container">
        <div class="contener_top">
 
            <a href="index.php">
                <img src="img/logo.png" alt="logo"> 
            </a>
        
        </div>


        <div class="contener_mid">
        </div>

        <div id="rasa-chat-widget" 
            data-websocket-url="http://localhost:5005"
            data-close-on-outside-click
            data-initial-payload="Bonjour !"
            data-primary="#434343"
            data-primary-highlight=""
        ></div>
        <script src="https://unpkg.com/@rasahq/rasa-chat" type="application/javascript"></script>


        <div class="contener_bottom">
            <?php include('footer.php'); ?>
        </div>
    </div>

    
</body>
</html>