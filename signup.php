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
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #edd75c,
        #f09819
    );
    
    left: -100px;
    top: -20px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #edd75c,
        #f09819
    );
    
    right: -110px;
    bottom: -350px;
}
form{
    height: auto;
    width: 450px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 73%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
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
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
button{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
button:hover{
    opacity: 0.5;

}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}

    </style>
</head>
<body>
    <div class="page">
        <header tabindex="0"><a href="index.php">RideAway</a></header>
            <div id="nav-container">
                <div class="bg"></div>
                <div class="button" tabindex="0">
                    <span class="icon-bar jaune"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar jaune"></span>
                </div>
                <div id="nav-content" tabindex="0">
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="ajouter.php">Poster</a></li>
                        <li><a href="#0">BlaBla</a></li>
                        <li><a href="#0">Entretiens</a></li>
                        <li><a href="#0">Nous contacter</a></li>
                    </ul>
                </div>
            </div>

            <div class="login-buttons">
                <a href="login.php" class="login-button">Connexion</a>
                

            </div>
    </div>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="post">
        <h3>Inscription</h3>
        <label> Prénom :</label>
        <input type="text" placeholder="---" name="prenom">

        <label >Nom :</label>
        <input type="text" placeholder="---" name="nom">

        <label >Mail :</label>
        <input type="text" placeholder="example@mail.com" name="mail">

        <label>Mot de passe :</label>
        <input type="password" placeholder="Mot de passe :" name="mdp">

        <button type="submit">S'incrire</button>
       
    </form>
    
    
    
</body>
</html>