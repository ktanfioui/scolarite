<?php
include_once '../../models/classes/filiere.classe.php';
class filiereManager
{
	private $db;

	public function __construct($BDD)
	{
		$this->db = $BDD;
	}
	
	public function getFiliereById($id_filiere)
	{
		$sql = "SELECT * FROM filieres WHERE id = $id_filiere";
		$qry = $this->db->prepare($sql);
		$qry->execute();
		$element = $qry->fetch(PDO::FETCH_ASSOC);
		
		if(empty($element))
			return null;
		else
			return new Filiere($element['id'],$element['intitule'],$element['niveau'],$element['nbrModule'],$element['description']);
	}

	public function addFiliere($filiere)
	{
		$sql = 'INSERT INTO filieres (intitule,niveau,nbrModule,description) VALUES (:intitule,:niveau,:nbrModule,:description)';
		$qry = $this->db->prepare($sql);
		$qry->bindValue(':intitule', $filiere->getIntitule());
		$qry->bindValue(':niveau', $filiere->getNiveau());
		$qry->bindValue(':nbrModule', $filiere->getNbrModule());
		$qry->bindValue(':description', $filiere->getDescription());
		return $qry->execute();
	}

	public function updateFiliere($filiere)
	{
		$sql = 'UPDATE filieres SET intitule=:intitule, niveau=:niveau , description=:description WHERE id = :id';
		$qry = $this->db->prepare($sql);
		$qry->bindValue(':id', $filiere->getId());
		$qry->bindValue(':intitule', $filiere->getIntitule());
		$qry->bindValue(':niveau', $filiere->getNiveau());
		$qry->bindValue(':description', $filiere->getDescription());
		return $qry->execute();
	}

	public function deleteFiliere($id_filiere)
	{
		$sql = "DELETE FROM filieres WHERE id = $id_filiere";
		$qry = $this->db->prepare($sql);
		$qry->execute();
	}

	public function getAllFilieres()
	{
		$sql = "SELECT * FROM filieres";
		$qry = $this->db->prepare($sql);
		$qry->execute();

		while($element = $qry->fetch(PDO::FETCH_ASSOC))
		{
			$filieres[] = new Filiere($element['id'],$element['intitule'],$element['niveau'],$element['nbrModule'],$element['description']);
		}

		if(empty($filieres))
			return null;
		else
			return $filieres;
	}

	public function getModulesProfesseurByIdFiliere($id_filiere,$semestre)
	{
		$sql = "SELECT modules.intitule,professeurs.nom,professeurs.prenom FROM linkmodule LEFT join modules on modules.id = linkmodule.id_module left join professeurs on professeurs.id = linkmodule.id_professeur where linkmodule.id_filiere = $id_filiere AND linkmodule.semestre = '$semestre'";
		$qry = $this->db->prepare($sql);
		$qry->execute();

		while($element = $qry->fetch(PDO::FETCH_ASSOC))
		{
			$liste[] = array('intitule_module' => $element["intitule"],'nom_prof' => $element["nom"]." ".$element["prenom"] );
		}

		if (empty($liste)) 
			return null;
		else
			return $liste;
	}

	public function getAllFilieresByIdPorfesseur($id_professeur)
	{
		$sql = "SELECT * FROM filieres LEFT JOIN linkmodule ON filieres.id = linkmodule.id_filiere WHERE linkmodule.id_professeur = $id_professeur ";
		$qry = $this->db->prepare($sql);
		$qry->execute();

		while($element = $qry->fetch(PDO::FETCH_ASSOC))
		{
			$filieres[] = new Filiere($element['id'],$element['intitule'],$element['niveau'],$element['nbrModule'],$element['description']);
		}

		if(empty($filieres))
			return null;
		else
			return $filieres;
	}

	public function getModuleByIdFiliereAndProfesseur($id_filiere,$id_professeur)
	{
		$sql = "SELECT modules.intitule,linkmodule.semestre FROM modules LEFT JOIN linkmodule ON modules.id = linkmodule.id_module WHERE linkmodule.id_filiere = $id_filiere AND linkmodule.id_professeur = $id_professeur";
		$qry = $this->db->prepare($sql);
		$qry->execute();
		
		while($element = $qry->fetch(PDO::FETCH_ASSOC))
		{
			$liste[] = array('intitule_module' => $element["intitule"],'semestre' => $element["semestre"]);
		}

		if (empty($liste)) 
			return null;
		else
			return $liste;
	}

}
?>