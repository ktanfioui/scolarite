<?php
include_once '../../models/managers/admin.manager.php';

class adminModel
{

	private $adminmanager;

	public function __construct($BDD)
	{
		$this->adminmanager = new adminManager($BDD);
	}

	public function establishConnection($email,$password)
	{
		if (strcmp($email, "") == 0 || strcmp($password, "") == 0) 
		{
			return "Vous avez oublié un champ vide !!";
		}
		else
		{
			$password = sha1($password);
			$admin = $this->adminmanager->getConnection($email,$password);
			if ($admin == null) 
			{
				return "Email ou Mot de passe incorrect !!";
			}
			else
			{
				$_SESSION["admin"]["id"] = $admin->getId();
				$_SESSION["admin"]["nom"] = $admin->getNom();
				$_SESSION["admin"]["prenom"] = $admin->getPrenom();
				return "true";
			}
		}
	}

	
}
?>