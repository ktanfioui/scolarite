<?php
include_once '../../models/managers/filiere.manager.php';

class filiereModel
{

	private $filieremanager;

	public function __construct($BDD)
	{
		$this->filieremanager = new filiereManager($BDD);
	}

	public function getFiliereInfo($id_filiere)
	{
		$filiere = $this->filieremanager->getFiliereById($id_filiere);
		$print = "<div class=\"side-title\"><h3>".$filiere->getIntitule()."</h3></div>";
		$print .= "<div class=\"side-content\">";
		$print .= "<p><strong class=\"colored\">Niveau : </strong>".$filiere->getNiveau()."</p>";
		$print .= "<p><strong class=\"colored\">Déscription : </strong>".$filiere->getDescription()."</p>";
		$print .= "</div>";
		return $print;
	}
}
?>