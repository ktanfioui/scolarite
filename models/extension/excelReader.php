<?php
include_once '../../library/PHPExcel/PHPExcel/IOFactory.php';

class ExcelReader
{
	private $inputFileName;
	private $objPHPExcel;

	public function __construct($inputFileName)
	{
		$this->setInputFileName($inputFileName);
	}

	public function readFile()
	{
		try {
		    $inputFileType = PHPExcel_IOFactory::identify($this->inputFileName);
		    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		    $this->objPHPExcel = $objReader->load($this->inputFileName);
		} catch(Exception $e) {
		    die('Error loading file "'.pathinfo($this->inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}
	}

	public function getFileContent()
	{
		$this->readFile();
		
		$sheet = $this->objPHPExcel->getSheet(0);
		$highestRow = $sheet->getHighestRow();

		for ($row = 1; $row <= $highestRow; $row++){ 
		    $rowData[] = $sheet->rangeToArray('A' . $row . ':' . 'D' . $row, NULL, TRUE, FALSE);
		}
		return $rowData;
	}

	public function setInputFileName($inputFileName)
	{
		$this->inputFileName = $inputFileName;
	}

	public function getInputFileName()
	{
		return $this->inputFileName;
	}
}

?>
