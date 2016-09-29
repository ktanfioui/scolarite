<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/admin/filiere.model.php';
include_once '../../models/extension/excelFileUpload.php';
include_once '../../models/extension/excelReader.php';

$filieremodel = new filiereModel($BDD);
$filiereInfo = $filieremodel->showFiliereInfo(empty($_GET["id_filiere"]) ? $_POST["id_filiere"] : $_GET["id_filiere"]);
if ($filiereInfo == null) 
{
	header("location:../../404error.html");
}
if(isset($_POST['submit']))
{
	$excelFileUpload = new ExcelFileUpload($_FILES["excelFile"]);
	$message = $excelFileUpload->uploadFile($_POST["id_filiere"]);
	if (strcmp($message, "true") == 0)
	{
		$excelreader = new ExcelReader($excelFileUpload->getPath());
		$etudiantListe = $excelreader->getFileContent();
		$filieremodel->addEtudiantToFiliere($etudiantListe,$_POST["id_filiere"]);
		$message = "Transfert réussi";
	}
}

include_once '../../layouts/admin/head.admin.php';

$menu_tab = "filiere";
$menu_tab_sub = "listeFiliere";
include_once '../../layouts/admin/menu.admin.php';


include_once '../../views/admin/afficherFiliere.php';

include_once '../../layouts/admin/footer.admin.php';
?>