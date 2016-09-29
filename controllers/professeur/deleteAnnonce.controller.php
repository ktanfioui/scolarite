<?php

include_once 'session.php';
include_once '../../models/core.php';
include_once '../../models/professeur/annonce.model.php';

if($_GET['type'] == 'annonce') 
{
		$annoncemodel = new annonceModel($BDD);
		$annoncemodel->deleteAnnonceById($_GET['id']);
		header("location:listeAnnonce.controller.php");
}
?>