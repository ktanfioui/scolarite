<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/professeur/etudiant.model.php';
include_once '../../models/professeur/examen.model.php';
include_once '../../models/professeur/filiere.model.php';
include_once '../../models/professeur/module.model.php';
include_once '../../models/extension/xmlReader.php';

$examenmodel = new examenModel($BDD);
$filieremodel = new filiereModel($BDD);
$modulemodel = new moduleModel($BDD);
$etudiantmodel = new etudiantModel($BDD);

$examen = $examenmodel->getExamenById($_GET['id_examen']);
$etudiant = $etudiantmodel->getEtudiantById($_GET['id_etudiant']);
$module = $modulemodel->getModuleById($examen->getId_module());
$filiere = $filieremodel->getFiliereById($examen->getId_filiere());

if ($examen == null || $etudiant == null) 
{
	header("location:../../404error.html");
}
$filesList = getExamenReponseFiles($_GET['id_examen'],$_GET['id_etudiant']);

include_once '../../layouts/professeur/head.professeur.php';

$menu_tab = "examen";
$menu_tab_sub = "";
include_once '../../layouts/professeur/menu.professeur.php';


include_once '../../views/professeur/afficherReponseExamen.php';

include_once '../../layouts/professeur/footer.professeur.php';
?>