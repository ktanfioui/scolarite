<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/admin/professeur.model.php';

$professeurmodel = new professeurModel($BDD);

include_once '../../layouts/admin/head.admin.php';

$menu_tab = "message";
$menu_tab_sub = "newMessageProfesseur";
include_once '../../layouts/admin/menu.admin.php';

if(isset($_POST["submit"]))
{
	$message = $professeurmodel->sendMailToProf($_POST["optionProfesseur"],$_POST["sujet"],$_POST["message"]);
}

include_once '../../views/admin/newMessageProfesseur.php';

include_once '../../layouts/admin/footer.admin.php';
?>