<?php
function connectBDD($nameBdd, $root, $host, $mdpBdd){
    try{//connection bdd
        $bdd = new PDO("mysql:host=".$host.";dbname=".$nameBdd."","".$root."","".$mdpBdd."");
    }catch(Exception $e){//erreur de connection
        die("erreur connection bdd");
    }

    return $bdd;
}

function deconexion (){
    
$_SESSION = array();

session_destroy();  
echo "<div class=\"bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow\">
               Vous êtes déconnecté </div>";

unset($_SESSION);
   
}
?>