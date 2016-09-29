<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/professeur/filiere.model.php';

$filieremodel = new filiereModel($BDD);
$listefiliere = $filieremodel->showAllFiliereByIdProfesseur($_SESSION['professeur']["id"]);

include_once '../../layouts/professeur/head.professeur.php';

$menu_tab = "filiere";
$menu_tab_sub = "listeFiliere";
include_once '../../layouts/professeur/menu.professeur.php';


include_once '../../views/professeur/listeFiliere.php';

include_once '../../layouts/professeur/footer.professeur.php';
?>