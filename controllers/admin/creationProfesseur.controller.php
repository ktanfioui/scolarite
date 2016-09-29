<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/admin/professeur.model.php';
if(isset($_POST['submit']))
{
    $professeur = new Professeur(0,$_POST['nom'],$_POST['prenom'],$_POST["password"],$_POST["email"],$_POST["description"]);
    $professeurmodel = new professeurModel($BDD);
    $message = $professeurmodel->addNewProfesseur($professeur);
}
include_once '../../layouts/admin/head.admin.php';

$menu_tab = "professeur";
$menu_tab_sub = "creationProfesseur";
include_once '../../layouts/admin/menu.admin.php';


include_once '../../views/admin/creationProfesseur.php';

include_once '../../layouts/admin/footer.admin.php';
?>