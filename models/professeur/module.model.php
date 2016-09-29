<?php
include_once '../../models/managers/module.manager.php';

class moduleModel
{

	private $modulemanager;

	public function __construct($BDD)
	{
		$this->modulemanager = new moduleManager($BDD);
	}

	public function getModuleById($id_module)
	{
		return $this->modulemanager->getModuleById($id_module);
	}

	public function showAllModuleByIdProfesseur($id_professeur)
	{
		$listeModule = $this->modulemanager->getAllModulesByIdPorfesseur($id_professeur);
		if ($listeModule == null) 
		{
			return "<div class=\"col-lg-12\"><div class=\"bs-example\"><div class=\"alert alert-warning fade in\">
                    <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
                    La liste des Modules est vide !!</div></div></div>";
		}
		else
		{
			$i = 0;
			$print = "<div class=\"col-lg-6\">";
			foreach ($listeModule as $module)
			{
				if ($i == ceil(count($listeModule)/2)) 
				{
					$print .= "</div><div class=\"col-lg-6\">";
				}
				$print .= $this->showModule($module,$id_professeur);
				$i++;
			}
			$print .= "</div>";
			return $print;
		}
	}

	public function showModule($module,$id_professeur)
	{
		return "<section class=\"panel default red_border vertical_border h1\">
	              <div class=\"task-header red_task\">".$module->getIntitule()."</div>
	                <div class=\"row task_inner inner_padding\">
	                  <div class=\"col-sm-12\">
	                    <p><strong class=\"colored\">Description : </strong>".$module->getDescription()."</p>
	                  	".$this->printFiliereForModule($module->getId(),$id_professeur)."
	                  </div>
	                </div>
	            </section>";
	}

	public function printFiliereForModule($id_module,$id_professeur)
	{
		$liste = $this->modulemanager->getIntituleFiliereByIdModule($id_module,$id_professeur);

		$print = "<p><strong class=\"colored\">Filières : </strong></p>";
		foreach ($liste as $element) 
		{
			$print .= "<p>- ".$element['intitule_filiere']." (".$element['semestre'].")</p>";
		}
		return $print;
	}

	public function optionModule($id_professeur,$id_filiere)
	{
		$listemodule = $this->modulemanager->getAllModulesByIdPorfesseurIdFiliere($id_professeur,$id_filiere);
		echo "<div class=\"form-group\">
                  <label class=\"col-sm-4 control-label\">Module</label>
                  <div class=\"col-sm-8\">
                    <select class=\"form-control\" id=\"source\" name=\"optionModule\">";
        if ($listemodule == null) 
		{
			echo "<option value=\"null\"> La Liste est vide </option>";
		}
		else
		{
			echo "<option value=\"null\"> Choix </option>";
			foreach ($listemodule as $module) {
	        	echo "<option value=\"".$module->getId()."\">".$module->getIntitule()."</option>";
	        }
		}
        echo "</select></div></div>";     
	}
}
?>