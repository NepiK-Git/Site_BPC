<?php
session_start();
//partie haute commune à toutes les pages
require "headPage.php";
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
        echo'</br>';
        ?>
        <h1> Depuis 1992, qualité oblige !</h1>
        <?php
        echo'</br>';
        echo'</br>';
        ?>


        <div class="container">

            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="2" class="active"></li>
                </ol>
                <div class="carousel-inner">

                    <div class="carousel-item active">
                        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                            <img src="images/reparationCarroussel.png" width="100%" height="100%" fill="#777">
                        </svg>
                        <div class="container">
                            <div class="carousel-caption text-left">
                                <h1><mark>Réparation</mark></h1>
                                <p><mark>Venez nous voir !</mark></p>
                                <p><a class="btn btn-md btn-dark" href="devis.php" role="button">Faites un devis</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                            <img src="images/depanageCaroussel.png" width="100%" height="100%" fill="#777">
                        </svg>
                        <div class="container">
                            <div class="carousel-caption">
                                <h1><mark>Dépanage et Assistance</mark></h1>
                                <p><mark>Aide et conseil</mark></p>
                                <p><a class="btn btn-md btn-dark" href="aide.php" role="button">Nous contacter</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                            <img src="images/recuperationCaroussel.png" width="100%" height="100%" fill="#777">
                        </svg>
                        <div class="container">
                            <div class="carousel-caption text-right">
                                <h1><mark>Récuperation</mark></h1>
                                <p><mark>Nous pouvons recuperer vos données</mark></p>
                                <p><a class="btn btn-md btn-dark" href="devis.php" role="button">Faire le devis</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                            <img src="images/instalationcaroussel.png" width="100%" height="100%" fill="#777">
                        </svg>
                        <div class="container">
                            <div class="carousel-caption">
                                <h1><mark>Instalation</mark></h1>
                                <p><mark> Vous avez besoin d'instaler un nouveau composants ou un nouveau serveur, nous somme la !</mark></p>
                                <p><a class="btn btn-md btn-dark" href="aide.php" role="button">Nous contacter</a></p>
                            </div>
                        </div>
                    </div>



                </div>
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <?php
            echo'</br>';
            ?>

            <div class="row">
                <div class="col-3">


                    <p><a class="btn btn-lg btn-dark" href="devis.php" role="button">Réparation</a></p>
                    <div>
                        <?php
                        echo'</br>';
                        ?>
                        Nous pouvons reparer ou changer les pieces endomagées de facon efficace et rapide.
                        <?php
                        echo'</br>';
                        echo'</br>';
                        ?>
                        Le meilleur reparteur du 17eme arrondissement de Paris.
                        Repartion de tous types de composants electroniques !
                        <?php
                        echo'</br>';
                        ?>
                        Rien n'est perdu !
                    </div>


                </div>
                <div class="col-3">


                    <p><a class="btn btn-lg btn-dark" href="aide.php" role="button">Dépanage et Assistance</a></p>
                    <div>
                        <?php
                        echo'</br>';
                        ?>
                        Besoin d'un conseil ? Besoin de renseignement ?
                        <?php
                        echo'</br>';
                        echo'</br>';
                        ?>
                        Nous avons la solution, BPC Computer est la pour y repondre !
                        <?php
                        echo'</br>';
                        ?>
                        Venez nous voir ou contacter nous.
                    </div>


                </div>
                <div class="col-3">
                    <p><a class="btn btn-lg btn-dark" href="aide.php" role="button">Instalation</a></p>

                    <div>
                        <?php
                        echo'</br>';
                        ?>
                        Nous pouvons installer serveur et composants.
                        <?php
                        echo'</br>';
                        echo'</br>';
                        ?>
                        Tous types de composants, tels des cartes Graphique, Procsesseurs, Carte mere, etc...
                        <?php
                        echo'</br>';
                        ?>
                        Et vous pouvez aussi acheter ces composants chez BPC Computer.
                    </div>


                </div>
                <div class="col-3">
                    <p><a class="btn btn-lg btn-dark" href="devis.php" role="button">Récuperation</a></p>
                    <div>
                        <?php
                        echo'</br>';
                        ?>
                        Disque dur endommagé, cd rayé, telephone bloqué
                        <?php
                            echo'</br>';
                            echo'</br>';
                            ?>
                        Ne vous inqueter pas, nous vous permeterons de recuperer toutes les données.
                    </div>


                </div>
            </div>
        </div>




    </center>
</body>

</html>