<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/professeur/module.model.php';

$modulemodel = new moduleModel($BDD);
$listemodule = $modulemodel->showAllModuleByIdProfesseur($_SESSION['professeur']["id"]);

include_once '../../layouts/professeur/head.professeur.php';

$menu_tab = "module";
$menu_tab_sub = "listeModule";
include_once '../../layouts/professeur/menu.professeur.php';


include_once '../../views/professeur/listeModule.php';

include_once '../../layouts/professeur/footer.professeur.php';
?>