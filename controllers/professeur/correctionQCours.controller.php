<?php
include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/professeur/examen.model.php';
include_once '../../models/extension/xmlReader.php';

include_once '../../layouts/professeur/head.professeur.php';


$files = getExamenFiles($_GET["id_examen"]);
$file = $files["cours"];
$menu_tab = "examen";
$menu_tab_sub = "creationExamen";

include_once '../../layouts/professeur/menu.professeur.php';

include_once '../../views/professeur/correctionQCours.php';

include_once '../../layouts/professeur/footerCorrection.professeur.php';
?>