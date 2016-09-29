<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/professeur/etudiant.model.php';
include_once '../../models/professeur/examen.model.php';
include_once '../../models/professeur/filiere.model.php';
include_once '../../models/professeur/module.model.php';

$examenmodel = new examenModel($BDD);
$filieremodel = new filiereModel($BDD);
$modulemodel = new moduleModel($BDD);
$etudiantmodel = new etudiantModel($BDD);

$examen = $examenmodel->getExamenById($_GET['id_examen']);
$filiere = $filieremodel->getFiliereById($_GET['id_filiere']);
$module = $modulemodel->getModuleById($examen->getId_module());
if ($examen == null || $filiere == null) 
{
	header("location:../../404error.html");
}


include_once '../../layouts/professeur/head.professeur.php';

$menu_tab = "examen";
$menu_tab_sub = "";
include_once '../../layouts/professeur/menu.professeur.php';


include_once '../../views/professeur/listeReponsesExamen.php';

include_once '../../layouts/professeur/footer.professeur.php';
?>