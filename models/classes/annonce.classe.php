<?php
class Annonce
{
	private $id;
	private $annonce;
	private $status;

	public function __construct($id,$annonce,$status)
	{
		$this->setId($id);
		$this->setAnnonce($annonce);
		$this->setStatus($status);
	}

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getAnnonce()
    {
        return $this->annonce;
    }

    public function setAnnonce($annonce)
    {
        $this->annonce = $annonce;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
} 
?>