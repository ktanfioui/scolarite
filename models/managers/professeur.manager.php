<?php
include_once '../../models/classes/professeur.classe.php';
class professeurManager
{
	private $db;

	public function __construct($BDD)
	{
		$this->db = $BDD;
	}
	
	public function getProfesseurById($id_professeur)
	{
		$sql = "SELECT * FROM professeurs WHERE id = $id_professeur";
		$qry = $this->db->prepare($sql);
		$qry->execute();
		$element = $qry->fetch(PDO::FETCH_ASSOC);
		
		if(empty($element))
			return null;
		else
			return new Professeur($element['id'],$element['nom'],$element['prenom'],$element['password'],$element['email'],$element['description']);
	}

	public function getConnection($email,$password)
	{
		$login_info = array('email' => $email , 'password' => $password );
		$sql = 'SELECT * FROM professeurs WHERE email = :email AND password = :password';
		$qry = $this->db->prepare($sql);
		$qry->execute($login_info);

		$element = $qry->fetch(PDO::FETCH_ASSOC);
		
		if(empty($element))
			return null;
		else
			return new Professeur($element['id'],$element['nom'],$element['prenom'],$element['password'],$element['email'],$element['adresse'],$element['tel'],$element['description']);
	}
	
	public function addProfesseur($professeur)
	{
		$sql = 'INSERT INTO professeurs (nom,prenom,password,email,description) VALUES (:nom,:prenom,:password,:email,:description)';
		$qry = $this->db->prepare($sql);
		$qry->bindValue(':nom', $professeur->getNom());
		$qry->bindValue(':prenom', $professeur->getPrenom());
		$qry->bindValue(':password', $professeur->getPassword());
		$qry->bindValue(':email', $professeur->getEmail());
		$qry->bindValue(':description', $professeur->getDescription());
		return $qry->execute();
	}

	public function getAllProfesseurs()
	{
		$sql = "SELECT * FROM professeurs";
		$qry = $this->db->prepare($sql);
		$qry->execute();

		while($element = $qry->fetch(PDO::FETCH_ASSOC))
		{
			$professeurs[] = new Professeur($element['id'],$element['nom'],$element['prenom'],$element['password'],$element['email'],$element['description']);
		}

		if(empty($professeurs))
			return null;
		else
			return $professeurs;
	}

	public function updateProfesseur($professeur)
	{
		$sql = 'UPDATE professeurs SET nom=:nom, prenom=:prenom, email=:email, description=:description WHERE id = :id';
		$qry = $this->db->prepare($sql);
		$qry->bindValue(':id', $professeur->getId());
		$qry->bindValue(':nom', $professeur->getNom());
		$qry->bindValue(':prenom', $professeur->getPrenom());
		$qry->bindValue(':email', $professeur->getEmail());
		$qry->bindValue(':description', $professeur->getDescription());
		return $qry->execute();
	}

	public function deleteProfesseur($id_professeur)
	{
		$sql = "DELETE FROM professeurs WHERE id = $id_professeur";
		$qry = $this->db->prepare($sql);
		$qry->execute();
	}
}
?>