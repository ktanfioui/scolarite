<?php
include_once '../../controllers/professeur/session.php';

$filename = '../../public/examens/'.$_GET["id_examen"]."-corr/correction-qcmfile.xlsx";
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\"");
header("Content-Length: " . filesize($filename));
readfile($filename);
header("Connection: close");

?>
