<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/professeur/examen.model.php';

$examenmodel = new examenModel($BDD);

$examen = $examenmodel->getExamenById($_GET['id_examen']);
if ($examen == null) 
{
	header("location:../../404error.html");
}

$states = $examenmodel->getCreationStates($_GET['id_examen']);

if ($states == null) {
	$examenmodel->createCreationStates($_GET['id_examen']);
	$states = $examenmodel->getCreationStates($_GET['id_examen']);
}

if ($examen->getIsQCM() == 1 && $states['qcm'] == 0) {
	header("location:creationQCM.controller.php?id_examen=".$examen->getId());
} elseif ($examen->getIsCoure() == 1 && $states['cours'] == 0) {
	header("location:creationQCours.controller.php?id_examen=".$examen->getId());
} elseif ($examen->getIsExercice() == 1 && $states['exercices'] == 0) {
	header("location:creationExercices.controller.php?id_examen=".$examen->getId());
} else {
	header("location:listeExamen.controller.php");
}

?>