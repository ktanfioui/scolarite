<?php
include_once '../../models/managers/annonce.manager.php';
class annonceModel
{

	private $annoncemanager;

	public function __construct($BDD)
	{
		$this->annoncemanager = new annonceManager($BDD);
	}
	
	public function getAnnonceById($id_annonce)
	{
		return $this->annoncemanager->getAnnonceById($id_annonce);
	}

	public function deleteAnnonceById($id_annonce)
	{
		return $this->annoncemanager->deleteAnnonce($id_annonce);
	}
	
	public function addNewAnnonce($annonce)
	{
		if (strcmp($annonce->getAnnonce(),"") == 0 || strcmp($annonce->getStatus(),"") == 0) 
		{
			return "Vous avez oublié un champ vide !!";
		}
		else if ($this->annoncemanager->addAnnonce($annonce) == true) 
		{
			return "Annonce ajoutée avec succés !!";
		}
		else
		{
			return "Impossible d'ajouter cette annonce !!";
		}
	}

	public function updateAnnonce($annonce)
	{
		if (strcmp($annonce->getAnnonce(),"") == 0 || strcmp($annonce->getStatus(),"") == 0) 
		{
			return "Vous avez oublié un champ vide !!";
		}
		else if ($this->annoncemanager->updateAnnonce($annonce) == true) 
		{
			return "Modification effectué avec succés !!";
		}
		else
		{
			return "Impossible de modifier l'annonce !!";
		}
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
	                  <div class=\"col-sm-12\">
	                    <p><strong class=\"colored\">Status : </strong>".$annonce->getStatus()."</p>
	                  </div>
	                </div>
	                <div class=\"task-footer\">
	                  <div class=\"pull-right\">
	                    <ul class=\"footer-icons-group\">
	                      <li><a href=\"updateAnnonce.controller.php?id_annonce=".$annonce->getId()."\"><i class=\"fa fa-pencil\"></i> Modifier</a></li>
	                      <li><a href=\"\" data-toggle=\"modal\" data-target=\"#annonce".$annonce->getId()."\"><i class=\"fa fa-trash-o\"></i> Supprimer</a></li>
	                    </ul>
	                  </div>
	                </div>
	            </section>";
	}

		public function deleteAnnonceModal()
	{
		$listeAnnonce = $this->annoncemanager->getAllAnnonces();
		if ($listeAnnonce != null)
		{
			foreach ($listeAnnonce as $element) 
			{
				echo "<div class=\"modal fade\" id=\"annonce".$element->getId()."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">
						  <div class=\"modal-dialog\" role=\"document\">
						    <div class=\"modal-content\">
						      <div class=\"modal-header\">
						        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
						        <h4 class=\"modal-title\" id=\"myModalLabel\">Supprimer Module</h4>
						      </div>
						      <div class=\"modal-body\">
						        Voulez-vous vraiment supprimer l'annonce ?
						      </div>
						      <div class=\"modal-footer\">
						        <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Non</button>
						        <a href=\"deleteAnnonce.controller.php?id=".$element->getId()."&type=annonce\" type=\"button\" class=\"btn btn-valider\">Oui</a>
						      </div>
						    </div>
						  </div>
						</div>";
			}
		}
	}

	
}
?>