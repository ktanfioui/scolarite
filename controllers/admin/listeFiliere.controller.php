<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/admin/filiere.model.php';

$filieremodel = new filiereModel($BDD);
$listefiliere = $filieremodel->showAllFiliere();

include_once '../../layouts/admin/head.admin.php';

$menu_tab = "filiere";
$menu_tab_sub = "listeFiliere";
include_once '../../layouts/admin/menu.admin.php';


include_once '../../views/admin/listeFiliere.php';

include_once '../../layouts/admin/footer.admin.php';
?>