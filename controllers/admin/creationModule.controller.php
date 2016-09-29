<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/admin/module.model.php';
if(isset($_POST['submit']))
{
    $module = new Module(0,$_POST['intitule'],$_POST['description']);
    $modulemodel = new moduleModel($BDD);
    $message = $modulemodel->addNewModule($module);
}
include_once '../../layouts/admin/head.admin.php';

$menu_tab = "module";
$menu_tab_sub = "creationModule";
include_once '../../layouts/admin/menu.admin.php';


include_once '../../views/admin/creationModule.php';

include_once '../../layouts/admin/footer.admin.php';
?>