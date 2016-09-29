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
$filesList = getExamenReponseFiles($_GET['id_examen'],$_SESSION["etudiant"]["id"]);

$menu_tab = "";

include_once '../../layouts/etudiant/head.etudiant.php';

include_once '../../views/etudiant/afficherReponseExamen.php';

include_once '../../layouts/etudiant/footer.etudiant.php';
?>