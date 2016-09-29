<?php
include_once '../../models/managers/examen.manager.php';
include_once '../../models/managers/module.manager.php';
include_once '../../models/managers/filiere.manager.php';
class examenModel
{

	private $examenmanager;
	private $filieremanager;
	private $modulemanager;

	public function __construct($BDD)
	{
		$this->examenmanager = new examenManager($BDD);
		$this->modulemanager = new moduleManager($BDD);
		$this->filieremanager = new filiereManager($BDD);
	}

	public function getExamenById($id_examen) 
	{
		return $this->examenmanager->getExamenById($id_examen);
	}

	public function addNewExamen($content,$id_professeur)
	{
		$print = "";
		if (strcmp($content["title"],"") == 0)
		{
			$print .= $this->erreurMessage("Vous devez spécifier un titre");
		}
		if (strcmp($content["optionModule"],"null") == 0)
		{
			$print .= $this->erreurMessage("Vous devez sélectionner un module pour l'examen");
		}
		if (strcmp($content["p_date"],"") == 0)
		{
			$print .= $this->erreurMessage("Vous devez spécifier la date de l'examen");
		}
		if (strcmp($content["heureControle"],"null") == 0 || strcmp($content["minuteControle"],"null") == 0)
		{
			$print .= $this->erreurMessage("Vous devez spécifier l'heure de l'examen");
		}
		if (strcmp($content["heureDuree"],"null") == 0 || strcmp($content["minuteDuree"],"null") == 0)
		{
			$print .= $this->erreurMessage("Vous devez spécifier la durée de l'examen");
		}
		if (strcmp($content["description"],"") == 0)
		{
			$print .= $this->erreurMessage("Vous devez spécifier une déscription");
		}
		if (!isset($content["isQCM"]) && !isset($content["isCoure"]) && !isset($content["isExercice"]))
		{
			$print .= $this->erreurMessage("Vous devez choisir au moins un élément pour le contenus de l'examen");
		}
		if (strcmp($print, "") == 0) 
		{
			$p_date = $content["p_date"]." ".$content["heureControle"].":".$content["minuteControle"].":00";
			$duree = $content["heureDuree"].":".$content["minuteDuree"].":00";
			$isQCM = isset($content["isQCM"]) == 1 ? 1 : 0;
			$isCoure = isset($content["isCoure"]) == 1 ? 1 : 0;
			$isExercice = isset($content["isExercice"]) == 1 ? 1 : 0;

			$examen = new Examen(0,$content["title"],$content["optionFiliere"],$content["optionModule"],$id_professeur,$p_date,$duree,$content["description"],0,$isQCM,$isCoure,$isExercice,0);
			if ($this->examenmanager->addExamen($examen) == true) 
			{
				$print = $this->warningMessage("Examen Ajout effectué avec succés !!");
			}
			else
			{
				$print = $this->warningMessage("Impossible d'ajouter l'examen !!");
			}
			
		}
		return $print;
	}

	public function updateExamenField($champ,$value,$id_examen)
	{
		$this->examenmanager->updateExamenField($champ,$value,$id_examen);
	}

	public function erreurMessage($message)
	{
		return "<div class=\"col-lg-12\"><div class=\"bs-example\"><div class=\"alert alert-danger fade in\">
                    <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
                    ".$message."</div></div></div>";
	}

	public function warningMessage($message)
	{
		return "<div class=\"col-lg-12\"><div class=\"bs-example\"><div class=\"alert alert-warning fade in\">
                    <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
                    ".$message."</div></div></div>";
	}

	public function showAllExamenByIdProfesseur($id_professeur)
	{
		$listeexamen = $this->examenmanager->getAllExamensByIdPorfesseur($id_professeur);
		if ($listeexamen == null) 
		{
			return "<div class=\"col-lg-12\"><div class=\"bs-example\"><div class=\"alert alert-warning fade in\">
                    <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
                    La liste des Examens est vide !!</div></div></div>";
		}
		else
		{
			$i = 0;
			$print = "<div class=\"col-lg-6\">";
			foreach ($listeexamen as $examen)
			{
				if ($i == ceil(count($listeexamen)/2)) 
				{
					$print .= "</div><div class=\"col-lg-6\">";
				}
				if ($examen->getIsCreated() == 0) 
				{
					if (!$this->fullCreated($examen)) 
					{
						$print .= $this->showExamenNotCreated($examen);
					}
					else
					{
						$print .= $this->showExamenCreated($examen);
					}
				} else {
					if ($this->testExamenRange($examen) == 2) {
						$print .= $this->showExamenPasser($examen);
					} else {
						$print .= $this->showExamenLancer($examen);
					}
				}
				
				
				$i++;
			}
			$print .= "</div>";
			return $print;
		}
	}
	
