<?php
include_once '../../models/managers/filiere.manager.php';
include_once '../../models/managers/etudiant.manager.php';
include_once '../../models/extension/passGenerator.php';
include_once '../../library/mail/sendMail.php';

class filiereModel
{

	private $filieremanager;
	private $etudiantmanager;
	public function __construct($BDD)
	{
		$this->filieremanager = new filiereManager($BDD);
		$this->etudiantmanager = new etudiantManager($BDD);
	}

	public function getFiliereById($id_filiere)
	{
		return $this->filieremanager->getFiliereById($id_filiere);
	}

	public function getEtudiantById($id_etudiant) {
		return $this->etudiantmanager->getEtudiantById($id_etudiant);
	}

	public function deleteFiliereById($id_filiere)
	{
		return $this->filieremanager->deleteFiliere($id_filiere);
	}

	public function addNewFiliere($filiere)
	{
		if (strcmp($filiere->getIntitule(),"") == 0 || strcmp($filiere->getNiveau(),"") == 0 || strcmp($filiere->getNbrModule(),"") == 0 || strcmp($filiere->getDescription(),"") == 0) 
		{
			return "Vous avez oublié un champ vide !!";
		}
		else if ($this->filieremanager->addFiliere($filiere) == true) 
		{
			return "Filiere Ajout effectué avec succés !!";
		}
		else
		{
			return "Impossible d'ajouter la filiere !!";
		}
	}

	public function updateFiliere($filiere)
	{
		if (strcmp($filiere->getIntitule(),"") == 0 || strcmp($filiere->getNiveau(),"") == 0 || strcmp($filiere->getNbrModule(),"") == 0 || strcmp($filiere->getDescription(),"") == 0) 
		{
			return "Vous avez oublié un champ vide !!";
		}
		else if ($this->filieremanager->updateFiliere($filiere) == true) 
		{
			return "Modification effectué avec succés !!";
		}
		else
		{
			return "Impossible de modifier la filiere !!";
		}
	}

	public function updateEtudiant($etudiant) {
		if (strcmp($etudiant->getNom(),"") == 0 || strcmp($etudiant->getPrenom(),"") == 0 || strcmp($etudiant->getEmail(),"") == 0 || strcmp($etudiant->getCIN(),"") == 0) 
		{
			return "Vous avez oublié un champ vide !!";
		}
		else if ($this->etudiantmanager->updateEtudiant($etudiant) == true) 
		{
			return "Modification effectué avec succés !!";
		}
		else
		{
			return "Impossible de modifier la filiere !!";
		}
	}

	public function showAllFiliere()
	{
		$listefiliere = $this->filieremanager->getAllFilieres();
		if ($listefiliere == null) 
		{
			return "<div class=\"col-lg-12\"><div class=\"bs-example\"><div class=\"alert alert-warning fade in\">
                    <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
                    La liste des filieres est vide !!</div></div></div>";
		}
		else
		{
			$i = 0;
			$print = "<div class=\"col-lg-6\">";
			foreach ($listefiliere as $filiere)
			{
				if ($i == ceil(count($listefiliere)/2)) 
				{
					$print .= "</div><div class=\"col-lg-6\">";
				}
				$print .= $this->showfiliere($filiere);
				$i++;
			}
			$print .= "</div>";
			return $print;
		}
	}

	public function showFiliere($filiere)
	{
		return "<section class=\"panel default red_border vertical_border h1\">
		            <div class=\"task-header red_task\">".$filiere->getIntitule()."</div>
		              <div class=\"row task_inner inner_padding\">
		                <div class=\"col-sm-12\">
		                  <p><strong class=\"colored\">Niveau : </strong>".$filiere->getNiveau()."</p>
		                  <p><strong class=\"colored\">Nombre de Modules : </strong>".$filiere->getNbrModule()."</p>
		                  <p><strong class=\"colored\">Description : </strong>".$filiere->getDescription()."</p>
		                </div>

		              </div>
		              <div class=\"task-footer\">
		                <div class=\"pull-right\">
		                  <ul class=\"footer-icons-group\">
		                    <li><a href=\"afficherFiliere.controller.php?id_filiere=".$filiere->getId()."\"><i class=\"fa fa-wrench\"></i> Afficher</a></li>
		                    <li><a href=\"updateFiliere.controller.php?id_filiere=".$filiere->getId()."\"><i class=\"fa fa-pencil\"></i> Modifier</a></li>
		                    <li><a href=\"\" data-toggle=\"modal\" data-target=\"#filiere".$filiere->getId()."\"><i class=\"fa fa-trash-o\"></i> Supprimer</a></li>
		                  </ul>
		                </div>
		            </div>
		        </section>";
	}

