<?php
include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/professeur/etudiant.model.php';
include_once '../../models/extension/excelCreator.php';

$etudiantmodel = new etudiantModel($BDD);
$listeEtudiant = $etudiantmodel->getEtudiantsByIdFiliere($_GET["id_filiere"]);

$excelcreator = new excelCreator($_GET["id_examen"],$_GET["id_filiere"],$listeEtudiant);
$excelcreator->createFile();
header("location:listeReponsesExamen.controller.php?id_examen=".$_GET["id_examen"]."&id_filiere=".$_GET["id_filiere"]);

?>
