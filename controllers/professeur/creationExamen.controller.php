<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/professeur/module.model.php';
include_once '../../models/professeur/filiere.model.php';
include_once '../../models/professeur/examen.model.php';

$modulemodel = new moduleModel($BDD);
$filieremodel = new filiereModel($BDD);
$examenmodel = new examenModel($BDD);

include_once '../../layouts/professeur/head.professeur.php';

$menu_tab = "examen";
$menu_tab_sub = "creationExamen";
include_once '../../layouts/professeur/menu.professeur.php';

if (isset($_POST['submit']) && $_POST['phase'] == "1") 
{
	if ($_POST['optionFiliere'] == "null") 
	{
		$message = "Vous devez choisir une Filière";
		include_once '../../views/professeur/creationExamen.phase_1.php';
	}
	else
	{
		include_once '../../views/professeur/creationExamen.phase_2.php';
	}
}
elseif (isset($_POST['submit']) && $_POST['phase'] == "2") 
{
	$message = $examenmodel->addNewExamen($_POST,$_SESSION['professeur']["id"]);
	include_once '../../views/professeur/creationExamen.phase_2.php';
}
else
{
	include_once '../../views/professeur/creationExamen.phase_1.php';
}

include_once '../../layouts/professeur/footer.professeur.php';
?>