<?php
include_once 'personne.classe.php';

class Etudiant extends Personne
{
	private $email;
    private $CIN;
    private $validation;

	public function __construct($id,$nom,$prenom,$password,$email,$CIN,$validation)
	{
		$this->setId($id);
		$this->setNom($nom);
		$this->setPrenom($prenom);
		$this->setPassword($password);
		$this->setEmail($email);
        $this->setCIN($CIN);
        $this->setValidation($validation);
	}
    
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getCIN()
    {
        return $this->CIN;
    }

    public function setCIN($CIN)
    {
        $this->CIN = $CIN;
    }

    public function getValidation()
    {
        return $this->validation;
    }

    public function setValidation($validation)
    {
        $this->validation = $validation;
    }
} 
?>