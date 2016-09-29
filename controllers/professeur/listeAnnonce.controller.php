<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/professeur/annonce.model.php';

$annoncemodel = new annonceModel($BDD);
$listeannonce = $annoncemodel->showAllAnnonce();

include_once '../../layouts/professeur/head.professeur.php';

$menu_tab = "annonce";
$menu_tab_sub = "listeAnnonce";
include_once '../../layouts/professeur/menu.professeur.php';


include_once '../../views/professeur/listeAnnonce.php';

include_once '../../layouts/professeur/footer.professeur.php';
?>