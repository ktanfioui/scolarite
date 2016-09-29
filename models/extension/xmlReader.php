<?php

function getExamenFiles($id_examen)
{
	$filesTab = null;
	if ($dossier = opendir('../../public/examens/'.$id_examen)) 
	{
		while(false !== ($file = readdir($dossier)))
		{
			if ($file != "." && $file != "..") 
			{
				if (partieExamenFile($file) != null) {
					$filesTab[partieExamenFile($file)] = $file;
				}
			}
		}
	}
	closedir($dossier);
	return $filesTab;
}

function getExamenCorrectionFiles($id_examen)
{
	$filesTab = null;
	if (file_exists('../../public/examens/'.$id_examen."-corr")) {
		if ($dossier = opendir('../../public/examens/'.$id_examen."-corr")) 
		{
			while(false !== ($file = readdir($dossier)))
			{
				if ($file != "." && $file != "..") 
				{
					if (partieExamenFile($file) != null) {
						$filesTab[partieExamenFile($file)] = $file;
					}
				}
			}
		}
		closedir($dossier);
	}
	return $filesTab;
}

function getExamenReponseFiles($id_examen,$id_etudiant)
{
	$filesTab = null;
	if (file_exists('../../public/examens/'.$id_examen.'-rep/'.$id_etudiant)) {
		if ($dossier = opendir('../../public/examens/'.$id_examen.'-rep/'.$id_etudiant)) 
		{
			while(false !== ($file = readdir($dossier)))
			{
				if ($file != "." && $file != "..") 
				{
					if (partieExamenFile($file) != null) {
						$filesTab[partieExamenFile($file)] = $file;
					}
				}
			}
		}
		closedir($dossier);
	}
	return $filesTab;
}


function partieExamenFile($file)
{
	$parte = explode(".",$file);
	$exploded = explode("-",$parte[0]);
	if (in_array("qcm", $exploded)) {
		return "qcm";
	} else if (in_array("cours", $exploded)) {
		return "cours";
	} else if (in_array("exercices", $exploded)) {
		return "exercices";
	} else {
		return null;
	}
}

function showQCMExamen($id_examen,$fileName)
{
	$file = '../../public/examens/'.$id_examen."/".$fileName;
	$QCM = simplexml_load_file($file);
	$print = "<div class=\"col-lg-12\">";
	foreach ($QCM->questions->question as $question) 
	{
		$print .= "<div class=\"qcm-question\">";
		$print .= "<h3><span class=\"colored\">Q{$question['numero']} </span>: {$question->contenu} </h3>";
		foreach ($question->repenses->repense as $repense) 
		{
			$print .= "<h4><i class=\"colored\">{$repense['numero']}.</i> {$repense}</h4>";
		}
		$print .= "</div>";
	}
	$print .= "</div>";
	return $print;
}


function showQCoursExamen($id_examen,$fileName)
{
	$file = '../../public/examens/'.$id_examen."/".$fileName;
	$QCours = simplexml_load_file($file);
	$print = "<div class=\"col-lg-12\">";
	foreach ($QCours->questions->question as $question) 
	{
		$print .= "<div class=\"cours-question\">";
		$print .= "<h3 class=\"colored\">Question {$question['numero']}</h3>";
		$print .= "<p>{$question->contenu->asXML()}</p>";
		$print .= "</div>";
	}
	$print .= "</div>";
	return $print;
}

function showExerciceExamen($id_examen,$fileName)
{
	$file = '../../public/examens/'.$id_examen."/".$fileName;
	$PExercices = simplexml_load_file($file);
	$print = "<div class=\"col-lg-12\">";
	foreach ($PExercices->exercices->exercice as $exercice) 
	{
		$print .= "<div class=\"exercice-question\">";
		$print .= "<h3 class=\"colored\">Exercice {$exercice['numero']}</h3>";
		$print .= "<p>{$exercice->contenu->asXML()}</p>";
		$print .= "</div>";
	}
	$print .= "</div>";
	return $print;
}

function getNbrQuestionQCM($id_examen,$fileName)
{
	$file = '../../public/examens/'.$id_examen."/".$fileName;
	$QCM = simplexml_load_file($file);
	return $QCM->nbrQuestion;
}

function getNbrQuestionCours($id_examen,$fileName)
{
	$file = '../../public/examens/'.$id_examen."/".$fileName;
	$QCours = simplexml_load_file($file);
	return $QCours->nbrQuestion;
}

function getNbrExercices($id_examen,$fileName)
{
	$file = '../../public/examens/'.$id_examen."/".$fileName;
	$PExercices = simplexml_load_file($file);
	return $PExercices->nbrExercices;
}


