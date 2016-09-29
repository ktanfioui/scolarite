<?php
session_start();
include_once '../../models/core.php';
include_once '../../models/admin/admin.model.php';
include_once '../../models/admin/professeur.model.php';
include_once '../../models/etudiant/login.model.php';

if ($_POST['role'] == "null")
{
	$message = "Vous devez choisir votre espace";
	header('Location:../../index.php?message='.$message.'');
}
else
{
	$email = addslashes($_POST['email']);
	$password = addslashes($_POST['password']);
	switch ($_POST['role']) {
			case 'admin':
				$adminmodel = new adminModel($BDD);
				$message = $adminmodel->establishConnection($email,$password);
				if (strcmp($message, "true") == 0) 
				{
					header('Location:../admin/listeFiliere.controller.php');
				}
				else
				{
					header('Location:../../index.php?message='.$message.'');
				}
				break;
			case 'prof':
				$professeurmodel = new professeurModel($BDD);
				$message = $professeurmodel->establishConnection($email,$password);
				if (strcmp($message, "true") == 0) 
				{
					header('Location:../professeur/listeFiliere.controller.php');
				}
				else
				{
					header('Location:../../index.php?message='.$message.'');
				}
				break;
			case 'etudiant':
				$loginmodel = new loginModel($BDD);
				$message = $loginmodel->establishConnection($email,$password);
				if (strcmp($message, "true") == 0) 
				{
					header('Location:../etudiant/listeExamen.controller.php');
				}
				else
				{
					header('Location:../../index.php?message='.$message.'');
				}
				break;
			default:
				header('Location:../../index.php?message='.$message.'');
				break;
		}	
}


?>