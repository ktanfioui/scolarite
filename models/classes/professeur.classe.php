<?php
include_once 'personne.classe.php';

class Professeur extends Personne
{
	private $email;
	private $description;

	public function __construct($id,$nom,$prenom,$password,$email,$description)
	{
		$this->setId($id);
		$this->setNom($nom);
		$this->setPrenom($prenom);
		$this->setPassword($password);
		$this->setEmail($email);
		$this->setDescription($description);
	}
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
} 
?>