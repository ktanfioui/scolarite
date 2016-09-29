<?php

include_once '../../models/managers/examen.manager.php';
include_once '../../models/managers/module.manager.php';

class examenModel
{

	private $examenmanager;
	private $modulemanager;

	public function __construct($BDD)
	{
		$this->examenmanager = new examenManager($BDD);
		$this->modulemanager = new moduleManager($BDD);
	}

	public function getExamenById($id_examen) 
	{
		return $this->examenmanager->getExamenById($id_examen);
	}


	public function getExamenByIdFiliereForCalendar($id_filiere)
	{
		$listeExamen = $this->examenmanager->getExamenByIdFiliere($id_filiere);
		foreach ($listeExamen as $examen) 
		{
			$title = $examen->getTitle()."\nModule : ".$this->modulemanager->getModuleById($examen->getId_module())->getIntitule()."\nà partir de ".substr($examen->getP_date(), 10, 6)."\nDurée ".substr($examen->getDuree(), 0, 5);
			$tab[] = array('title' => $title,
						 'start' => $examen->getP_date());
		}
		return $tab;
	}

	public function getExamenByIdFiliere($id_filiere)
	{
		$listeExamen =  $this->examenmanager->getExamenByIdFiliere($id_filiere);
		if ($listeExamen == null) 
		{
			return "<div class=\"col-lg-12\"><div class=\"bs-example\"><div class=\"alert alert-warning fade in\">
                    <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
                    Aucun Examen pour le moment !!</div></div></div>";
		}
		else
		{
			$i = 0;
			$print = "<div class=\"col-lg-6\">";
			foreach ($listeExamen as $examen)
			{
				if ($i == ceil(count($listeExamen)/2))
				{
					$print .= "</div><div class=\"col-lg-6\">";
				}
				$post = $this->testExamenRange($examen);
				if ($post == 0) {
					$print .= $this->showExamen($examen);
				} elseif ($post == 1) {
					$print .= $this->showExamenInRange($examen);
				} elseif ($post == 2) {
					$print .= $this->showExamenAfterRange($examen);
				}
				
				$i++;
			}
			$print .= "</div>";
			return $print;
		}
	}

