<?php
include_once '../../models/managers/professeur.manager.php';
include_once '../../library/mail/sendMail.php';
class professeurModel
{

	private $professeurmanager;

	public function __construct($BDD)
	{
		$this->professeurmanager = new professeurManager($BDD);
	}

	public function getProfesseurById($id_professeur)
	{
		return $this->professeurmanager->getProfesseurById($id_professeur);
	}

	public function deleteProfesseurById($id_professeur)
	{
		return $this->professeurmanager->deleteProfesseur($id_professeur);
	}

	public function addNewProfesseur($professeur)
	{	
		$password = $professeur->getPassword();
		$professeur->setPassword(sha1($professeur->getPassword()));
		if (strcmp($professeur->getNom(),"") == 0 || strcmp($professeur->getPrenom(),"") == 0 || strcmp($professeur->getPassword(),"") == 0 || strcmp($professeur->getEmail(),"") == 0 || strcmp($professeur->getDescription(),"") == 0) 
		{
			return "Vous avez oublié un champ vide !!";
		}
		else if ($this->professeurmanager->addProfesseur($professeur) == true) 
		{
			$from = "admin@admi.com";
			$subject = "Nouveau Compte Ensak examen";
			$body = "vous pouvez maintenant accéder au site web Ensak examen (Espace professeur)\n
					Nom d'utilisteur est votre adresse email.\n
					Mot de passe ".$password.".";
			EnvoiEmail::Send_Mail($professeur->getEmail(),$subject,$body,$from);
			return "Professeur Ajout effectué avec succés !!";
		}
		else
		{
			return "Impossible d'ajouter le professeur !!";
		}
	}

	public function showAllProfesseur()
	{
		$listeProfesseur = $this->professeurmanager->getAllProfesseurs();
		if ($listeProfesseur == null) 
		{
			return "<div class=\"col-lg-12\"><div class=\"bs-example\"><div class=\"alert alert-warning fade in\">
                    <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
                    La liste des Professeurs est vide !!</div></div></div>";
		}
		else
		{
			$i = 0;
			$print = "<div class=\"col-lg-6\">";
			foreach ($listeProfesseur as $professeur)
			{
				if ($i == ceil(count($listeProfesseur)/2)) 
				{
					$print .= "</div><div class=\"col-lg-6\">";
				}
				$print .= $this->showProfesseur($professeur);
				$i++;
			}
			$print .= "</div>";
			return $print;
		}
	}

	public function showProfesseur($professeur)
	{
		return "<section class=\"panel default red_border vertical_border h1\">
	                <div class=\"row task_inner inner_padding\">
	                  <div class=\"col-sm-4\">
	                    <a href=\"#\"><img src=\"../../public/images/noavatar.png\" /></a>
	                  </div>
	                  <div class=\"col-sm-8\">
	                    <h4 class=\"prof-name\">".$professeur->getNom()." ".$professeur->getPrenom()."</h4>
	                    <p><i class=\"fa fa-envelope\"></i>".$professeur->getEmail()."</p>
	                    <p><strong class=\"colored\">Description : </strong>".htmlentities($professeur->getDescription())."</p>
	                  </div>
	                </div>
	                <div class=\"task-footer\">
	                  	<div class=\"pull-right\">
	                    	<ul class=\"footer-icons-group\">
		                      	<li><a href=\"updateProfesseur.controller.php?id_professeur=".$professeur->getId()."\"><i class=\"fa fa-pencil\"></i> Modifier</a></li>
		                      	<li><a href=\"\" data-toggle=\"modal\" data-target=\"#professeur".$professeur->getId()."\"><i class=\"fa fa-trash-o\"></i> Supprimer</a></li>
		                    </ul>
	                  	</div>
	                </div>
	            </section>";
	}

	public function optionProfesseur()
	{
		$listeProfesseur = $this->professeurmanager->getAllProfesseurs();
		echo "<div class=\"form-group\">
                  <label class=\"col-sm-3 control-label\">Professeur</label>
                  <div class=\"col-sm-9\">
                    <select class=\"form-control\" id=\"source\" name=\"optionProfesseur\">";
        if ($listeProfesseur == null) 
		{
			echo "<option value=\"null\"> La Liste est vide </option>";
		}
		else
		{
			echo "<option value=\"null\"> Choix </option>";
			foreach ($listeProfesseur as $professeur) {
	        	echo "<option value=\"".$professeur->getId()."\">".$professeur->getNom()." ".$professeur->getPrenom()."</option>";
	        }
		}
        echo "</select></div></div>";     
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
			$professeur = $this->professeurmanager->getConnection($email,$password);
			if ($professeur == null) 
			{
				return "Email ou Mot de passe incorrect !!";
			}
			else
			{
				$_SESSION["professeur"]["id"] = $professeur->getId();
				$_SESSION["professeur"]["nom"] = $professeur->getNom();
				$_SESSION["professeur"]["prenom"] = $professeur->getPrenom();
				$_SESSION["professeur"]["email"] = $professeur->getEmail();
				return "true";
			}
		}
	}

	public function sendMailToProf($id_professeur,$subject,$body)
	{
		if(strcmp($id_professeur,"null") == 0) {
			return "Vous devez choisir un professeur.";
		} elseif (strcmp($subject, "") == 0) {
			return "Vous devez spécifier un sujet.";
		} elseif (strcmp($body, "") == 0) {
			return "Le message est vide.";
		} else {
			$professeur = $this->professeurmanager->getProfesseurById($id_professeur);
			$to = $professeur->getEmail();
			$from = "admin@admi.com";
			if (EnvoiEmail::Send_Mail($to,$subject,$body,$from)) {
				return "Votre message a bien été envoyé.";
			} else {
				return "Votre message n'a pas pu être envoyé.";
			}
		}
	}

	public function deleteProfesseurModal()
	{
		$listeProfesseur = $this->professeurmanager->getAllProfesseurs();
		if ($listeProfesseur != null)
		{
			foreach ($listeProfesseur as $element) 
			{
				echo "<div class=\"modal fade\" id=\"professeur".$element->getId()."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">
						  <div class=\"modal-dialog\" role=\"document\">
						    <div class=\"modal-content\">
						      <div class=\"modal-header\">
						        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
						        <h4 class=\"modal-title\" id=\"myModalLabel\">Supprimer Module</h4>
						      </div>
						      <div class=\"modal-body\">
						        Voulez-vous vraiment supprimer le compte du professeur ".$element->getNom()." ".$element->getPrenom()."
						      </div>
						      <div class=\"modal-footer\">
						        <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Non</button>
						        <a href=\"delete.controller.php?id=".$element->getId()."&type=professeur\" type=\"button\" class=\"btn btn-valider\">Oui</a>
						      </div>
						    </div>
						  </div>
						</div>";
			}
		}
	}

	public function updateProfesseur($professeur)
	{
		if (strcmp($professeur->getNom(),"") == 0 || strcmp($professeur->getPrenom(),"") == 0 || strcmp($professeur->getEmail(),"") == 0 || strcmp($professeur->getDescription(),"") == 0) 
		{
			return "Vous avez oublié un champ vide !!";
		}
		else if ($this->professeurmanager->updateProfesseur($professeur) == true) 
		{
			return "Modification effectué avec succés !!";
		}
		else
		{
			return "Impossible de modifier le Module !!";
		}
	}
}
?>