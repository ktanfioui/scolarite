<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/professeur/examen.model.php';
include_once '../../models/professeur/save.php';
$examenmodel = new examenModel($BDD);
if ($_POST['nbrQuestion'] == "0") 
{
	header("location:creationQCM.controller.php?id_examen=".$_POST['id_examen']);
}
else
{
	saveQCM($_POST['id_examen'],$_POST);
	$examenmodel->updateCreationState("qcm",$_POST['id_examen']);
	header("location:creationExamenPartie.controller.php?id_examen=".$_POST['id_examen']);
}

?>