	public function getExamenTimeLeft($examen)
	{
		$holder = explode(" ", $examen->getP_date());
		$hourHolder = $this->getHeur($holder[1]) + $this->getHeur($examen->getDuree())+1;
		$minHolder = $this->getMin($holder[1]) + $this->getMin($examen->getDuree());
		$timer = str_replace("-","/",$holder[0])." ".$hourHolder.":".$minHolder.":00";
		return $timer;
	}
	public function getExamenTimeLeftInSeconds($examen)
	{
		$end = new DateTime($this->getExamenTimeLeft($examen));
		$currentdate = new DateTime();
		$interval = $end->diff($currentdate);
		return (($interval->h - 1) * 360 + $interval->i * 60 + $interval->s)*1000;
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

	public function showExamen($examen)
	{
		return "<section class=\"panel default red_border vertical_border h1\">
		            <div class=\"task-header red_task\">".$examen->getTitle()."</div>
		            <div class=\"row task_inner inner_padding\">
		                <div class=\"col-sm-6\">
		                  	<p><strong class=\"colored\">Module : </strong>".$this->modulemanager->getModuleById($examen->getId_module())->getIntitule()."</p>
		                	<p><strong class=\"colored\">Date : </strong>".$examen->getP_date()."</p>
		                	<p><strong class=\"colored\">Durée : </strong>".$examen->getDuree()."</p>
		                	<p><strong class=\"colored\">Déscription : </strong>".$examen->getDescription()."</p>
		                </div>
		                <div class=\"col-sm-6\"><h5 class=\"header-bg\">Contenu</h5>".$this->showExamenContenu($examen)."</div>
		            </div>
		        </section>";
	}

	public function showExamenInRange($examen)
	{
		return "<section class=\"panel default red_border vertical_border h1\">
		            <div class=\"task-header red_task\">".$examen->getTitle()."</div>
		            <div class=\"row task_inner inner_padding\">
		                <div class=\"col-sm-6\">
		                  	<p><strong class=\"colored\">Module : </strong>".$this->modulemanager->getModuleById($examen->getId_module())->getIntitule()."</p>
		                	<p><strong class=\"colored\">Date : </strong>".$examen->getP_date()."</p>
		                	<p><strong class=\"colored\">Durée : </strong>".$examen->getDuree()."</p>
		                	<p><strong class=\"colored\">Déscription : </strong>".$examen->getDescription()."</p>
		                </div>
		                <div class=\"col-sm-6\"><h5 class=\"header-bg\">Contenu</h5>".$this->showExamenContenu($examen)."</div>
		              </div>
		              <div class=\"task-footer\">
		                <div class=\"pull-right\">
		                  <ul class=\"footer-icons-group\">
		                  	<li><a href=\"passerExamen.controller.php?id_examen=".$examen->getId()."\"><i class=\"fa fa-check\"></i> Commencer</a></li>
		                   </ul>
		                </div>
		              </div>
		            </div>
		        </section>";
	}

	public function showExamenAfterRange($examen)
	{
		return "<section class=\"panel default red_border vertical_border h1\">
		            <div class=\"task-header red_task\">".$examen->getTitle()."</div>
		              <div class=\"row task_inner inner_padding\">
		                <div class=\"col-sm-6\">
		                  	<p><strong class=\"colored\">Module : </strong>".$this->modulemanager->getModuleById($examen->getId_module())->getIntitule()."</p>
		                	<p><strong class=\"colored\">Date : </strong>".$examen->getP_date()."</p>
		                	<p><strong class=\"colored\">Durée : </strong>".$examen->getDuree()."</p>
		                	<p><strong class=\"colored\">Déscription : </strong>".$examen->getDescription()."</p>
		                </div>
		                <div class=\"col-sm-6\"><h5 class=\"header-bg\">Contenu</h5>".$this->showExamenContenu($examen)."</div>
		              </div>
		              <div class=\"task-footer\">
		                <div class=\"pull-right\">
		                  <ul class=\"footer-icons-group\">
		                  	<li><a href=\"afficherExamen.controller.php?id_examen=".$examen->getId()."\"><i class=\"fa fa-folder\"></i> Afficher</a></li>
		                  	<li><a href=\"afficherCorrectionExamen.controller.php?id_examen=".$examen->getId()."\"><i class=\"fa fa-file-text\"></i> Correction</a></li>
		                  	<li><a href=\"afficherReponseExamen.controller.php?id_examen=".$examen->getId()."\"><i class=\"fa fa-thumb-tack\"></i> Réponse</a></li>
		                   </ul>
		                </div>
		              </div>
		            </div>
		        </section>";
	}

	public function showExamenContenu($examen)
	{
		$print = "";
		if ($examen->getIsQCM() == 1) 
		{
			$print .= "<p>Une Partie : QCM ";
			$print .= "</p>";
		}
		if ($examen->getIsCoure() == 1) 
		{
			$print .= "<p>Une Partie : Questions de Cours ";
			$print .= "</p>";
		}
		if ($examen->getIsExercice() == 1) 
		{
			$print .= "<p>Une Partie : Exercices ";
			$print .= "</p>";
		}
		return $print;
	}

	public function createHiddenInputs($nbr,$value)
	{
		echo "<input type=\"hidden\" name=\"nbrQuestion_".$value."\" id=\"nbrQuestion_".$value."\" value=\"".$nbr."\">";
		for ($i=1; $i <= $nbr ; $i++) { 
			echo "<textarea class=\"hide\" name=\"question_".$value."_".$i."\" id=\"".$value."".$i."\"></textarea>";
		}
	}

}
?>