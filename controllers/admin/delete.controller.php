<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/admin/module.model.php';
include_once '../../models/admin/filiere.model.php';
include_once '../../models/admin/professeur.model.php';

switch ($_GET['type']) {
	case 'module':
		$modulemodel = new moduleModel($BDD);
		$modulemodel->deleteModuleById($_GET['id']);
		header("location:listeModule.controller.php");
		break;
	case 'filiere':
		$filieremodel = new filiereModel($BDD);
		$filieremodel->deleteFiliereById($_GET['id']);
		header("location:listeFiliere.controller.php");
		break;
	case 'professeur':
		$professeurmodel = new professeurModel($BDD);
		$professeurmodel->deleteProfesseurById($_GET['id']);
		header("location:listeProfesseur.controller.php");
		break;
	case 'linkmodule':
		$modulemodel = new moduleModel($BDD);
		$id_module = intval($_GET['linkmodule'][0]);
		$id_filiere = intval($_GET['linkmodule'][2]);
		$id_professeur = intval($_GET['linkmodule'][4]);
		$modulemodel->deleteLinkModule($id_module,$id_filiere,$id_professeur);
		header("location:listeModule.controller.php");
		break;
	case 'etudiant':
		$filieremodel = new filiereModel($BDD);
		$filieremodel->deleteEtudiantFromFiliere($_GET['id']);
		header("location:afficherFiliere.controller.php?id_filiere=".$_GET['id_filiere']);
		break;
	case 'listEtudiants':
		$filieremodel = new filiereModel($BDD);
		$filieremodel->deleteAllEtudiantsFromFiliere($_GET['id']);
		header("location:afficherFiliere.controller.php?id_filiere=".$_GET['id']);
		break;
	default:
		break;
}
?>