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
	
	public function printFiliereModuleBySemstre($id_filiere,$semestre)
	{
		$listeModule = $this->modulemanager->getModulesByIdFiliereAndSemestre($id_filiere,"S".$semestre);

        if ($listeModule == null) 
        {
        	echo "<div class=\"bs-example\"><div class=\"alert alert-info fade in\">
		            <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
		            La liste est vide !!</div></div>";
        }
        else
        {
            foreach ($listeModule as $module) 
            {
            	echo $this->showModule($module);
            }
        }
	}

	public function showModule($module)
	{
		return "<section class=\"panel default red_border vertical_border h1\">
	              <div class=\"task-header red_task\">".$module->getIntitule()."</div>
	                <div class=\"row task_inner inner_padding\">
	                  <div class=\"col-sm-12\">
	                    <p><strong class=\"colored\">Description : </strong>".$module->getDescription()."</p>
	                  </div>
	                </div>
	            </section>";
	}
}
?>