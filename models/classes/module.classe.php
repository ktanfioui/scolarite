<?php
class Module
{
	private $id;
	private $intitule;
	private $description;

	public function __construct($id,$intitule,$description)
	{
		$this->setId($id);
		$this->setIntitule($intitule);
		$this->setDescription($description);
	}

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIntitule()
    {
        return $this->intitule;
    }

    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
} 
?>