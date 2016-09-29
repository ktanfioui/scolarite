<?php
include_once '../../models/classes/examen.classe.php';
class examenManager
{
	private $db;

	public function __construct($BDD)
	{
		$this->db = $BDD;
	}

	public function addExamen($examen)
	{
		$sql = 'INSERT INTO examens (title,id_filiere,id_module,id_professeur,p_date,duree,description,isCreated,isQCM,isCoure,isExercice,isCorrection) VALUES (:title,:id_filiere,:id_module,:id_professeur,:p_date,:duree,:description,:isCreated,:isQCM,:isCoure,:isExercice,:isCorrection)';
		$qry = $this->db->prepare($sql);
		$qry->bindValue(':title', $examen->getTitle());
		$qry->bindValue(':id_filiere', $examen->getId_filiere());
		$qry->bindValue(':id_module', $examen->getId_module());
		$qry->bindValue(':id_professeur', $examen->getId_professeur());
		$qry->bindValue(':p_date', $examen->getP_date());
		$qry->bindValue(':duree', $examen->getDuree());
		$qry->bindValue(':description', $examen->getDescription());
		$qry->bindValue(':isCreated', $examen->getIsCreated());
		$qry->bindValue(':isQCM', $examen->getIsQCM());
		$qry->bindValue(':isCoure', $examen->getIsCoure());
		$qry->bindValue(':isExercice', $examen->getIsExercice());
		$qry->bindValue(':isCorrection', $examen->getIsCorrection());
		return $qry->execute();
	}


	public function updateExamenField($champ,$value,$id_examen)
	{
		$sql = "UPDATE examens SET $champ=$value WHERE id = $id_examen";
		$qry = $this->db->prepare($sql);
		$qry->execute();
	}

	public function deleteExamenById($id_examen)
	{
		$sql = "DELETE FROM examens WHERE id = $id_examen";
		$qry = $this->db->prepare($sql);
		$qry->execute();
	}

	public function getExamenById($id_examen)
	{
		$sql = "SELECT * FROM examens WHERE id = $id_examen";
		$qry = $this->db->prepare($sql);
		$qry->execute();
		$element = $qry->fetch(PDO::FETCH_ASSOC);
		
		if(empty($element))
			return null;
		else
			return new Examen($element["id"],$element["title"],$element["id_filiere"],$element["id_module"],$element["id_professeur"],$element["p_date"],$element["duree"],$element["description"],$element["isCreated"],$element["isQCM"],$element["isCoure"],$element["isExercice"],$element["isCorrection"]);
	}

	public function getAllExamensByIdPorfesseur($id_professeur)
	{
		$sql = "SELECT * FROM examens WHERE id_professeur = $id_professeur";
		$qry = $this->db->prepare($sql);
		$qry->execute();

		while($element = $qry->fetch(PDO::FETCH_ASSOC))
		{
			$examens[] = new Examen($element["id"],$element["title"],$element["id_filiere"],$element["id_module"],$element["id_professeur"],$element["p_date"],$element["duree"],$element["description"],$element["isCreated"],$element["isQCM"],$element["isCoure"],$element["isExercice"],$element["isCorrection"]);
		}

		if(empty($examens))
			return null;
		else
			return $examens;
	}
	
	public function createCreationStates($id_examen)
	{
		$sql = 'INSERT INTO creationexamen (id_examen,qcm,cours,exercices) VALUES (:id_examen,0,0,0)';
		$qry = $this->db->prepare($sql);
		$qry->bindValue(':id_examen', $id_examen);
		return $qry->execute();
	}
	
	public function updateCreationState($champ,$id_examen)
	{
		$sql = "UPDATE creationexamen SET $champ=1 WHERE id_examen = $id_examen";
		$qry = $this->db->prepare($sql);
		$qry->execute();
	}

	public function getCreationStates($id_examen)
	{
		$sql = "SELECT * FROM creationexamen WHERE id_examen = $id_examen";
		$qry = $this->db->prepare($sql);
		$qry->execute();

		$element = $qry->fetch(PDO::FETCH_ASSOC);
		
		if(empty($element))
			return null;
		else
			return $element;
	}

	public function deleteExamenStates($id_examen)
	{
		$sql = "DELETE FROM creationexamen WHERE id_examen = $id_examen";
		$qry = $this->db->prepare($sql);
		$qry->execute();
	}

	/************* correction *****************/

	public function createCorrectionStates($id_examen)
	{
		$sql = 'INSERT INTO correctionexamen (id_examen,qcm,cours,exercices) VALUES (:id_examen,0,0,0)';
		$qry = $this->db->prepare($sql);
		$qry->bindValue(':id_examen', $id_examen);
		return $qry->execute();
	}

	public function updateCorrectionState($champ,$id_examen)
	{
		$sql = "UPDATE correctionexamen SET $champ=1 WHERE id_examen = $id_examen";
		$qry = $this->db->prepare($sql);
		$qry->execute();
	}

	public function getCorrectionStates($id_examen)
	{
		$sql = "SELECT * FROM correctionexamen WHERE id_examen = $id_examen";
		$qry = $this->db->prepare($sql);
		$qry->execute();

		$element = $qry->fetch(PDO::FETCH_ASSOC);
		
		if(empty($element))
			return null;
		else
			return $element;
	}

	public function deleteCorrectionStates($id_examen)
	{
		$sql = "DELETE FROM correctionexamen WHERE id_examen = $id_examen";
		$qry = $this->db->prepare($sql);
		$qry->execute();
	}

	/***** etudiant *****/

	public function getExamenByIdFiliere($id_filiere)
	{
		$sql = "SELECT * FROM examens WHERE id_filiere = $id_filiere AND isCreated = 1";
		$qry = $this->db->prepare($sql);
		$qry->execute();

		while($element = $qry->fetch(PDO::FETCH_ASSOC))
		{
			$examens[] = new Examen($element["id"],$element["title"],$element["id_filiere"],$element["id_module"],$element["id_professeur"],$element["p_date"],$element["duree"],$element["description"],$element["isCreated"],$element["isQCM"],$element["isCoure"],$element["isExercice"],$element["isCorrection"]);
		}

		if(empty($examens))
			return null;
		else
			return $examens;
	}

	public function getAllExamen()
	{
		$sql = "SELECT * FROM examens WHERE isCreated = 1";
		$qry = $this->db->prepare($sql);
		$qry->execute();

		while($element = $qry->fetch(PDO::FETCH_ASSOC))
		{
			$examens[] = new Examen($element["id"],$element["title"],$element["id_filiere"],$element["id_module"],$element["id_professeur"],$element["p_date"],$element["duree"],$element["description"],$element["isCreated"],$element["isQCM"],$element["isCoure"],$element["isExercice"],$element["isCorrection"]);
		}

		if(empty($examens))
			return null;
		else
			return $examens;
	}
}
?>