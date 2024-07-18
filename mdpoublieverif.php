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
    

    if (isset($_POST["codeverif"])) {
         
        session_start();

        
        if (isset($_SESSION['verifcodeoublie'])) {
            $code = $_SESSION['verifcodeoublie'];
        };


        if ($_POST["codeverif"] == $code) {
            
            header('Location: mdpchangement.php');
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
                        <source src="img\diavelvideo.mp4" type="video/mp4">
                    </video>

                    <form method="post" >
                        <h3>Vérification</h3>

                        <p>Veuillez saisir le code reçu par Mail</p>
                        <br>


                        <label> Veuillez saisir le code: </label>
                        <input type="mail" placeholder="-----" name="codeverif">

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