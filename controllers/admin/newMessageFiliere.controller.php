<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/admin/filiere.model.php';

$filieremodel = new filiereModel($BDD);

include_once '../../layouts/admin/head.admin.php';

$menu_tab = "message";
$menu_tab_sub = "newMessageFiliere";
include_once '../../layouts/admin/menu.admin.php';

if(isset($_POST["submit"]))
{
	$message = $filieremodel->sendMailToEtudiantsOfFiliere($_POST["optionFiliere"],$_POST["sujet"],$_POST["message"]);
}

include_once '../../views/admin/newMessageFiliere.php';

include_once '../../layouts/admin/footer.admin.php';
?>