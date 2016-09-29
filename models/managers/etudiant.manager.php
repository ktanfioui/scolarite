<?php
include_once '../../models/classes/etudiant.classe.php';
class etudiantManager
{
	private $db;

	public function __construct($BDD)
	{
		$this->db = $BDD;
	}

	public function getEtudiantById($id_etudiant)
	{
		$sql = "SELECT * FROM etudiants WHERE id = $id_etudiant";
		$qry = $this->db->prepare($sql);
		$qry->execute();
		$element = $qry->fetch(PDO::FETCH_ASSOC);
		if(empty($element))
			return null;
		else
			return new Etudiant($element['id'],$element['nom'],$element['prenom'],$element['password'],$element['email'],$element['CIN'],$element['validation']);
	}

	public function updateEtudiant($etudiant) {
		$sql = "UPDATE etudiants SET nom=:nom, prenom=:prenom, email=:email, cin=:cin WHERE id = :id";
		$qry = $this->db->prepare($sql);
		$qry->bindValue(':id', $etudiant->getId());
		$qry->bindValue(':nom', $etudiant->getNom());
		$qry->bindValue(':prenom', $etudiant->getPrenom());
		$qry->bindValue(':email', $etudiant->getEmail());
		$qry->bindValue(':cin', $etudiant->getCIN());
		return $qry->execute();
	}

	public function addEtudiant($etudiant,$id_filiere)
	{
		$sql = 'INSERT INTO etudiants (nom,prenom,password,email,CIN,validation,id_filiere) VALUES (:nom,:prenom,:password,:email,:CIN,:validation,:id_filiere)';
		$qry = $this->db->prepare($sql);
		$qry->bindValue(':nom', $etudiant->getNom());
		$qry->bindValue(':prenom', $etudiant->getPrenom());
		$qry->bindValue(':password', $etudiant->getPassword());
		$qry->bindValue(':email', $etudiant->getEmail());
		$qry->bindValue(':CIN', $etudiant->getCIN());
		$qry->bindValue(':validation', $etudiant->getValidation());
		$qry->bindValue(':id_filiere', $id_filiere);
		return $qry->execute();
	}

	public function getEtudiantsByIdFiliere($id_filiere)
	{
		$sql = "SELECT * FROM etudiants WHERE id_filiere = $id_filiere";
		$qry = $this->db->prepare($sql);
		$qry->execute();

		while($element = $qry->fetch(PDO::FETCH_ASSOC))
		{
			$etudiants[] = new Etudiant($element['id'],$element['nom'],$element['prenom'],$element['password'],$element['email'],$element['CIN'],$element['validation']);
		}

		if(empty($etudiants))
			return null;
		else
			return $etudiants;
	}

	public function getConnection($email)//,$password)
	{
		$login_info = array('email' => $email );//, 'password' => $password );
		$sql = 'SELECT * FROM etudiants WHERE email = :email ';//AND password = :password';
		$qry = $this->db->prepare($sql);
		$qry->execute($login_info);

		$element = $qry->fetch(PDO::FETCH_ASSOC);
		
		if(empty($element))
			return null;
		else
			return new Etudiant($element['id'],$element['nom'],$element['prenom'],$element['password'],$element['email'],$element['CIN'],$element['validation']);
	}
	
	public function updateEtudiantPassword($value,$id_etudiant)
	{
		$sql = "UPDATE etudiants SET password=sha1($value) WHERE id = $id_etudiant";
		$qry = $this->db->prepare($sql);
		$qry->execute();
	}
	
	public function updateEtudiantField($field,$value,$id_etudiant)
	{
		$sql = "UPDATE etudiants SET $field=$value WHERE id = $id_etudiant";
		$qry = $this->db->prepare($sql);
		$qry->execute();
	}

	public function getId_filiere($id_etudiant)
	{
		$sql = "SELECT * FROM etudiants WHERE id = $id_etudiant";
		$qry = $this->db->prepare($sql);
		$qry->execute();

		$element = $qry->fetch(PDO::FETCH_ASSOC);

		if(empty($element))
			return null;
		else
			return $element['id_filiere'];
	}

	public function deleteEtudiantFromFiliere($id_etudiant) {
		$sql = "DELETE FROM etudiants WHERE id = $id_etudiant";
		$qry = $this->db->prepare($sql);
		$qry->execute();
	}

	public function deleteAllEtudiantsFromFiliere($id_filiere) {
		$sql = "DELETE FROM etudiants WHERE id_filiere = $id_filiere";
		$qry = $this->db->prepare($sql);
		$qry->execute();
	}
}
?>