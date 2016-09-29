<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/admin/filiere.model.php';
$filieremodel = new filiereModel($BDD);
$etudiant = $filieremodel->getEtudiantById(empty($_GET['id_etudiant']) ? $_POST['id_etudiant'] : $_GET['id_etudiant']);
if(isset($_POST['submit']))
{
    $etudiant = new Etudiant($_POST['id_etudiant'],$_POST['nom'],$_POST['prenom'],null,$_POST['email'],$_POST['cin'],false);
    $message = $filieremodel->updateEtudiant($etudiant);
}
include_once '../../layouts/admin/head.admin.php';

$menu_tab = "filiere";
$menu_tab_sub = "listeFiliere";
include_once '../../layouts/admin/menu.admin.php';


include_once '../../views/admin/updateEtudiant.php';

include_once '../../layouts/admin/footer.admin.php';
?>