	public function optionFiliere()
	{
		$listefiliere = $this->filieremanager->getAllFilieres();
		echo "<div class=\"form-group\">
                  <label class=\"col-sm-3 control-label\">Filiere</label>
                  <div class=\"col-sm-9\">
                    <select class=\"form-control\" id=\"source\" name=\"optionFiliere\">";
        if ($listefiliere == null) 
		{
			echo "<option value=\"null\"> La Liste est vide </option>";
		}
		else
		{
			echo "<option value=\"null\"> Choix </option>";
			foreach ($listefiliere as $filiere) {
	        	echo "<option value=\"".$filiere->getId()."\">".$filiere->getIntitule()." (".$filiere->getNiveau().")</option>";
	        }
		}
        echo "</select></div></div>";     
	}

	public function showFiliereInfo($id_filiere)
	{
		$filiere = $this->filieremanager->getFiliereById($id_filiere);

		if($filiere == null)
		{
			return null;
		}
		else
		{
			$print = $this->printFiliereInfo($filiere);
			return $print;
		}
	}

	public function printFiliereInfo($filiere)
	{
		return "<div class=\"col-sm-8\">
		            <section class=\"panel default red_border vertical_border h1\">
		              <div class=\"task-header red_task\">".$filiere->getIntitule()."</div>
		                <div class=\"row task_inner inner_padding\">
		                  <div class=\"col-sm-12\">
		                    <p><strong class=\"colored\">Niveau : </strong>".$filiere->getNiveau()."</p>
		                    <p><strong class=\"colored\">Description : </strong>".$filiere->getDescription()."</p>
		                  </div>
		                </div>
		            </section>
		        </div>";
	}

	public function printFiliereModuleBySemstre($id_filiere,$semestre)
	{
		$liste = $this->filieremanager->getModulesProfesseurByIdFiliere($id_filiere,"S".$semestre);
		echo "<div class=\"col-lg-6\">
            <section class=\"panel default blue_title h2\">
              <div class=\"panel-heading\">Semestre ".$semestre."</div>
              <div class=\"panel-body\">";

        if ($liste == null) 
        {
        	echo "<div class=\"col-lg-12\"><div class=\"bs-example\"><div class=\"alert alert-info fade in\">
		            <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
		            La liste est vide !!</div></div></div>";
        }
        else
        {
        	echo "<table class=\"table table-bordered\"><thead><tr>
                      <th>#</th><th>Module</th><th>Professeur</th>
                    </tr></thead><tbody>";
            $i = 1;
            foreach ($liste as $element) 
            {
            	echo "<tr><td>".$i."</td><td>".$element["intitule_module"]."</td><td>".$element["nom_prof"]."</td></tr>";
            }
            echo "</tbody></table>";
        }
        echo "</div></section></div>";
	}

	public function addEtudiantToFiliere($listes,$id_filiere)
	{
		$i = 0;
		foreach ($listes as $liste)
		{
			foreach ($liste as $element)
			{
				if ($i != 0) 
				{
					$password = generateMDP(20);
					$etudiant = new Etudiant(0,$element[0],$element[1],sha1($password),$element[2],$element[3],0);
					$this->etudiantmanager->addEtudiant($etudiant,$id_filiere);
					//$this->sendMail($element[2],$password);
				}
				$i++;
			}
		}
	}

