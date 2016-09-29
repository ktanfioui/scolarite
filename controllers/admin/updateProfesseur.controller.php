<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/admin/professeur.model.php';
$professeurmodel = new professeurModel($BDD);
$professeur = $professeurmodel->getProfesseurById(empty($_GET['id_professeur']) ? $_POST['id_professeur'] : $_GET['id_professeur']);
if(isset($_POST['submit']))
{
    $professeur = new Professeur($_POST['id_professeur'],$_POST['nom'],$_POST['prenom'],null,$_POST['email'],$_POST['description']);
    $message = $professeurmodel->updateProfesseur($professeur);
}
include_once '../../layouts/admin/head.admin.php';

$menu_tab = "professeur";
$menu_tab_sub = "creationProfesseur";
include_once '../../layouts/admin/menu.admin.php';


include_once '../../views/admin/updateProfesseur.php';

include_once '../../layouts/admin/footer.admin.php';
?>