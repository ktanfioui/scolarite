<?php
include_once '../../models/classes/annonce.classe.php';
class annonceManager
{
	private $db;

	public function __construct($BDD)
	{
		$this->db = $BDD;
	}
	
	public function getAnnonceById($id_annonce)
	{
		$sql = "SELECT * FROM annonce WHERE id = $id_annonce";
		$qry = $this->db->prepare($sql);
		$qry->execute();
		$element = $qry->fetch(PDO::FETCH_ASSOC);
		
		if(empty($element))
			return null;
		else
			return new Annonce($element['id'],$element['annonce'],$element['status']);
	}


	public function addAnnonce($annonce)
	{
		$sql = 'INSERT INTO annonce (annonce,status) VALUES (:annonce,:status)';
		$qry = $this->db->prepare($sql);
		$qry->bindValue(':annonce', $annonce->getAnnonce());
		$qry->bindValue(':status', $annonce->getStatus());
		return $qry->execute();
	}
	
			  
    public function updateNotif()
	{
		$sql = "UPDATE annonce SET status='read'";
	          $result = $this->db->query($sql);
			  
	}

	public function updateAnnonce($annonce)
	{
		$sql = 'UPDATE annonce SET annonce=:annonce, status=:status WHERE id = :id';
		$qry = $this->db->prepare($sql);
		$qry->bindValue(':id', $annonce->getId());
		$qry->bindValue(':annonce', $annonce->getAnnonce());
		$qry->bindValue(':status', $annonce->getStatus());
		return $qry->execute();
	}

	public function deleteAnnonce($id_annonce)
	{
		$sql = "DELETE FROM annonce WHERE id = $id_annonce";
		$qry = $this->db->prepare($sql);
		$qry->execute();
	}

	public function getAllAnnonces()
	{
		$sql = "SELECT * FROM annonce";
		$qry = $this->db->prepare($sql);
		$qry->execute();

		while($element = $qry->fetch(PDO::FETCH_ASSOC))
		{
			$annonces[] = new Annonce($element['id'],$element['annonce'],$element['status']);
		}

		if(empty($annonces))
			return null;
		else
			return $annonces;
	}

	public function countAnnonce()
	{
		 $sql = "SELECT * from annonce where status = 'unread'";
       $result = $this->db->query($sql);
       $row = $result->fetch_assoc();
       $count = $result->num_rows;
       echo $count;
	   return $count;
	}
}
?>