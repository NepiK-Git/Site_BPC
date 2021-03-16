<?php
session_start();
require "fonctions.php" ;
require "constants.php" ;

//partie haute commune à toutes les pages
require "headPage.php";

if(isset($_SESSION['firstName']))
{
    echo "<div class=\"bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow\">
           <div class=\"text-center mb-4\">
            <br>
            <h1 class=\"h3 mb-3 font-weight-normal\">Profil</h1>
            <br>
            
            </div>
        Nom et prenom : ".$_SESSION['lastName']." ".$_SESSION['firstName']."<br>".
        //Affiche l'adresse mail
        "Votre adresse email : ".$_SESSION['email']."<br>".
        //Affiche le lien pour modifier le mot de passe
        "<a class=\"py-2 d-none d-md-inline-block\" href=modify_password.php>Modifier mon mot de passe</a>"."</div>";

}
else
{    
    echo "<div class=\"bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow\">
               Vous devez vous connecter ou bien vous inscrire pour accéder à votre compte !</div>";

}


    if(isset($_POST['submit'])){

    $bdd = connectBDD( NAMEBDD, ROOT, HOST, MDPBDD );

    $email= $_POST['email'];

    $req = $bdd->prepare('SELECT id_u,lastName,telephone,firstName ,mdp FROM users WHERE email = :email');
    $req->execute(array(
        'email' => $email));
    $resultat = $req->fetch();

    // Comparaison du pass envoyé via le formulaire avec la base
    $isPasswordCorrect = password_verify($_POST['password'], $resultat['mdp']);

    if (!$resultat)
    {
        echo "<div class=\"bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow\">
               Mauvais email ou mot de passe !</div>"; 

    }
    else
    {
        if ($isPasswordCorrect) {
            
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['lastName'] = $resultat['lastName'];
            $_SESSION['firstName'] = $resultat['firstName'];
         

            echo "<div class=\"bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow\">".
                $_SESSION['lastName']." ".$_SESSION['firstName']."</div>"; 
            header( "Location:profils.php" );

        }
        else {
            echo "<div class=\"bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow\">
               Mauvais mot de passe !</div>"; 
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

</head>

<body>
    <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow">

        <form class="form-signin" method="post" action="profils.php">
            <div class="text-center mb-4">

                <br>
                <h1 class="h3 mb-3 font-weight-normal">Connexion :</h1>
            </div>

            <div class="form-label-group">
                <label for="inputEmail3">Email </label>
                <input type="email" id="inputEmail3" class="form-control" placeholder="Adresse e-mail" name="email" required autofocus>

            </div>
            <br>
            <div class="form-label-group">
                <label for="inputPassword3">Mot de passe</label>
                <input type="password" id="inputPassword3" class="form-control" placeholder="Mot de passe" name="password" required>

            </div>
            <br>

            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Connexion</button>
        </form>
        <br>
        <a class="btn btn-sm btn-outline-secondary" href="index.php">Retour</a>
    </div>

    <div class="btn btn-sm btn-outline-secondary">
        <a class="py-2 d-none d-md-inline-block" href="inscription.php">Inscription </a>
        <a class="py-2 d-none d-md-inline-block" href="deconnexion.php">Deconnexion </a>
    </div>

</body>

</html>