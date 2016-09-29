<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/professeur/examen.model.php';
include_once '../../models/professeur/save.php';
$examenmodel = new examenModel($BDD);
if ($_POST['nbrQuestion'] == "0")
{
	header("location:creationExercices.controller.php?id_examen=".$_POST['id_examen']);
}
else
{
	saveExercices($_POST['id_examen'],$_POST);
	$examenmodel->updateCreationState("exercices",$_POST['id_examen']);
	header("location:creationExamenPartie.controller.php?id_examen=".$_POST['id_examen']);
}
?>