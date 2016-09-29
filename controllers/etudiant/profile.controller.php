<?php
include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/etudiant/login.model.php';

$loginmodel = new loginModel($BDD);

$menu_tab = "profile";

$etudiant = $loginmodel->getEtudiantById($_SESSION['etudiant']['id']);

if (isset($_POST['submit'])) 
{
	$message = $loginmodel->updatePassword($_SESSION['etudiant']['id'],$_POST);
}

include_once '../../layouts/etudiant/head.etudiant.php';

include_once '../../views/etudiant/profile.php';

include_once '../../layouts/etudiant/footer.etudiant.php';
?>