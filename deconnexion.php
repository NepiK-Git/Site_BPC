
<?php

// Initialiser la session
session_start();
$_SESSION = array();
// Détruire la session.
session_destroy();  
echo "<div class=\"bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow\">
               Vous êtes déconnecté </div>";

unset($_SESSION);
     header( "Location:profils.php" );
?>

