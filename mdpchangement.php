<html lang="en">
<head>
  
    <title>réussi</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="stylesignup.css">
    
</head>

<body>
<?php include('connexionbase.php'); 
    
    
    if (isset($_POST["nouveaumdp"]) && isset($_POST['confirmmdp']) && ($_POST["nouveaumdp"]) == ($_POST['confirmmdp'])){
        session_start();
        $email = $_SESSION['emailoublie']; 
        $hashed_password = password_hash($_POST['confirmmdp'], PASSWORD_BCRYPT);
        $requete2 = 'UPDATE utilisateur SET mdp = :mdp WHERE mail = :email';
        $ex_requete2 = $pdo->prepare($requete2);
        $ex_requete2->execute([':email' => $email, ':mdp' => $hashed_password]);

        header('Location: index.php');
        exit();

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
                        <source src="img\gsvideo.mp4" type="video/mp4">
                    </video>

                    <form method="post" >
                        <h3>Changement de mot de passe :</h3>

                        <div class="password-container">
                            <label for="nouveaumdp">Nouveau mot de passe :</label>
                            <input type="password" placeholder="" id="nouveaumdp" name="nouveaumdp">
                            <button type="button" onclick="togglePassword('nouveaumdp')">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>

                        <br> 

                        <div class="password-container">
                            <label for="confirmmdp">Confirmation nouveau mot de passe :</label>
                            <input type="password" placeholder="" id="confirmmdp" name="confirmmdp">
                            <button type="button" onclick="togglePassword('confirmmdp')">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>

                        <button type="submit">Valider</button>
                        
                    
                    </form>  
            </dialog>
        </div>


        <div class="contener_bottom">
            <?php include('footer.php'); ?>
        </div>
    </div>
    <script>
        function togglePassword(id) {
            var input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
    </script>
</body>
</html>