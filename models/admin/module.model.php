<?php
include_once '../../models/managers/module.manager.php';
include_once '../../models/managers/filiere.manager.php';
class moduleModel
{

	private $modulemanager;
	private $filieremanger;

	public function __construct($BDD)
	{
		$this->modulemanager = new moduleManager($BDD);
		$this->filieremanger = new filiereManager($BDD);
	}

	public function getModuleById($id_module)
	{
		return $this->modulemanager->getModuleById($id_module);
	}

	public function deleteModuleById($id_module)
	{
		return $this->modulemanager->deleteModule($id_module);
	}

	public function deleteLinkModule($id_module,$id_filiere,$id_professeur) {
		return $this->modulemanager->deleteLinkModule($id_module,$id_filiere,$id_professeur);
	}
	
	public function addNewModule($module)
	{
		if (strcmp($module->getIntitule(),"") == 0 || strcmp($module->getDescription(),"") == 0) 
		{
			return "Vous avez oublié un champ vide !!";
		}
		else if ($this->modulemanager->addModule($module) == true) 
		{
			return "Module Ajout effectué avec succés !!";
		}
		else
		{
			return "Impossible d'ajouter le Module !!";
		}
	}

	public function updateModule($module)
	{
		if (strcmp($module->getIntitule(),"") == 0 || strcmp($module->getDescription(),"") == 0) 
		{
			return "Vous avez oublié un champ vide !!";
		}
		else if ($this->modulemanager->updateModule($module) == true) 
		{
			return "Modification effectué avec succés !!";
		}
		else
		{
			return "Impossible de modifier le Module !!";
		}
	}

	public function showAllModule()
	{
		$listeModule = $this->modulemanager->getAllModules();
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
				$print .= $this->showModule($module);
				$i++;
			}
			$print .= "</div>";
			return $print;
		}
	}

	public function showModule($module)
	{
		return "<section class=\"panel default red_border vertical_border h1\">
	              	<div class=\"task-header red_task\">".$module->getIntitule()."</div>
	                <div class=\"row task_inner inner_padding\">
	                  <div class=\"col-sm-12\">
	                    <p><strong class=\"colored\">Description : </strong>".$module->getDescription()."</p>
	                  	".$this->showModuleLinks($module->getId())."
	                  </div>
	                </div>
	                <div class=\"task-footer\">
	                  <div class=\"pull-right\">
	                    <ul class=\"footer-icons-group\">
	                      <li><a href=\"lierModule.controller.php?id_module=".$module->getId()."\"><i class=\"fa fa-link\"></i> Lier</a></li>
	                      <li><a href=\"updateModule.controller.php?id_module=".$module->getId()."\"><i class=\"fa fa-pencil\"></i> Modifier</a></li>
	                      <li><a href=\"\" data-toggle=\"modal\" data-target=\"#module".$module->getId()."\"><i class=\"fa fa-trash-o\"></i> Supprimer</a></li>
	                    </ul>
	                  </div>
	                </div>
	            </section>";
	}

	public function showModuleLinks($id_module)
	{
		$liste = $this->modulemanager->getFiliereProfesseurByIdModule($id_module);
		if ($liste == null) 
		{
			return "<div class=\"bs-example\"><div class=\"alert alert-info fade in\">
                    <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
                    Pas de lien pour ce module !!</div></div>";
		}
		else
		{
			$print = "<table class=\"table table-bordered table-linkmodule\"><thead>
	          <tr><th>Semestre</th><th>Filière</th><th>Professeur</th><th>Options</th></tr></thead>
	          <tbody>";
	          foreach ($liste as $element)
	          {
	          	$print .= "<tr><th>".$element["semestre"]."</th><th>".$element["intitule_filiere"]."</th><th>".$element["nom_prof"]."</th><th><a href=\"delete.controller.php?linkmodule=".$element['id_module']."-".$element['id_filiere']."-".$element['id_professeur']."&type=linkmodule\" type=\"button\" class=\"btn btn-valider\">Supprimer</a></th></tr>";
	          }
	    	$print .= "</tbody></table>";
	    	return $print;
		}
		
	}

	public function linkModule($id_module,$id_filiere,$id_professeur,$semestre)
	{
		$filiere = $this->filieremanger->getFiliereById($id_filiere);
		if (strcmp($id_module,"null") == 0 || strcmp($id_filiere,"null") == 0 || strcmp($id_professeur,"null") == 0 || strcmp($semestre,"null") == 0) 
		{
			return "Vous avez oublié de selectioner un champ";
		}
		elseif ($this->modulemanager->countModuleForFiliere($id_filiere) >= $filiere->getNbrModule()) {
			return "Impossible, la Filière est saturée";
		}
		elseif ($this->modulemanager->getLinkModule($id_module,$id_filiere,$id_professeur) == true) {
			return "Impossible, la liaison existe déjà";
		}
		elseif ($this->modulemanager->linkModule($id_module,$id_filiere,$id_professeur,$semestre) == true) 
		{
			return "Liaison effectué avec succés !!";
		}
		else
		{
			return "Impossible de lier le Module !!";
		}
	}

	public function showIntituleModule($id_module)
	{
		$module = $this->modulemanager->getModuleById($id_module);
		echo $module->getIntitule();
	}

	public function deleteModuleModal()
	{
		$listeModule = $this->modulemanager->getAllModules();
		if ($listeModule != null)
		{
			foreach ($listeModule as $element) 
			{
				echo "<div class=\"modal fade\" id=\"module".$element->getId()."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">
						  <div class=\"modal-dialog\" role=\"document\">
						    <div class=\"modal-content\">
						      <div class=\"modal-header\">
						        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
						        <h4 class=\"modal-title\" id=\"myModalLabel\">Supprimer Module</h4>
						      </div>
						      <div class=\"modal-body\">
						        Voulez-vous vraiment supprimer le module ".$element->getIntitule()."
						      </div>
						      <div class=\"modal-footer\">
						        <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Non</button>
						        <a href=\"delete.controller.php?id=".$element->getId()."&type=module\" type=\"button\" class=\"btn btn-valider\">Oui</a>
						      </div>
						    </div>
						  </div>
						</div>";
			}
		}
	}
}
?>