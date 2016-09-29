<?php
class Filiere
{
	private $id;
	private $intitule;
	private $niveau;
	private $nbrModule;
	private $description;

	public function __construct($id,$intitule,$niveau,$nbrModule,$description)
	{
		$this->setId($id);
        $this->setIntitule($intitule);
        $this->setNiveau($niveau);
        $this->setNbrModule($nbrModule);
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

    public function getNiveau()
    {
        return $this->niveau;
    }

    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;
    }

    public function getNbrModule()
    {
        return $this->nbrModule;
    }

    public function setNbrModule($nbrModule)
    {
        $this->nbrModule = $nbrModule;
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