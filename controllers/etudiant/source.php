<?php
include_once '../../models/core.php';

include_once '../../models/etudiant/examen.model.php';

$id = $_GET['id'];
$examenmodel = new examenModel($BDD);
$listeExamen = $examenmodel->getExamenByIdFiliereForCalendar($id);

echo json_encode($listeExamen);
?>