<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/professeur/filiere.model.php';

$filieremodel = new filiereModel($BDD);

include_once '../../layouts/professeur/head.professeur.php';

$menu_tab = "message";
$menu_tab_sub = "newMessage";
include_once '../../layouts/professeur/menu.professeur.php';

if(isset($_POST["submit"]))
{
	$message = $filieremodel->sendMailToEtudiantsOfFiliere($_POST["optionFiliere"],$_POST["sujet"],$_POST["message"],$_SESSION["professeur"]["email"]);
}
include_once '../../views/professeur/newMessage.php';

include_once '../../layouts/professeur/footer.professeur.php';
?>