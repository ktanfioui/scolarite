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

$correction = $examenmodel->getCorrectionStates($_GET['id_examen']);

if ($correction == null) {
	$examenmodel->createCorrectionStates($_GET['id_examen']);
	$correction = $examenmodel->getCorrectionStates($_GET['id_examen']);
}

if ($examen->getIsQCM() == 1 && $correction['qcm'] == 0) {
	header("location:correctionQCM.controller.php?id_examen=".$examen->getId());
} elseif ($examen->getIsCoure() == 1 && $correction['cours'] == 0) {
	header("location:correctionQCours.controller.php?id_examen=".$examen->getId());
} elseif ($examen->getIsExercice() == 1 && $correction['exercices'] == 0) {
	header("location:correctionExercices.controller.php?id_examen=".$examen->getId());
} else {
	header("location:afficherCorrectionExamen.controller.php?id_examen=".$examen->getId());
}

?>