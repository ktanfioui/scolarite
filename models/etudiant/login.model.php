<?php
include_once '../../models/managers/etudiant.manager.php';

class loginModel
{

	private $etudiantmanager;

	public function __construct($BDD)
	{
		$this->etudiantmanager = new etudiantManager($BDD);
	}

	public function establishConnection($email,$password)
	{
		if (strcmp($email, "") == 0 || strcmp($password, "") == 0) 
		{
			return "Vous avez oublié un champ vide !!";
		}
		else
		{
			$etudiant = $this->etudiantmanager->getConnection($email);//,sha1($password));
			/*if ($etudiant == null) 
			{
				return "Email ou Mot de passe incorrect !!";
			}*/
			//else
			//{
				$_SESSION["etudiant"]["id"] = $etudiant->getId();
				$_SESSION["etudiant"]["nom"] = $etudiant->getNom();
				$_SESSION["etudiant"]["prenom"] = $etudiant->getPrenom();
				$_SESSION["etudiant"]["id_filiere"] = $this->etudiantmanager->getId_filiere($etudiant->getId());
				$this->etudiantmanager->updateEtudiantField("validation",1,$etudiant->getId());
				return "true";
			//}
		}
	}

	public function getEtudiantById($id_etudiant)
	{
		return $this->etudiantmanager->getEtudiantById($id_etudiant);
	}
 
 	public function updatePassword($id_etudiant,$content)
 	{
 		$etudiant = $this->etudiantmanager->getEtudiantById($id_etudiant);
 		if (strcmp($etudiant->getPassword(), sha1($content['oldpassword'])) == 0) 
 		{
 			if (strcmp($content['rnewpassword'], $content['newpassword']) == 0 && strcmp($content['newpassword'], "") != 0) 
 			{
 				$this->etudiantmanager->updateEtudiantPassword($content['newpassword'],$id_etudiant);
				return "Modification du mot de passe effectuer !!";
 			}
 			else
 			{
 				return "les deux champs du nouveau mot de passe doivent etre identique, et non vide";
 			}
 		}
 		else
 		{
 			return "Erreur, Mot de passe actuel invalide !!";
 		}
 	}
	
}
?>