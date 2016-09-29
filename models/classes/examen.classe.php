<?php
class Examen
{
	private $id;
	private $title;
    private $id_filiere;
    private $id_module;
    private $id_professeur;
    private $p_date;
    private $duree;
    private $description;
    private $isCreated;
    private $isQCM;
    private $isCoure;
    private $isExercice;
    private $isCorrection;
    
	public function __construct($id,$title,$id_filiere,$id_module,$id_professeur,$p_date,$duree,$description,$isCreated,$isQCM,$isCoure,$isExercice,$isCorrection)
	{
		$this->setId($id);
        $this->setTitle($title);
        $this->setId_filiere($id_filiere);
        $this->setId_module($id_module);
        $this->setId_professeur($id_professeur);
        $this->setP_date($p_date);
        $this->setDuree($duree);
        $this->setDescription($description);
        $this->setIsCreated($isCreated);
        $this->setIsQCM($isQCM);
        $this->setIsCoure($isCoure);
        $this->setIsExercice($isExercice);
        $this->setIsCorrection($isCorrection);
	}

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getId_filiere()
    {
        return $this->id_filiere;
    }

    public function setId_filiere($id_filiere)
    {
        $this->id_filiere = $id_filiere;
    }

    public function getId_module()
    {
        return $this->id_module;
    }

    public function setId_module($id_module)
    {
        $this->id_module = $id_module;
    }

    public function getId_professeur()
    {
        return $this->id_professeur;
    }

    public function setId_professeur($id_professeur)
    {
        $this->id_professeur = $id_professeur;
    }

    public function getP_date()
    {
        return $this->p_date;
    }

    public function setP_date($p_date)
    {
        $this->p_date = $p_date;
    }

    public function getDuree()
    {
        return $this->duree;
    }

    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getIsCreated()
    {
        return $this->isCreated;
    }

    public function setIsCreated($isCreated)
    {
        $this->isCreated = $isCreated;
    }

    public function getIsQCM()
    {
        return $this->isQCM;
    }

    public function setIsQCM($isQCM)
    {
        $this->isQCM = $isQCM;
    }

    public function getIsCoure()
    {
        return $this->isCoure;
    }

    public function setIsCoure($isCoure)
    {
        $this->isCoure = $isCoure;
    }

    public function getIsExercice()
    {
        return $this->isExercice;
    }

    public function setIsExercice($isExercice)
    {
        $this->isExercice = $isExercice;

        return $this;
    }

    public function getIsCorrection()
    {
        return $this->isCorrection;
    }

    public function setIsCorrection($isCorrection)
    {
        $this->isCorrection = $isCorrection;
    }
} 
?>