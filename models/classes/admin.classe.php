<?php
include_once 'personne.classe.php';

class Admin extends Personne
{
	private $email;

	public function __construct($id,$nom,$prenom,$password,$email)
	{
		$this->setId($id);
		$this->setNom($nom);
		$this->setPrenom($prenom);
		$this->setPassword($password);
		$this->setEmail($email);
	}
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
} 
?>