<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/admin/filiere.model.php';
$filieremodel = new filiereModel($BDD);
$filiere = $filieremodel->getFiliereById(empty($_GET['id_filiere']) ? $_POST['id_filiere'] : $_GET['id_filiere']);
if(isset($_POST['submit']))
{
    $filiere = new filiere($_POST['id_filiere'],$_POST['intitule'],$_POST['niveau'],$_POST["nbrModule"],$_POST["description"]);
    $message = $filieremodel->updateFiliere($filiere);
}
include_once '../../layouts/admin/head.admin.php';

$menu_tab = "filiere";
$menu_tab_sub = "creationFiliere";
include_once '../../layouts/admin/menu.admin.php';


include_once '../../views/admin/updateFiliere.php';

include_once '../../layouts/admin/footer.admin.php';
?>