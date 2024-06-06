<html lang="en">
<head>
  
    <title>signup</title>
 
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
                        <source src="img\videor3.mov" type="video/mp4">
                    </video>

                    <form method="post" >
                        <h3>Connexion</h3>

                        <p>Vous allez recevoir un email de confirmation,</p>
                        <p>si vous ne le recevez pas, veuillez vérifier votre boite de spam</p>


                        <label> Veuillez saisir le code :</label>
                        <input type="text" placeholder="------" name="codeverif">

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