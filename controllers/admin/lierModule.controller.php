<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/admin/module.model.php';
include_once '../../models/admin/filiere.model.php';
include_once '../../models/admin/professeur.model.php';
$modulemodel = new moduleModel($BDD);
$filieremodel = new filiereModel($BDD);
$professeurmodel = new professeurModel($BDD);
if($modulemodel->getModuleById(empty($_GET["id_module"]) ? $_POST["id_module"] : $_GET["id_module"]) == null)
{
	header("location:../../404error.html");
}
if(isset($_POST['submit']))
{
	$message = $modulemodel->linkModule($_POST["id_module"],$_POST["optionFiliere"],$_POST["optionProfesseur"],$_POST["optionSemestre"]);
}
include_once '../../layouts/admin/head.admin.php';

$menu_tab = "module";
$menu_tab_sub = "creationModule";
include_once '../../layouts/admin/menu.admin.php';


include_once '../../views/admin/lierModule.php';

include_once '../../layouts/admin/footer.admin.php';
?>