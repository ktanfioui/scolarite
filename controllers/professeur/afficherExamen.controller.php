<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/professeur/examen.model.php';
include_once '../../models/extension/xmlReader.php';

$examenmodel = new examenModel($BDD);

$examen = $examenmodel->getExamenById($_GET['id_examen']);
if ($examen == null) 
{
	header("location:../../404error.html");
}
$filesList = getExamenFiles($_GET['id_examen']);
include_once '../../layouts/professeur/head.professeur.php';

$menu_tab = "examen";
$menu_tab_sub = "listeExamen";
include_once '../../layouts/professeur/menu.professeur.php';


include_once '../../views/professeur/afficherExamen.php';

include_once '../../layouts/professeur/footer.professeur.php';
?>