<?php

include_once '../../models/managers/examen.manager.php';
include_once '../../models/managers/module.manager.php';
include_once '../../models/managers/filiere.manager.php';
class examenModel
{

	private $examenmanager;
	private $modulemanager;
	private $filieremanager;

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


	public function getExamenByIdFiliereForCalendar($id_filiere)
	{
		if ($id_filiere != "null") {
			$listeExamen = $this->examenmanager->getExamenByIdFiliere($id_filiere);
		} else {
			$listeExamen = $this->examenmanager->getAllExamen();
		}

		foreach ($listeExamen as $examen) 
		{
			$title = $examen->getTitle()."\nFilière : ".$this->filieremanager->getFiliereById($examen->getId_filiere())->getIntitule()."\nModule : ".$this->modulemanager->getModuleById($examen->getId_module())->getIntitule()."\nà partir de ".substr($examen->getP_date(), 10, 6)."\nDurée ".substr($examen->getDuree(), 0, 5);
			$tab[] = array('title' => $title,
						 'start' => $examen->getP_date());
		}
		return $tab;
	}

	public function getExamenByIdFiliere($id_filiere)
	{
		if ($id_filiere != "null") {
			$listeExamen = $this->examenmanager->getExamenByIdFiliere($id_filiere);
		} else {
			$listeExamen = $this->examenmanager->getAllExamen();
		}
		
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
				$print .= $this->showExamen($examen);

				$i++;
			}
			$print .= "</div>";
			return $print;
		}
	}

	
	public function showExamen($examen)
	{
		return "<section class=\"panel default red_border vertical_border h1\">
		            <div class=\"task-header red_task\">".$examen->getTitle()."</div>
		              <div class=\"row task_inner inner_padding\">
		                <div class=\"col-sm-6\">
		                	<p><strong class=\"colored\">Filière : </strong>".$this->filieremanager->getFiliereById($examen->getId_filiere())->getIntitule()."</p>
		                  	<p><strong class=\"colored\">Module : </strong>".$this->modulemanager->getModuleById($examen->getId_module())->getIntitule()."</p>
		                	<p><strong class=\"colored\">Date : </strong>".$examen->getP_date()."</p>
		                	<p><strong class=\"colored\">Durée : </strong>".$examen->getDuree()."</p>
		                	<p><strong class=\"colored\">Déscription : </strong>".$examen->getDescription()."</p>
		                </div>
		                <div class=\"col-sm-6\"><h5 class=\"header-bg\">Contenu</h5>".$this->showExamenContenu($examen)."</div>
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


}
?>