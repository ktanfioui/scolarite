<?php
include_once '../../models/managers/annonce.manager.php';
class notificationModel
{

	private $annoncemanager;

	public function __construct($BDD)
	{
		$this->annoncemanager = new annonceManager($BDD);
	}
	
	public function showAllAnnonce()
	{
		$listeAnnonce = $this->annoncemanager->getAllAnnonces();
		if ($listeAnnonce == null) 
		{
			return "<div class=\"col-lg-12\"><div class=\"bs-example\"><div class=\"alert alert-warning fade in\">
                    <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
                    La liste des Annonces est vide !!</div></div></div>";
		}
		else
		{
			$i = 0;
			$print = "<div class=\"col-lg-6\">";
			foreach ($listeAnnonce as $annonce)
			{
				if ($i == ceil(count($listeAnnonce)/2)) 
				{
					$print .= "</div><div class=\"col-lg-6\">";
				}
				$print .= $this->showAnnonce($annonce);
				$i++;
			}
			$print .= "</div>";
			return $print;
		}
	}
	
	public function showAnnonce($annonce)
	{
		return "<section class=\"panel default red_border vertical_border h1\">
	              	<div class=\"task-header red_task\">".$annonce->getAnnonce()."</div>
	                <div class=\"row task_inner inner_padding\">
	                 
	                </div>
	             
	            </section>";
	}
   public function updateNotif()
	{
		return $this->annoncemanager->updateNotif();
			  
	}



	
}
?>