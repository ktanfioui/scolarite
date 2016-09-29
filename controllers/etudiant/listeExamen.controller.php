<?php
include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/etudiant/examen.model.php';

$examenmodel = new examenModel($BDD);

$menu_tab = "examen";
include_once '../../layouts/etudiant/head.etudiant.php';


if (isset($_GET['type']))
{
	$listeExamen = $examenmodel->getExamenByIdFiliere($_SESSION['etudiant']['id_filiere']);
	include_once '../../views/etudiant/listExamen.liste.php';
}
else
{
	include_once '../../views/etudiant/listExamen.calendar.php';
}

include_once '../../layouts/etudiant/footer.etudiant.php';
?>