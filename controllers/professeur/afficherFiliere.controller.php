<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/professeur/filiere.model.php';
include_once '../../models/extension/excelFileUpload.php';
include_once '../../models/extension/excelReader.php';

$filieremodel = new filiereModel($BDD);
$filiereInfo = $filieremodel->showFiliereInfo(empty($_GET["id_filiere"]) ? $_POST["id_filiere"] : $_GET["id_filiere"]);
if ($filiereInfo == null) 
{
	header("location:../../404error.html");
}

include_once '../../layouts/professeur/head.professeur.php';

$menu_tab = "filiere";
$menu_tab_sub = "listeFiliere";
include_once '../../layouts/professeur/menu.professeur.php';


include_once '../../views/professeur/afficherFiliere.php';

include_once '../../layouts/professeur/footer.professeur.php';
?>