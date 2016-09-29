<?php
include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/etudiant/filiere.model.php';
include_once '../../models/etudiant/module.model.php';

$filieremodel = new filiereModel($BDD);
$modulemodel = new moduleModel($BDD);

$menu_tab = "filiere";
include_once '../../layouts/etudiant/head.etudiant.php';
$filiereInfo = $filieremodel->getFiliereInfo($_SESSION['etudiant']['id_filiere']);

include_once '../../views/etudiant/afficherFiliere.php';


include_once '../../layouts/etudiant/footer.etudiant.php';
?>