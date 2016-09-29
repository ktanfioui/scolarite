<?php
include_once '../../models/managers/etudiant.manager.php';

class etudiantModel
{

	private $etudiantmanager;

	public function __construct($BDD)
	{
		$this->etudiantmanager = new etudiantManager($BDD);
	}

	public function getEtudiantById($id_etudiant)
	{
		return $this->etudiantmanager->getEtudiantById($id_etudiant);
	}
	
	public function getEtudiantsByIdFiliere($id_filiere)
	{
		return $this->etudiantmanager->getEtudiantsByIdFiliere($id_filiere);
	}

	public function printEtudiantsInListe($id_examen,$id_filiere)
	{
		$listeEtudiant = $this->getEtudiantsByIdFiliere($id_filiere);

		$print = "";
		$i = 1;
		foreach ($listeEtudiant as $etudiant) 
		{
			$print .= "<tr><td>".$i."</td><td>".$etudiant->getNom()."</td><td>".$etudiant->getPrenom()."</td>";
			if ($this->passerExamen($id_examen,$etudiant->getId())) {
				$print .= "<td><a href=\"afficherReponseExamen.controller.php?id_examen=".$id_examen."&id_etudiant=".$etudiant->getId()."\">Visualiser</a></td>";
			} else {
				$print .= "<td>Rater</td>";
			}
			$print .= "</tr>";
			$i++;
		}
		return $print;
	}

	public function passerExamen($id_examen,$id_etudiant)
	{
		if (file_exists($_SERVER['DOCUMENT_ROOT'].'/exam_ensak/public/examens/'.$id_examen.'-rep/'.$id_etudiant)) {
			return true;
		} else {
			return false;
		}
	}
}
?>