	public function testExamenRange($examen)
	{
		$examendate = new DateTime($examen->getP_date());
		$currentdate = new DateTime();
		$holder = explode(" ", $examen->getP_date());
		$hourHolder = $this->getHeur($holder[1]) + $this->getHeur($examen->getDuree());
		$minHolder = $this->getMin($holder[1]) + $this->getMin($examen->getDuree());
		$final = new DateTime($holder[0]." ".$hourHolder.":".$minHolder.":00");

		if ($examendate > $currentdate) {
			return 0;
		} 
		elseif ($final > $currentdate) 
		{
			return 1;
		}
		else
		{
			return 2;
		}
	}

	public function getHeur($time)
	{
		return intval(substr($time, 0, 2));
	}
	public function getMin($time)
	{
		return intval(substr($time, 3, 2));
	}
	public function getSec($time)
	{
		return intval(substr($time, 6, 2));
	}

	public function fullCreated($examen)
	{
		$states = $this->examenmanager->getCreationStates($examen->getId());
		if ($examen->getIsQCM() == $states['qcm'] && $examen->getIsCoure() == $states['cours'] && $examen->getIsExercice() == $states['exercices']) {
			return true;
		}
		else {
			return false;
		}
	}

	public function showExamenNotCreated($examen)
	{
		return "<section class=\"panel default red_border vertical_border h1\">
		            <div class=\"task-header red_task\">".$examen->getTitle()."</div>
		              <div class=\"row task_inner inner_padding\">
		                <div class=\"col-sm-8\">
		                  	<p><strong class=\"colored\">Filière : </strong>".$this->filieremanager->getFiliereById($examen->getId_filiere())->getIntitule()."</p>
		                  	<p><strong class=\"colored\">Module : </strong>".$this->modulemanager->getModuleById($examen->getId_module())->getIntitule()."</p>
		                	<p><strong class=\"colored\">Date : </strong>".$examen->getP_date()."</p>
		                	<p><strong class=\"colored\">Durée : </strong>".$examen->getDuree()."</p>
		                	<p><strong class=\"colored\">Déscription : </strong>".$examen->getDescription()."</p>
		                </div>
		                <div class=\"col-sm-4\"><h5 class=\"header-bg\">Contenu</h5>".$this->showExamenContenu($examen)."</div>
		              </div>
		              <div class=\"task-footer\">
		                <div class=\"pull-right\">
		                  <ul class=\"footer-icons-group\">
		                  	<li><a href=\"creationExamenPartie.controller.php?id_examen=".$examen->getId()."\"><i class=\"fa fa-gears\"></i> Créer</a></li>
		                    <li><a href=\"\" data-toggle=\"modal\" data-target=\"#examen".$examen->getId()."\"><i class=\"fa fa-trash-o\"></i> Supprimer</a></li>	                  
		                   </ul>
		                </div>
		              </div>
		        </section>";
	}

