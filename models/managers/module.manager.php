<?php
include_once '../../models/classes/module.classe.php';
class moduleManager
{
	private $db;

	public function __construct($BDD)
	{
		$this->db = $BDD;
	}

	public function getModuleById($id_module)
	{
		$sql = "SELECT * FROM modules WHERE id = $id_module";
		$qry = $this->db->prepare($sql);
		$qry->execute();
		$element = $qry->fetch(PDO::FETCH_ASSOC);
		
		if(empty($element))
			return null;
		else
			return new Module($element['id'],$element['intitule'],$element['description']);
	}

	public function addModule($module)
	{
		$sql = 'INSERT INTO modules (intitule,description) VALUES (:intitule,:description)';
		$qry = $this->db->prepare($sql);
		$qry->bindValue(':intitule', $module->getIntitule());
		$qry->bindValue(':description', $module->getDescription());
		return $qry->execute();
	}

	public function updateModule($module)
	{
		$sql = 'UPDATE modules SET intitule=:intitule, description=:description WHERE id = :id';
		$qry = $this->db->prepare($sql);
		$qry->bindValue(':id', $module->getId());
		$qry->bindValue(':intitule', $module->getIntitule());
		$qry->bindValue(':description', $module->getDescription());
		return $qry->execute();
	}

	public function deleteModule($id_module)
	{
		$sql = "DELETE FROM modules WHERE id = $id_module";
		$qry = $this->db->prepare($sql);
		$qry->execute();
	}

	public function getAllModules()
	{
		$sql = "SELECT * FROM modules";
		$qry = $this->db->prepare($sql);
		$qry->execute();

		while($element = $qry->fetch(PDO::FETCH_ASSOC))
		{
			$modules[] = new Module($element['id'],$element['intitule'],$element['description']);
		}

		if(empty($modules))
			return null;
		else
			return $modules;
	}

	public function linkModule($id_module,$id_filiere,$id_professeur,$semestre)
	{
		$sql = 'INSERT INTO linkmodule (id_module,id_filiere,id_professeur,semestre) VALUES (:id_module,:id_filiere,:id_professeur,:semestre)';
		$qry = $this->db->prepare($sql);
		$qry->bindValue(':id_module', $id_module);
		$qry->bindValue(':id_filiere', $id_filiere);
		$qry->bindValue(':id_professeur', $id_professeur);
		$qry->bindValue(':semestre', $semestre);
		return $qry->execute();
	}

	public function getLinkModule($id_module,$id_filiere,$id_professeur)
	{
		$sql = "SELECT * FROM linkmodule WHERE id_module = $id_module AND id_filiere = $id_filiere AND id_professeur = $id_professeur";
		$qry = $this->db->prepare($sql);
		$qry->execute();

		$element = $qry->fetch(PDO::FETCH_ASSOC);
		if (empty($element)) {
			return false;
		} else {
			return true;
		}
	}

	public function getFiliereProfesseurByIdModule($id_module)
	{
		$sql = "SELECT filieres.intitule,professeurs.nom,professeurs.prenom,linkmodule.semestre,linkmodule.id_module,linkmodule.id_professeur,linkmodule.id_filiere FROM linkmodule LEFT join filieres on filieres.id = linkmodule.id_filiere left join professeurs on professeurs.id = linkmodule.id_professeur where linkmodule.id_module = $id_module";
		$qry = $this->db->prepare($sql);
		$qry->execute();

		while($element = $qry->fetch(PDO::FETCH_ASSOC))
		{
			$liste[] = array('intitule_filiere' => $element["intitule"],'nom_prof' => $element["nom"]." ".$element["prenom"],'semestre' => $element["semestre"],'id_module' => $element["id_module"],'id_professeur' => $element["id_professeur"],'id_filiere' => $element["id_filiere"]);
		}

		if (empty($liste)) 
			return null;
		else
			return $liste;
	}

	public function getAllModulesByIdPorfesseur($id_professeur)
	{
		$sql = "SELECT * FROM modules LEFT JOIN linkmodule ON modules.id = linkmodule.id_module WHERE linkmodule.id_professeur = $id_professeur ";
		$qry = $this->db->prepare($sql);
		$qry->execute();

		while($element = $qry->fetch(PDO::FETCH_ASSOC))
		{
			$modules[] = new Module($element['id'],$element['intitule'],$element['description']);
		}

		if(empty($modules))
			return null;
		else
			return $modules;
	}

	public function getIntituleFiliereByIdModule($id_module,$id_professeur)
	{
		$sql = "SELECT filieres.intitule,linkmodule.semestre FROM filieres LEFT JOIN linkmodule ON filieres.id = linkmodule.id_filiere WHERE linkmodule.id_professeur = $id_professeur AND linkmodule.id_module = $id_module ";
		$qry = $this->db->prepare($sql);
		$qry->execute();
		
		while($element = $qry->fetch(PDO::FETCH_ASSOC))
		{
			$liste[] = array('intitule_filiere' => $element["intitule"],'semestre' => $element["semestre"]);
		}

		if (empty($liste)) 
			return null;
		else
			return $liste;
	}

	public function getAllModulesByIdPorfesseurIdFiliere($id_professeur,$id_filiere)
	{
		$sql = "SELECT * FROM modules LEFT JOIN linkmodule ON modules.id = linkmodule.id_module WHERE linkmodule.id_professeur = $id_professeur AND linkmodule.id_filiere = $id_filiere";
		$qry = $this->db->prepare($sql);
		$qry->execute();

		while($element = $qry->fetch(PDO::FETCH_ASSOC))
		{
			$modules[] = new Module($element['id'],$element['intitule'],$element['description']);
		}

		if(empty($modules))
			return null;
		else
			return $modules;
	}

	public function getModulesByIdFiliereAndSemestre($id_filiere,$semestre)
	{
		$sql = "SELECT modules.id,modules.intitule,modules.description FROM linkmodule LEFT join modules on modules.id = linkmodule.id_module left join professeurs on professeurs.id = linkmodule.id_professeur where linkmodule.id_filiere = $id_filiere AND linkmodule.semestre = '$semestre'";
		$qry = $this->db->prepare($sql);
		$qry->execute();

		while($element = $qry->fetch(PDO::FETCH_ASSOC))
		{
			$modules[] = new Module($element['id'],$element['intitule'],$element['description']);
		}

		if (empty($modules)) 
			return null;
		else
			return $modules;
	}

	public function countModuleForFiliere($id_filiere)
	{
		$sql = "SELECT COUNT(id_module) AS nbr FROM linkmodule WHERE id_filiere = $id_filiere";
		$qry = $this->db->prepare($sql);
		$qry->execute();
		$element = $qry->fetch(PDO::FETCH_ASSOC);

		return $element["nbr"];
	}

	public function deleteLinkModule($id_module,$id_filiere,$id_professeur) {
		$sql = "DELETE FROM linkmodule WHERE id_module = $id_module AND id_filiere = $id_filiere AND id_professeur = $id_professeur";
		$qry = $this->db->prepare($sql);
		$qry->execute();
	}
}
?>