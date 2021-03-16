<?php
session_start();

//partie haute commune à toutes les pages
require "headPage.php";
require "constants.php";
require "fonctions.php";

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

</head>

<body>
    <center>

        <?php
        //************PARTIE VERIFICATION DE INFORMATIONS SAISIES**************//
        
            $bdd = connectBDD( NAMEBDD, ROOT, HOST, MDPBDD );

        
        if ( isset( $_POST['submit'] ) ) {
            
            //recuperation des informations
              $probleme = $_POST['Probleme'];
              $machine = $_POST['Machine']; 
              $machineDescription = $_POST['machineDescription']; 
              $problemeDescription = $_POST['problemeDescription']; 

              $requete = $bdd->prepare( 'INSERT INTO inputDevis (Probleme,Machine,machineDescription,problemeDescription) VALUES(:Probleme,:Machine,:machineDescription,:problemeDescription)' );
             
              $requete->bindValue( ':Probleme', $probleme, PDO::PARAM_STR );
              $requete->bindValue( ':Machine', $machine, PDO::PARAM_STR );   
              $requete->bindValue( ':machineDescription', $machineDescription, PDO::PARAM_STR );   
              $requete->bindValue( ':problemeDescription', $problemeDescription, PDO::PARAM_STR );   
              
              $requete->execute();
            
              $_SESSION['id_devis'] = $bdd->lastInsertId();
   
              $_SESSION['Probleme'] = $probleme;
              $_SESSION['Machine'] = $machine;
              $_SESSION['machineDescription'] = $machineDescription;
              $_SESSION['problemeDescription'] = $problemeDescription;
            
            //  header( "Location:devisfait.php" );
            
            
            //------------- recup client compte -------------//
            
            if(isset($_SESSION['firstName'])){
                
                $req = $bdd->prepare('SELECT id_u,lastName,firstName ,mdp FROM users');
    $req->execute();
    $resultat = $req->fetch();
                
            
            }else{
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

            }
            
            
            //------------- envoie mail -------------//
           

            $client = 'Prenom : ' . $_SESSION['firstName'] . '
             Nom : ' . $_SESSION['lastName'] . '
             Email : ' .$_SESSION['email'] . '';
            
            $probleme ='Son probleme est : ' .$_SESSION['Probleme'] . '
             Description : ' .$_SESSION['problemeDescription'] .'
             Sa Machine est un(e)  : ' .$_SESSION['Machine'] . ', details : ' .$_SESSION['machineDescription'] .'';
            
             
             $message = 'Message pour un devis,
             '.$client.'
             '.$probleme.'';
             $retourMail = mail('labastugue8@gmail.com','devis' ,$message);
            
            $mail = $message;
            $numUsers = $_SESSION['id_u'];
            $numDevis = $_SESSION['id_devis'];
           
            $requete = $bdd->prepare( 'INSERT INTO inputMail (id_u, id_devis, mail) VALUES( :id_u, :id_devis, :mail)');
             
              $requete->bindValue( ':id_u', $numUsers, PDO::PARAM_STR );
              $requete->bindValue( ':id_devis', $numDevis, PDO::PARAM_STR );
              $requete->bindValue( ':mail', $mail, PDO::PARAM_STR );
             
            
              $requete->execute();
            
            $_SESSION['id_mail'] = $bdd->lastInsertId();
            $_SESSION['id_u'] = $numUsers;
            $_SESSION['id_devis'] = $numDevis;
            $_SESSION['mail'] = $mail;
              
               
            
            if($retourMail)
                echo '<p>Votre message a été envoyé.</p>';
            else
                echo '<p>Erreur.</p>';
            
            
        }
   
        echo'</br>';
        ?>

        <h1> Faire un Devis </h1>
        <h5>(Si vous avez plusieurs appareils defectueux, merci de remplir un devis par appareil)</h5>
        <form method="post">

            <?php
        echo'</br>';
        
        if(isset($_SESSION['firstName']))
{
    echo "<div class=\"bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow\">
        Nom et prenom : ".$_SESSION['lastName']." ".$_SESSION['firstName']."<br>".
        "</div>";

}
else
{    
    echo '<div class=\"bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow\">
               Vous devez vous connecter ou bien inscrire votre Nom, Prenom et Adresse @</div>
               ';
    
    echo'</br>';
        
    


 ?>

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
                    <input type="text" name="adresse" class="form-control" id="inputadresse" required>
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
            <?php
                    }
            ?>



            <h4 class="mb-3">Type de probleme ?</h4>










            <div class="d-block my-3">



                <div class="custom-control custom-radio">
                    <input id="inputEcran" name="Probleme" type="radio" class="custom-control-input" value="Ecran casser" required>
                    <label class="custom-control-label" for="inputEcran">Ecran cassé </label>
                </div>

                <div class="custom-control custom-radio">
                    <input id="inputAllumage" name="Probleme" type="radio" class="custom-control-input" value="Ne s'allume pas" required>
                    <label for="inputAllumage" class="custom-control-label">Ne s'alume plus </label>

                    <div class="custom-control custom-radio">
                        <input id="inputBatterie" name="Probleme" type="radio" value="Probleme de Batterie" class="custom-control-input">
                        <label for="inputBatterie" class="custom-control-label">Probleme de batterie </label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input id="inputData" name="Probleme" type="radio" value="Recuperation de Donnée" class="custom-control-input">
                        <label for="inputData" class="custom-control-label">Récuperation de donnée </label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input id="inputComposant" name="Probleme" type="radio" class="custom-control-input" value="Instalation d'un composant">
                        <label class="custom-control-label" for="inputComposant">Instaler un nouveau composant </label>
                    </div>

                    <?php
        echo'</br>';
        ?>

                    <div class="custom-control custom-radio">
                        <label for="inputproblemeDescription" class="custom-control">Description du probleme (en details) : </label>
                        <input id="inputproblemeDescription" name="problemeDescription" type="text" class="custom-control" required>
                    </div>

                    <?php
                echo'</br>';
                echo'</br>';
                ?>

                </div>


                <h4 class="mb-3">Type de composant :</h4>

                <div class="d-block my-3">

                    <div class="custom-control custom-radio">
                        <input id="inputOrdinateurFixe" name="Machine" type="radio" class="custom-control-input" value="Ordinateur Fixe" required>
                        <label for="inputOrdinateurFixe" class="custom-control-label">Ordinateur Fixe </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="inputOrdinateurPortable" name="Machine" type="radio" class="custom-control-input" value="Ordinateur Portable" required>
                        <label for="inputOrdinateurPortable" class="custom-control-label">Ordinateur Portable </label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input id="inputTelephone" name="Machine" type="radio" class="custom-control-input" value="Telephone" required>
                        <label for="inputTelephone" class="custom-control-label">Telephone </label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input id="inputTablette" name="Machine" type="radio" class="custom-control-input" value="Tablette" required>
                        <label for="inputTablette" class="custom-control-label">Tablette </label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input id="inputServeur" name="Machine" type="radio" class="custom-control-input" value="Serveur" required>
                        <label for="inputServeur" class="custom-control-label">Serveur </label>
                    </div>


                    <?php
                
                echo'</br>';
                ?>

                    <div class="custom-control custom-radio">
                        <label for="inputMachineDescritpion" class="custom-control">Description de la machine (marque, modele, etc) : </label>
                        <input id="inputMachineDescritpion" name="machineDescription" type="text" class="custom-control" required>
                    </div>


                    <?php
                echo'</br>';
                echo'</br>';
                ?>

                </div>




                <button type="submit" name="submit" class="btn btn-success btn-lg">Valider</button>



            </div>



        </form>




    </center>
</body>

</html>