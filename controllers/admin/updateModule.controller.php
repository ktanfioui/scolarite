<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/admin/module.model.php';
$modulemodel = new moduleModel($BDD);
$module = $modulemodel->getModuleById(empty($_GET['id_module']) ? $_POST['id_module'] : $_GET['id_module']);
if(isset($_POST['submit']))
{
    $module = new Module($_POST['id_module'],$_POST['intitule'],$_POST['description']);
    $message = $modulemodel->updateModule($module);
}
include_once '../../layouts/admin/head.admin.php';

$menu_tab = "module";
$menu_tab_sub = "creationModule";
include_once '../../layouts/admin/menu.admin.php';


include_once '../../views/admin/updateModule.php';

include_once '../../layouts/admin/footer.admin.php';
?>