<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/professeur/annonce.model.php';
if(isset($_POST['submit']))
{
    $annonce = new Annonce(0,$_POST['annonce'],"unread");
    $annoncemodel = new annonceModel($BDD);
    $message = $annoncemodel->addNewAnnonce($annonce);
}
include_once '../../layouts/professeur/head.professeur.php';

$menu_tab = "annonce";
$menu_tab_sub = "ajoutAnnonce";
include_once '../../layouts/professeur/menu.professeur.php';


include_once '../../views/professeur/creationAnnonce.php';

include_once '../../layouts/professeur/footer.professeur.php';
?>