	public function showExamenCreated($examen)
	{
		return "<section class=\"panel default red_border vertical_border h1\">
		            <div class=\"task-header red_task\">".$examen->getTitle()."</div>
		              <div class=\"row task_inner inner_padding\">
		                <div class=\"col-sm-8\">
		                  	<p><strong class=\"colored\">Filière : </strong>".$this->filieremanager->getFiliereById($examen->getId_filiere())->getIntitule()."</p>
		                  	<p><strong class=\"colored\">Module : </strong>".$this->modulemanager->getModuleById($examen->getId_module())->getIntitule()."</p>
		                	<p><strong class=\"colored\">Date : </strong>".$examen->getP_date()."</p>
		                	<p><strong class=\"colored\">Durée : </strong>".$examen->getDuree()."</p>
		                	<p><strong class=\"colored\">Déscription : </strong>".$examen->getDescription()."</p>
		                </div>
		                <div class=\"col-sm-4\"><h5 class=\"header-bg\">Contenu</h5>".$this->showExamenContenu($examen)."</div>
		              </div>
		              <div class=\"task-footer\">
		                <div class=\"pull-right\">
		                  <ul class=\"footer-icons-group\">
		                  	<li><a href=\"actionsExamen.controller.php?id_examen=".$examen->getId()."&type=lancer\"><i class=\"fa fa-check\"></i> Lancer</a></li>
		                  	<li><a href=\"afficherExamen.controller.php?id_examen=".$examen->getId()."\"><i class=\"fa fa-folder\"></i> Afficher</a></li>
		                  	<li><a href=\"correctionExamenPartie.controller.php?id_examen=".$examen->getId()."\"><i class=\"fa fa-file-text\"></i> Correction</a></li>       
		                   	<li><a href=\"\" data-toggle=\"modal\" data-target=\"#examen".$examen->getId()."\"><i class=\"fa fa-trash-o\"></i> Supprimer</a></li>
		                   </ul>
		                </div>
		              </div>
		        </section>";
	}

	public function showExamenLancer($examen)
	{
		return "<section class=\"panel default red_border vertical_border h1\">
		            <div class=\"task-header red_task\">".$examen->getTitle()."</div>
		              <div class=\"row task_inner inner_padding\">
		                <div class=\"col-sm-8\">
		                  	<p><strong class=\"colored\">Filière : </strong>".$this->filieremanager->getFiliereById($examen->getId_filiere())->getIntitule()."</p>
		                  	<p><strong class=\"colored\">Module : </strong>".$this->modulemanager->getModuleById($examen->getId_module())->getIntitule()."</p>
		                	<p><strong class=\"colored\">Date : </strong>".$examen->getP_date()."</p>
		                	<p><strong class=\"colored\">Durée : </strong>".$examen->getDuree()."</p>
		                	<p><strong class=\"colored\">Déscription : </strong>".$examen->getDescription()."</p>
		                </div>
		                <div class=\"col-sm-4\"><h5 class=\"header-bg\">Contenu</h5>".$this->showExamenContenu($examen)."</div>
		              </div>
		              <div class=\"task-footer\">
		                <div class=\"pull-right\">
		                  <ul class=\"footer-icons-group\">
		                  	<li><a href=\"afficherExamen.controller.php?id_examen=".$examen->getId()."\"><i class=\"fa fa-folder\"></i> Afficher</a></li>
		                  	<li><a href=\"correctionExamenPartie.controller.php?id_examen=".$examen->getId()."\"><i class=\"fa fa-file-text\"></i> Correction</a></li>             
		                   	<li><a href=\"actionsExamen.controller.php?id_examen=".$examen->getId()."&type=annuler\"><i class=\"fa fa-undo\"></i> Annuler</a></li>
		                   </ul>
		                </div>
		              </div>
		        </section>";
	}

	public function showExamenPasser($examen)
	{
		return "<section class=\"panel default red_border vertical_border h1\">
		            <div class=\"task-header red_task\">".$examen->getTitle()."</div>
		              <div class=\"row task_inner inner_padding\">
		                <div class=\"col-sm-8\">
		                  	<p><strong class=\"colored\">Filière : </strong>".$this->filieremanager->getFiliereById($examen->getId_filiere())->getIntitule()."</p>
		                  	<p><strong class=\"colored\">Module : </strong>".$this->modulemanager->getModuleById($examen->getId_module())->getIntitule()."</p>
		                	<p><strong class=\"colored\">Date : </strong>".$examen->getP_date()."</p>
		                	<p><strong class=\"colored\">Durée : </strong>".$examen->getDuree()."</p>
		                	<p><strong class=\"colored\">Déscription : </strong>".$examen->getDescription()."</p>
		                </div>
		                <div class=\"col-sm-4\"><h5 class=\"header-bg\">Contenu</h5>".$this->showExamenContenu($examen)."</div>
		              </div>
		              <div class=\"task-footer\">
		                <div class=\"pull-right\">
		                  <ul class=\"footer-icons-group\">
		                  	<li><a href=\"afficherExamen.controller.php?id_examen=".$examen->getId()."\"><i class=\"fa fa-folder\"></i> Afficher</a></li>
		                  	<li><a href=\"correctionExamenPartie.controller.php?id_examen=".$examen->getId()."\"><i class=\"fa fa-file-text\"></i> Correction</a></li>
		                  	<li><a href=\"listeReponsesExamen.controller.php?id_examen=".$examen->getId()."&id_filiere=".$examen->getId_filiere()."\"><i class=\"fa fa-list\"></i> Liste des réponses</a></li>
		                   </ul>
		                </div>
		              </div>
		        </section>";
	}

