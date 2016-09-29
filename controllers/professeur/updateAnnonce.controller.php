<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/professeur/annonce.model.php';
$annoncemodel = new annonceModel($BDD);
$annonce = $annoncemodel->getAnnonceById(empty($_GET['id_annonce']) ? $_POST['id_annonce'] : $_GET['id_annonce']);
if(isset($_POST['submit']))
{
    $annonce = new Annonce($_POST['id_annonce'],$_POST['annonce'],"unread");
    $message = $annoncemodel->updateAnnonce($annonce);
}
include_once '../../layouts/professeur/head.professeur.php';

$menu_tab = "annonce";
$menu_tab_sub = "ajoutAnnonce";
include_once '../../layouts/professeur/menu.professeur.php';


include_once '../../views/professeur/updateAnnonce.php';

include_once '../../layouts/professeur/footer.professeur.php';
?>