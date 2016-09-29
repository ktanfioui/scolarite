<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/admin/module.model.php';

$modulemodel = new moduleModel($BDD);
$listemodule = $modulemodel->showAllModule();

include_once '../../layouts/admin/head.admin.php';

$menu_tab = "module";
$menu_tab_sub = "listeModule";
include_once '../../layouts/admin/menu.admin.php';


include_once '../../views/admin/listeModule.php';

include_once '../../layouts/admin/footer.admin.php';
?>