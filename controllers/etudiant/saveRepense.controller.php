<?php
include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/etudiant/examen.model.php';
include_once '../../models/etudiant/save.php';

$examenmodel = new examenModel($BDD);

saveQCMCorrection($_POST['id_examen'],$_SESSION['etudiant']['id'],$_POST);
saveCoursCorrection($_POST['id_examen'],$_SESSION['etudiant']['id'],$_POST);
saveExercicesCorrection($_POST['id_examen'],$_SESSION['etudiant']['id'],$_POST);
header('location:listeExamen.controller.php');
?>