<?php
include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/admin/examen.model.php';
include_once '../../models/admin/filiere.model.php';
$examenmodel = new examenModel($BDD);
$filieremodel = new filiereModel($BDD);

include_once '../../layouts/admin/head.admin.php';

$menu_tab = "examen";
$menu_tab_sub = "calendarExamen";
include_once '../../layouts/admin/menu.admin.php';

if (isset($_POST["optionFiliere"]) && $_POST["optionFiliere"] != "null") {
	$title = $filieremodel->getFiliereById($_POST["optionFiliere"])->getIntitule();
} else {
	$title = "Tout les filières";
}



include_once '../../views/admin/calendarExamen.php';

include_once '../../layouts/admin/footer.admin.php';
?>