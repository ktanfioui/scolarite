<?php
class Personne
{
	private $id;
	private $nom;
	private $prenom;
	private $password;

	public function __construct($id,$nom,$prenom,$password)
	{
		$this->setId($id);
		$this->setNom($nom);
		$this->setPrenom($prenom);
		$this->setPassword($password);
	}
	//setters list
	public function setId($id)
	{
		$this->id = $id;
	}
	public function setNom($nom)
	{
		$this->nom = $nom;
	}
	public function setPrenom($prenom)
	{
		$this->prenom = $prenom;
	}
	public function setPassword($password)
	{
		$this->password = $password;
	}
	
	//getters list
	public function getId()
	{
		return $this->id;
	}
	public function getNom()
	{
		return $this->nom;
	}
	public function getPrenom()
	{
		return $this->prenom;
	}
	public function getPassword()
	{
		return $this->password;
	}

	
} 
?>