function showQCMExamenForCorrection($id_examen,$fileName)
{
	$file = '../../public/examens/'.$id_examen."/".$fileName;
	$QCM = simplexml_load_file($file);
	$print = "<div class=\"col-lg-12\">";
	foreach ($QCM->questions->question as $question) 
	{
		$print .= "<div class=\"qcm-question\">";
		$print .= "<h3><span class=\"colored\">Q{$question['numero']} </span>: {$question->contenu} </h3><div class=\"col-lg-12\">";
		$i = $question['numero'];
		$j = 0;
		foreach ($question->repenses->repense as $repense) 
		{
			$print .= "<div class=\"checkbox\"><label><input type=\"checkbox\" name=\"choix_".$i."{$repense['numero']}\">{$repense}</label></div>";
			$j++;
		}
		$print .= "</div></div>";
		$print .= "<input type=\"hidden\" name=\"nbrChoix_".$i."\" value=\"".$j."\">";
	}
	$print .= "</div>";
	return $print;
}

/***************** correction **********************/

function showQCMExamenCorrection($id_examen,$fileName)
{
	$file = '../../public/examens/'.$id_examen."-corr/".$fileName;
	$QCM = simplexml_load_file($file);
	$print = "<div class=\"col-lg-12\">";
	foreach ($QCM->questions->question as $question) 
	{
		$print .= "<div class=\"qcm-question\">";
		$print .= "<h3><span class=\"colored\">Q{$question['numero']} </span></h3>";
		foreach ($question->repenses->repense as $repense) 
		{
			$print .= "<h4><i class=\"colored\"></i>Choix {$repense}</h4>";
		}
		$print .= "</div>";
	}
	$print .= "</div>";
	return $print;
}


function showQCoursExamenCorrection($id_examen,$fileName)
{
	$file = '../../public/examens/'.$id_examen."-corr/".$fileName;

	$QCours = simplexml_load_file($file);
	$print = "<div class=\"col-lg-12\">";
	foreach ($QCours->corrections->question as $question) 
	{
		$print .= "<div class=\"cours-question\">";
		$print .= "<h3 class=\"colored\">Question {$question['numero']}</h3>";
		$print .= "<p>{$question->contenu->asXML()}</p>";
		$print .= "</div>";
	}
	$print .= "</div>";
	return $print;

	
}

function showExerciceExamenCorrection($id_examen,$fileName)
{
	$file = '../../public/examens/'.$id_examen."-corr/".$fileName;
	$PExercices = simplexml_load_file($file);
	$print = "<div class=\"col-lg-12\">";
	foreach ($PExercices->corrections->exercice as $exercice) 
	{
		$print .= "<div class=\"exercice-question\">";
		$print .= "<h3 class=\"colored\">Exercice {$exercice['numero']}</h3>";
		$print .= "<p>{$exercice->contenu->asXML()}</p>";
		$print .= "</div>";
	}
	$print .= "</div>";
	return $print;
}

/***************** Reponse **********************/

function showQCMExamenReponse($id_examen,$id_etudiant,$fileName)
{
	$file = '../../public/examens/'.$id_examen.'-rep/'.$id_etudiant.'/'.$fileName;
	$QCM = simplexml_load_file($file);
	$print = "<div class=\"col-lg-12\">";
	foreach ($QCM->questions->question as $question) 
	{
		$print .= "<div class=\"qcm-question\">";
		$print .= "<h3><span class=\"colored\">Q{$question['numero']} </span></h3>";
		foreach ($question->repenses->repense as $repense) 
		{
			$print .= "<h4><i class=\"colored\"></i>Choix {$repense}</h4>";
		}
		$print .= "</div>";
	}
	$print .= "</div>";
	return $print;
}


function showQCoursExamenReponse($id_examen,$id_etudiant,$fileName)
{
	$file = '../../public/examens/'.$id_examen.'-rep/'.$id_etudiant.'/'.$fileName;
	$QCours = simplexml_load_file($file);
	$print = "<div class=\"col-lg-12\">";
	foreach ($QCours->repenses->question as $question) 
	{
		$print .= "<div class=\"cours-question\">";
		$print .= "<h3 class=\"colored\">Question {$question['numero']}</h3>";
		$print .= "<p>{$question->contenu->asXML()}</p>";
		$print .= "</div>";
	}
	$print .= "</div>";
	return $print;
}

function showExerciceExamenReponse($id_examen,$id_etudiant,$fileName)
{
	$file = '../../public/examens/'.$id_examen.'-rep/'.$id_etudiant.'/'.$fileName;
	$PExercices = simplexml_load_file($file);
	$print = "<div class=\"col-lg-12\">";
	foreach ($PExercices->repenses->exercice as $exercice) 
	{
		$print .= "<div class=\"exercice-question\">";
		$print .= "<h3 class=\"colored\">Exercice {$exercice['numero']}</h3>";
		$print .= "<p>{$exercice->contenu->asXML()}</p>";
		$print .= "</div>";
	}
	$print .= "</div>";
	return $print;
}

function warningMessage($message)
{
	return "<div class=\"col-lg-12\"><div class=\"bs-example\"><div class=\"alert alert-warning fade in\">
                <button aria-hidden=\"true\" data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
                ".$message."</div></div></div>";
}
?>
