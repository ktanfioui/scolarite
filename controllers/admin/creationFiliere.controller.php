<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/admin/filiere.model.php';
if(isset($_POST['submit']))
{
    $filiere = new filiere(0,$_POST['intitule'],$_POST['niveau'],$_POST["nbrModule"],$_POST["description"]);
    $filieremodel = new filiereModel($BDD);
    $message = $filieremodel->addNewFiliere($filiere);
}
include_once '../../layouts/admin/head.admin.php';

$menu_tab = "filiere";
$menu_tab_sub = "creationFiliere";
include_once '../../layouts/admin/menu.admin.php';


include_once '../../views/admin/creationFiliere.php';

include_once '../../layouts/admin/footer.admin.php';
?>