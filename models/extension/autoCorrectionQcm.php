<?php

function getAnswersElement($id_examen,$fileName)
{
	if (file_exists('../../public/examens/'.$id_examen."-corr")) {
		$file = '../../public/examens/'.$id_examen."-corr/".$fileName;
		$QCM = simplexml_load_file($file);
		$i = 1;
		foreach ($QCM->questions->question as $question) 
		{
			$j = 1;
			foreach ($question->repenses->repense as $repense) 
			{
				$answers[$i][$j] = intval($repense);
				$j++;
			}
			$i++;
		}
		return $answers;
	} else {
		return null;
	}
}

function getEtudiantAnswers($id_examen,$id_etudiant,$fileName)
{
	if (file_exists('../../public/examens/'.$id_examen.'-rep/'.$id_etudiant)) {
		$file = '../../public/examens/'.$id_examen.'-rep/'.$id_etudiant.'/'.$fileName;
		$QCM = simplexml_load_file($file);
		$i = 1;
		foreach ($QCM->questions->question as $question) 
		{
			$j = 1;
			foreach ($question->repenses->repense as $repense) 
			{
				$etudiantAnswers[$i][$j] = intval($repense);
				$j++;
			}
			$i++;
		}
		return $etudiantAnswers;
	} else {
		return null;
	}
}

function noteCalculator($answers,$etudiantAnswers)
{
	$note = 0;
	$i = 1;
	foreach ($answers as $answer) {
		$j = 1;
		foreach ($answer as $option) {
			if ($option == $etudiantAnswers[$i][$j]) {
				$note++;
			}
			$j++;
		}
		$i++;
	}
	return $note;
}


?>