	public function showExamenContenu($examen)
	{
		$print = "";
		$states = $this->getCreationStates($examen->getId());
		$correction = $this->getCorrectionStates($examen->getId());
		if ($examen->getIsQCM() == 1) 
		{
			$print .= "<p>Une Partie : QCM ";
			if ($states['qcm'] == 1) 
			{
				$print .= "<i class=\"fa fa-check-circle colored\"></i>";
			}
			if ($correction['qcm'] == 1) {
				$print .= "<i class=\"fa fa-file-text colored\"></i>";
			}
			$print .= "</p>";
		}
		if ($examen->getIsCoure() == 1) 
		{
			$print .= "<p>Une Partie : Questions de Cours ";
			if ($states['cours'] == 1) 
			{
				$print .= "<i class=\"fa fa-check-circle colored\"></i>";
			}
			if ($correction['cours'] == 1) {
				$print .= "<i class=\"fa fa-file-text colored\"></i>";
			}
			$print .= "</p>";
		}
		if ($examen->getIsExercice() == 1) 
		{
			$print .= "<p>Une Partie : Exercices ";
			if ($states['exercices'] == 1) 
			{
				$print .= "<i class=\"fa fa-check-circle colored\"></i>";
			}
			if ($correction['exercices'] == 1) {
				$print .= "<i class=\"fa fa-file-text colored\"></i>";
			}
			$print .= "</p>";
		}
		return $print;
	}


	public function updateCreationState($champ,$id_examen)
	{
		$this->examenmanager->updateCreationState($champ,$id_examen);
	}

	public function getCreationStates($id_examen)
	{
		return $this->examenmanager->getCreationStates($id_examen);
	}

	public function createCreationStates($id_examen)
	{
		$this->examenmanager->createCreationStates($id_examen);
	}

	public function deleteExamenById($id_examen)
	{
		$this->examenmanager->deleteCorrectionStates($id_examen);
		$this->examenmanager->deleteExamenStates($id_examen);
		$this->examenmanager->deleteExamenById($id_examen);
	}

	public function deleteExamenModal($id_professeur)
	{
		$listeExamen = $this->examenmanager->getAllExamensByIdPorfesseur($id_professeur);
		if ($listeExamen != null)
		{
			foreach ($listeExamen as $element) 
			{
				echo "<div class=\"modal fade\" id=\"examen".$element->getId()."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">
						  <div class=\"modal-dialog\" role=\"document\">
						    <div class=\"modal-content\">
						      <div class=\"modal-header\">
						        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
						        <h4 class=\"modal-title\" id=\"myModalLabel\">Supprimer Module</h4>
						      </div>
						      <div class=\"modal-body\">
						        Voulez-vous vraiment supprimer l'examen ".$element->getTitle()."
						      </div>
						      <div class=\"modal-footer\">
						        <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Non</button>
						        <a href=\"actionsExamen.controller.php?id_examen=".$element->getId()."&type=delete\" type=\"button\" class=\"btn btn-valider\">Oui</a>
						      </div>
						    </div>
						  </div>
						</div>";
			}
		}
	}

	public function updateCorrectionState($champ,$id_examen)
	{
		$this->examenmanager->updateCorrectionState($champ,$id_examen);
	}

	public function getCorrectionStates($id_examen)
	{
		return $this->examenmanager->getCorrectionStates($id_examen);
	}

	public function createCorrectionStates($id_examen)
	{
		$this->examenmanager->createCorrectionStates($id_examen);
	}
}
?>