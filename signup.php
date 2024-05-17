<html lang="en">
<head>
  
    <title>signup</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css">
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

.background{
    width: 430px;
    height: 520px;
    position: relative;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 300px;
    width: 300px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #ff8554,
        #ff0000
    );
    
    left: -250px;
    top: -100px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff8554,     
        #ff0000
    );
    
    right: -250px;
    bottom: -170px;
}

.formsign{
    height: 65%;
    width: 40%;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 55%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
    
    
}
.formsign_row{
    height: 60%;
    width: 100%;
    margin-top: 3%;
    display: flex;
    flex-direction: row;
}

.formsign_gauche{
    height: 100%;
    width: 50%;
    padding: 50px 35px;
    padding-bottom: 5%;
    
    display: flex;
    flex-direction: column;
}

.formsign_droite{
    height: 100%;
    width: 50%;
    padding: 50px 35px;
    padding-bottom: 5%;
    display: flex;
    flex-direction: column;
}

.classdialogue{
  width: 50%;
  height: 80%;
  position: fixed;
  margin-left: 25%;
  margin-top: 7%;
  
  
  background-color: rgba(38, 32, 32, 0.70);
  z-index: 1;
  backdrop-filter: blur(10px);
  border: 2px solid rgba(255,255,255,0.1);
  box-shadow: 0 0 40px rgba(8,7,16,0.6);
  overflow: hidden;
  
}

dialog form {
    
    position: absolute;
    width: 35%;
    height: 80%;
    left: 55%;
    top:7%;
    
    
    border-radius: 10px;
    padding: 15px;
    
}



video{
    position: relative;
    max-width: 50%;
    width: 550px;
    
    
    left: 0;
    margin-left: -6%;
    background-color: rgba(38, 32, 32, 0.0);
    
}
dialog button{
    
    width: 90%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
    margin-left: 5%;
    margin-top: 50%;
}
dialog input{
    display: flex;
    height: 10%;
    min-height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    margin-top: 5%;
    
    
    font-size: 14px;
    font-weight: 300;
}

dialog label{
    display: flex;
    margin-top: 10%;
    font-size: 16px;
    font-weight: 500;
}
dialog form h3{
    margin-top: 15%;
    font-size: 32px;
    font-weight: 300;
    line-height: 30px;
    text-align: center;
    justify-content: center;
}
dialog p{
    margin-top: 10%;
    font-size: 15px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
    
}

form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
    justify-content: center;
}

label{
    display: flex;
    
    font-size: 16px;
    font-weight: 500;
}
input{
    display: flex;
    height: 25%;
    min-height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    
    
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
button{
    
    width: 90%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
    margin-left: 5%;
}

button:hover{
    opacity: 0.5;

}


    </style>
</head>

<body>
        <?php include('connexionbase.php'); ?>
        <?php 

            if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["prenom"]) && isset($_POST["prenom"])){
                
                $nom = $_POST["nom"];
                $prenom = $_POST["prenom"];
                $mail = $_POST["mail"];
                $mdp = $_POST["mdp"];
                $hashmdp = password_hash($mdp, PASSWORD_DEFAULT);

                
                $requete1 = 'INSERT INTO utilisateur(nom, prenom, mail, mdp) VALUES (:nom, :prenom, :email,:mdp)';
                $ex_requete1 = $pdo ->prepare($requete1);
                $ex_requete1->execute([':nom' => $nom,':prenom'=> $prenom,':email'=> $mail,':mdp'=> $hashmdp]);
                header('Location: index.php');
                exit();


            }
        ?>
    <div class="page">
        <div id="nav-container">
            <div class="bg"></div>
            <div class="button" tabindex="0">
                <span class="icon-bar jaune"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar jaune"></span>
            </div>
            <div id="nav-content" tabindex="0">
                <ul>
                    <li><a href="ajouter.php">Poster</a></li>
                    <li><a href="#0">Forum</a></li>
                    <li><a href="#0">Entretiens</a></li>
                    <li><a href="#0">GPS moto</a></li>
                    <li><a href="#0">Contact</a></li>
                </ul>
            </div>
        </div>

        <div id="logo">
    <a href="index.php">
        <img src="img/logo.png" alt="logo">
    </a>
</div>

        <div class="login-buttons">
            <a href="login.php" class="login-button">Connexion</a>
            <a href="signup.php" class="signup-button">Inscription</a>

        </div>
    </div>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form class="formsign" method="post" onsubmit="ouvrirBoiteDialogue(event)">
        <h3>Inscription</h3>
        <div class="formsign_row">
            <div class="formsign_gauche">
                <label> Prénom :</label>
                <input type="text" placeholder="---" name="prenom">

                <label >Nom :</label>
                <input type="text" placeholder="---" name="nom">
            </div>
            <div class="formsign_droite">

                <label >Mail :</label>
                <input type="text" placeholder="example@mail.com" name="mail">

                <label>Mot de passe :</label>
                <input type="password" placeholder="Mot de passe :" name="mdp">
            </div>
        </div>
        <button type="submit">S'incrire</button>
       
    </form>

    <dialog id="maBoiteDeDialogue" class="classdialogue">

            <video  preload="auto" autoplay loop muted>
                <source src="img\videor3.mov" type="video/mp4">
            </video>

            <form method="post" onsubmit="ouvrirBoiteDialogue(event)">
                <h3>Inscription</h3>

                <p>Vous allez recevoir un email de confirmation,</p>
                <p>si vous ne le recevez pas, veuillez vérifier votre boite de spam</p>


                <label> Veuillez saisir le code :</label>
                <input type="text" placeholder="------" name="prenom">

                

                <button type="submit">Valider</button>
            
            </form>

            
            
            
    </dialog>

        <script>
            function ouvrirBoiteDialogue(event) {
                event.preventDefault();

                var maBoiteDeDialogue = document.getElementById('maBoiteDeDialogue');
                maBoiteDeDialogue.showModal();

                var boutonFermer = document.getElementById('fermerDialogue');

                boutonFermer.addEventListener('click', function() {
                    maBoiteDeDialogue.close();
                    window.location.reload();
                });

                var boutonModifier = maBoiteDeDialogue.querySelector('button[type="submit"]');
                boutonModifier.addEventListener('click', function() {
                    maBoiteDeDialogue.close();
                });
            }
        </script>
    
    
    
</body>
</html>