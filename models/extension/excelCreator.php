<?php
include_once '../../library/PHPExcel/PHPExcel.php';
include_once '../../models/extension/autoCorrectionQcm.php';
include_once '../../models/extension/xmlReader.php';
class excelCreator
{
	private $objPHPExcel;
	private $id_examen;
	private $id_filiere;
	private $listeEtudiants;

	public function __construct($id_examen,$id_filiere,$listeEtudiants)
	{
		$this->objPHPExcel = new PHPExcel();
		$this->setId_examen($id_examen);
		$this->setId_filiere($id_filiere);
		$this->setListeEtudiants($listeEtudiants);
	}

	public function createFile()
	{
		$this->objPHPExcel->setActiveSheetIndex(0);
        $rowCount = 1;
        $results = $this->setFileContent();
        foreach ($results as $result) {
            $this->objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $result[0]);
            $this->objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $result[1]);
            $this->objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $result[2]);
            $rowCount++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($this->objPHPExcel);
        $objWriter->save('../../public/examens/'.$this->id_examen."-corr/correction-qcmfile.xlsx");
	}

	public function setFileContent()
	{
        $fileNameCorrection = getExamenCorrectionFiles($this->id_examen);
        $answers = getAnswersElement($this->id_examen,$fileNameCorrection["qcm"]);
        $i = 1;
        $table[0][0] = "Nom";
        $table[0][1] = "Prénom";
        $table[0][2] = "Note";
		foreach ($this->listeEtudiants as $etudiant) 
        {
            $table[$i][0] = $etudiant->getNom();
            $table[$i][1] = $etudiant->getPrenom();
            if ($this->passerExamen($this->id_examen,$etudiant->getId())) {
                $fileNameReponse = getExamenReponseFiles($this->id_examen,$etudiant->getId());
                $answersEtudiant = getEtudiantAnswers($this->id_examen,$etudiant->getId(),$fileNameReponse["qcm"]);
                $table[$i][2] = noteCalculator($answers,$answersEtudiant);
            } else {
                $table[$i][2] = 0;
            }
            $i++;
        }

        return $table;
	}

    public function passerExamen($id_examen,$id_etudiant)
    {
        if (file_exists($_SERVER['DOCUMENT_ROOT'].'/exam_ensak/public/examens/'.$id_examen.'-rep/'.$id_etudiant)) {
            return true;
        } else {
            return false;
        }
    }

    public function getObjPHPExcel()
    {
        return $this->objPHPExcel;
    }

    public function setObjPHPExcel($objPHPExcel)
    {
        $this->objPHPExcel = $objPHPExcel;
    }

    public function getId_examen()
    {
        return $this->id_examen;
    }

    public function setId_examen($id_examen)
    {
        $this->id_examen = $id_examen;
    }

    public function getId_filiere()
    {
        return $this->id_filiere;
    }

    public function setId_filiere($id_filiere)
    {
        $this->id_filiere = $id_filiere;
    }

    public function getListeEtudiants()
    {
        return $this->listeEtudiants;
    }

    public function setListeEtudiants($listeEtudiants)
    {
        $this->listeEtudiants = $listeEtudiants;
    }
}


?>
