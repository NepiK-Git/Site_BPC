<?php
session_start();

//partie haute commune à toutes les pages
require "headPage.php";
require "constants.php";
require "fonctions.php";

//************PARTIE VERIFICATION DE INFORMATIONS SAISIES**************//
$bdd = connectBDD( NAMEBDD, ROOT, HOST, MDPBDD );

//***Si l'utilisateur est connecté , il doit d'abord se deconnecter pour créer un autre compte
if (isset($_SESSION['firstName']))
    echo "<div class=\"bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow\">
              Vous devez d'abord vous déconnecter pour crée un autre compte</div>";

if ( isset( $_POST['submit'] ) ) {
    //recuperation des informations
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
    // crypte le mot de passe

    $requete = $bdd->prepare( 'INSERT INTO users(lastName,firstName,adresse,email,mdp) VALUES(:lastName,:firstName,:adresse,:email,:mdp)' );
 
    $requete->bindValue( ':lastName', $lastName, PDO::PARAM_STR );
    $requete->bindValue( ':firstName', $firstName, PDO::PARAM_STR );
    $requete->bindValue( ':adresse',$adresse, PDO::PARAM_STR );
    $requete->bindValue( ':email', $email, PDO::PARAM_STR );
    $requete->bindValue( ':mdp', $mdp, PDO::PARAM_STR );
    $requete->execute();

    $_SESSION['id_u'] = $bdd->lastInsertId();
   
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['email']= $email;
    $_SESSION['adresse']= $adresse;
    
     header( "Location:profils.php" );

}

?>
<div class="container">
    <div class="row">
        <div class="col-12">

            <form class="mt-5" action="#" method="post">
               
                <div class="form-group row">
                    <label for="inputLastName" class="col-sm-2 col-form-label">Nom</label>
                    <div class="col-sm-10">
                        <input type="text" name="lastName" class="form-control" id="inputLastName" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputfirstName" class="col-sm-2 col-form-label">Prenom</label>
                    <div class="col-sm-10">
                        <input type="text" name="firstName" class="form-control" id="inputfirstName" required>
                    </div>
                </div>
               
                <div class="form-group row">
                    <label for="inputadresse" class="col-sm-2 col-form-label">Adresse</label>
                    <div class="col-sm-10">
                        <input type="text" name="adresse" class="form-control" id="adresse" required>
                    </div>
                </div>
                 <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control" id="inputEmail3" required pattern="^[a-z0-9.-_]+@[a-z0-9.-_]+\.[a-z]{2,6}$">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Mot de passe</label>
                    <div class="col-sm-10">
                        <input type="password" name="mdp" class="form-control" id="inputPassword3" required pattern="[A-Aa-z0-9]+">
                    </div>
                </div>

                
                <div class="col-sm-10 text-center">
                    <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block">Inscription</button>
                    <br>
                    <a class="btn btn-sm btn-outline-secondary" href="profils.php">Retour</a>
                </div>
            </form>
        </div>
    </div>
</div>