	public function sendMail($email,$password)
	{
		$from = "admin@admin.com";
		$subject = "Nouveau Compte Ensak examen";
		$body = "Vous pouvez maintenant accéder au site web Ensak examen (Espace etudiant)\r\n
				Nom d'utilisteur est votre adresse email.\r\n
				Mot de passe ".$password.".";
		EnvoiEmail::Send_Mail($email,$subject,$body,$from);
	}

	
	public function printFiliereEtudiant($id_filiere)
	{
		$liste = $this->etudiantmanager->getEtudiantsByIdFiliere($id_filiere);

		if ($liste == null) 
        {
        	echo "<div class=\"col-lg-12\"><div class=\"bs-example\"><div class=\"alert alert-info fade in\">
		            <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
		            La liste est vide !!</div></div></div>";
        }
        else
        {
        	echo "<table class=\"table table-bordered\">
                  <thead><tr><th>#</th><th>Nom</th><th>Prénom</th><th>Email</th><th>CIN</th><th>Validation</th><th>Options</th>
                    </tr></thead><tbody>";
            $i = 1;
            foreach ($liste as $etudiant) 
            {
            	echo "<tr><td>".$i."</td><td>".$etudiant->getNom()."</td><td>".$etudiant->getPrenom()."</td><td>".$etudiant->getEmail()."</td><td>".$etudiant->getCIN()."</td><td>";
            	echo $etudiant->getNom() == 0 ? "<i class=\"fa fa-times\"></i>" : "<i class=\"fa fa-check\"></i>";
            	echo "</td><td><a href=\"delete.controller.php?id=".$etudiant->getId()."&type=etudiant&id_filiere=".$id_filiere."\">Supprimer</a>
            	<a href=\"updateEtudiant.controller.php?id_etudiant=".$etudiant->getId()."\">Modifier</a></td></tr>";
            	$i++;
            }
            echo "</tbody></table>";

            echo "<div class=\"pull-right\"><a href=\"delete.controller.php?id=".$id_filiere."&type=listEtudiants\" type=\"button\" class=\"btn btn-valider\">Supprimer la liste</a>\</div>";
        }
	}

	public function deleteFiliereModal()
	{
		$listeFiliere = $this->filieremanager->getAllFilieres();
		if ($listeFiliere != null)
		{
			foreach ($listeFiliere as $element) 
			{
				echo "<div class=\"modal fade\" id=\"filiere".$element->getId()."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">
						  <div class=\"modal-dialog\" role=\"document\">
						    <div class=\"modal-content\">
						      <div class=\"modal-header\">
						        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
						        <h4 class=\"modal-title\" id=\"myModalLabel\">Supprimer Filiere</h4>
						      </div>
						      <div class=\"modal-body\">
						        Voulez-vous vraiment supprimer la filiere ".$element->getIntitule()."
						      </div>
						      <div class=\"modal-footer\">
						        <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Non</button>
						        <a href=\"delete.controller.php?id=".$element->getId()."&type=filiere\" type=\"button\" class=\"btn btn-valider\">Oui</a>
						      </div>
						    </div>
						  </div>
						</div>";
			}
		}
	}

	public function deleteEtudiantFromFiliere($id_etudiant) {
		return $this->etudiantmanager->deleteEtudiantFromFiliere($id_etudiant);
	}

	public function deleteAllEtudiantsFromFiliere($id_filiere) {
		return $this->etudiantmanager->deleteAllEtudiantsFromFiliere($id_filiere);
	}

	public function sendMailToEtudiantsOfFiliere($id_filiere,$subject,$body)
	{
		$from = "admin@admin.com";
		if(strcmp($id_filiere,"null") == 0) {
			return "Vous devez choisir un professeur.";
		} elseif (strcmp($subject, "") == 0) {
			return "Vous devez spécifier un sujet.";
		} elseif (strcmp($body, "") == 0) {
			return "Le message est vide.";
		} else {
			$listeEtudiant = $this->etudiantmanager->getEtudiantsByIdFiliere($id_filiere);
			foreach ($listeEtudiant as $etudiant) {
				$to = $etudiant->getEmail();
				$message = "";
				if (!EnvoiEmail::Send_Mail($to,$subject,$body,$from)) {
					$message .= "Votre message n'a pas pu être envoyé à ".$etudiant->getNom()."".$etudiant->getPrenom().".\n";
				}
			}
			if (strcmp($message, "") == 0) {
				$message = "Votre message a bien été envoyé.";
			}
			return $message;
		}
	}
}
?>