<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/professeur/examen.model.php';
include_once '../../models/professeur/save.php';

$examenmodel = new examenModel($BDD);

saveQCMCorrection($_POST['id_examen'],$_POST);
$examenmodel->updateCorrectionState("qcm",$_POST['id_examen']);
header("location:correctionExamenPartie.controller.php?id_examen=".$_POST['id_examen']);

?>