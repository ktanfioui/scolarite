<?php
include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/etudiant/examen.model.php';
include_once '../../models/etudiant/module.model.php';
include_once '../../models/extension/xmlReader.php';

$examenmodel = new examenModel($BDD);
$modulemodel = new moduleModel($BDD);
$examen = $examenmodel->getExamenById($_GET['id_examen']);

if ($examen == null || $examenmodel->testExamenRange($examen) != 1) 
{
	header("location:../../404error.html");
}
$filesList = getExamenFiles($_GET['id_examen']);

$menu_tab = "passerExamen";
include_once '../../layouts/etudiant/head.etudiant.php';

include_once '../../views/etudiant/passerExamen.php';

include_once '../../layouts/etudiant/footer.etudiant.php';
?>
