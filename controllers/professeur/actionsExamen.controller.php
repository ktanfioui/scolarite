<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/professeur/examen.model.php';

$examenmodel = new examenModel($BDD);

switch ($_GET['type']) {
	case 'delete':
		$examenmodel->deleteExamenById($_GET['id_examen']);
		header("location:listeExamen.controller.php");
		break;
	case 'lancer':
		$examenmodel->updateExamenField("isCreated",1,$_GET['id_examen']);
		header("location:listeExamen.controller.php");
		break;
	case 'annuler':
		$examenmodel->updateExamenField("isCreated",0,$_GET['id_examen']);
		header("location:listeExamen.controller.php");
		break;
	default:
		break;
}
?>