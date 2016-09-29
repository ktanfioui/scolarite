<?php
include_once '../../models/managers/filiere.manager.php';
include_once '../../models/managers/etudiant.manager.php';
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

	public function showAllFiliereByIdProfesseur($id_professeur)
	{
		$listefiliere = $this->filieremanager->getAllFilieresByIdPorfesseur($id_professeur);
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
		                  <p><strong class=\"colored\">Description : </strong>".$filiere->getDescription()."</p>
		                </div>

		              </div>
		              <div class=\"task-footer\">
		                <div class=\"pull-right\">
		                  <ul class=\"footer-icons-group\">
		                    <li><a href=\"afficherFiliere.controller.php?id_filiere=".$filiere->getId()."\"><i class=\"fa fa-archive\"></i> Afficher</a></li>		                  </ul>
		                </div>
		            </div>
		        </section>";
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
		return "<div class=\"col-sm-6\">
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
                  <thead><tr><th>#</th><th>Nom</th><th>Prénom</th><th>Email</th><th>CIN</th>
                    </tr></thead><tbody>";
            $i = 1;
            foreach ($liste as $etudiant) 
            {
            	echo "<tr><td>".$i."</td><td>".$etudiant->getNom()."</td><td>".$etudiant->getPrenom()."</td><td>".$etudiant->getEmail()."</td><td>".$etudiant->getCIN()."</td></tr>";
            	$i++;
            }
            echo "</tbody></table>";
        }
	}

	public function printFiliereModuleBySemstre($id_filiere,$id_professeur)
	{
		$liste = $this->filieremanager->getModuleByIdFiliereAndProfesseur($id_filiere,$id_professeur);
		echo "<div class=\"col-lg-6\">
            <section class=\"panel default blue_title h2\">
              <div class=\"panel-heading\">Liste de mes modules</div>
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
                      <th>#</th><th>Module</th><th>Semestre</th>
                    </tr></thead><tbody>";
            $i = 1;
            foreach ($liste as $element) 
            {
            	echo "<tr><td>".$i."</td><td>".$element["intitule_module"]."</td><td>".$element["semestre"]."</td></tr>";
            }
            echo "</tbody></table>";
        }
        echo "</div></section></div>";
	}


	public function optionFiliere($id_professeur)
	{
		$listefiliere = $this->filieremanager->getAllFilieresByIdPorfesseur($id_professeur);
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
	
	public function sendMailToEtudiantsOfFiliere($id_filiere,$subject,$body,$from)
	{
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