<?php

class ExcelFileUpload
{
	private $file;
	private $path;

	public function __construct($file)
	{
		$this->setFile($file);
	}

	public function uploadFile($id_filiere)
	{
		if ($this->file['error'] > 0) 
		{
			return "Erreur lors du transfert !!";
		}
		elseif (!$this->checkType()) 
		{
			return "Extension du fichier incorrecte !!";
		}
		elseif (!$this->moveFile($id_filiere))
		{
			return "Erreur du transfert !!";
		}
		else
		{
			return "true";
		}
	}

	public function moveFile($id_filiere)
	{
		$this->path = "../../public/excel/".$id_filiere."-".date("m-d-y-H-i-s").".xlsx";
		return move_uploaded_file($this->file['tmp_name'],$this->path);
	}

	public function checkType()
	{
		$extensions = array('xlsx');
		$extension_upload = strtolower(substr(strrchr($this->file['name'],'.')  ,1));
		if (in_array($extension_upload,$extensions))
			return true;
		else
			return false;
	}

	public function setFile($file)
	{
		$this->file = $file;
	}

	public function getfile()
	{
		return $this->file;
	}

	public function getPath()
	{
		return $this->path;
	}
}

?>
