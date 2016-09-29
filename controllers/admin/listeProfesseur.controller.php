<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/admin/professeur.model.php';

$professeurmodel = new professeurModel($BDD);
$listeprofesseur = $professeurmodel->showAllProfesseur();

include_once '../../layouts/admin/head.admin.php';

$menu_tab = "professeur";
$menu_tab_sub = "listeProfesseur";
include_once '../../layouts/admin/menu.admin.php';


include_once '../../views/admin/listeProfesseur.php';

include_once '../../layouts/admin/footer.admin.php';
?>