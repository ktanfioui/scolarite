<?php

function saveQCM($id_examen,$content)
{

	$nbrQuestion = intval($content['nbrQuestion']);

	$fileName = $id_examen."-".date('m-d-Y-h-i-s')."-qcm";
	createFolder($id_examen);
	/************* creation du fichier XML *************************/
	$xmlFile = fopen('../../public/examens/'.$id_examen.'/'.$fileName.'.xml', 'a');

	fputs($xmlFile, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n\n");

	fputs($xmlFile,"<QCM>");
	fputs($xmlFile,"\n\t<idExamen>".$id_examen."</idExamen>");
	fputs($xmlFile,"\n\t<nbrQuestion>".$nbrQuestion."</nbrQuestion>");
	fputs($xmlFile,"\n\t<questions>");
	for ($i=1; $i < $nbrQuestion+1; $i++) 
	{
		fputs($xmlFile,"\n\t\t<question numero=\"".$i."\">");
		fputs($xmlFile,"\n\t\t\t<contenu>".htmlentities($content["question_$i"])."</contenu>");
		fputs($xmlFile,"\n\t\t\t<repenses>");
		$nbrChoix = intval($content["nbrChoix_$i"]);
		for ($j=1; $j < $nbrChoix+1; $j++) 
		{ 
			fputs($xmlFile,"\n\t\t\t\t<repense numero=\"".$j."\">".htmlentities($content["choix_$j$i"])."</repense>");
		}
		fputs($xmlFile,"\n\t\t\t</repenses>");
		fputs($xmlFile,"\n\t\t</question>");
	}
	fputs($xmlFile,"\n\t</questions>\n</QCM>");
	fclose($xmlFile);
}


function saveCours($id_examen,$content)
{
	$nbrQuestion = intval($content['nbrQuestion']);

	$fileName = $id_examen."-".date('m-d-Y-h-i-s')."-cours";
	createFolder($id_examen);

	/************* creation du fichier XML *************************/
	$xmlFile = fopen('../../public/examens/'.$id_examen.'/'.$fileName.'.xml', 'a');

	fputs($xmlFile, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n\n");

	fputs($xmlFile,"<QCours>");
	fputs($xmlFile,"\n\t<idExamen>".$id_examen."</idExamen>");
	fputs($xmlFile,"\n\t<nbrQuestion>".$nbrQuestion."</nbrQuestion>");
	fputs($xmlFile,"\n\t<questions>");

	for ($i=1; $i < $nbrQuestion+1; $i++) 
	{
		fputs($xmlFile,"\n\t\t<question numero=\"".$i."\">");
		fputs($xmlFile,"\n\t\t\t<contenu>\n\t\t\t\t".utf8_encode(html_entity_decode($content["question_$i"]))."\t\t\t</contenu>");
		fputs($xmlFile,"\n\t\t</question>");
	}

	fputs($xmlFile,"\n\t</questions>\n</QCours>");
	fclose($xmlFile);
}

function saveExercices($id_examen,$content)
{
	$nbrQuestion = intval($content['nbrQuestion']);

	$fileName = $id_examen."-".date('m-d-Y-h-i-s')."-exercices";
	createFolder($id_examen);

	/************* creation du fichier XML *************************/
	$xmlFile = fopen('../../public/examens/'.$id_examen.'/'.$fileName.'.xml', 'a');

	fputs($xmlFile, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n\n");

	fputs($xmlFile,"<PExercices>");
	fputs($xmlFile,"\n\t<idExamen>".$id_examen."</idExamen>");
	fputs($xmlFile,"\n\t<nbrExercices>".$nbrQuestion."</nbrExercices>");
	fputs($xmlFile,"\n\t<exercices>");

	for ($i=1; $i < $nbrQuestion+1; $i++) 
	{
		fputs($xmlFile,"\n\t\t<exercice numero=\"".$i."\">");
		fputs($xmlFile,"\n\t\t\t<contenu>\n\t\t\t\t".utf8_encode(html_entity_decode($content["question_$i"]))."\t\t\t</contenu>");
		fputs($xmlFile,"\n\t\t</exercice>");
	}

	fputs($xmlFile,"\n\t</exercices>\n</PExercices>");
	fclose($xmlFile);
}


function saveQCMCorrection($id_examen,$content)
{

	$nbrQuestion = intval($content['nbrQuestion']);

	$fileName = $id_examen."-".date('m-d-Y-h-i-s')."-qcm";
	createFolderCorrection($id_examen);
	/************* creation du fichier XML *************************/
	$xmlFile = fopen('../../public/examens/'.$id_examen.'-corr/'.$fileName.'.xml', 'a');

	fputs($xmlFile, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n\n");

	fputs($xmlFile,"<QCM>");
	fputs($xmlFile,"\n\t<idExamen>".$id_examen."</idExamen>");
	fputs($xmlFile,"\n\t<nbrQuestion>".$nbrQuestion."</nbrQuestion>");
	fputs($xmlFile,"\n\t<questions>");
	for ($i=1; $i < $nbrQuestion+1; $i++) 
	{
		fputs($xmlFile,"\n\t\t<question numero=\"".$i."\">");
		fputs($xmlFile,"\n\t\t\t<repenses>");
		$nbrChoix = intval($content["nbrChoix_$i"]);
		for ($j=1; $j < $nbrChoix+1; $j++) 
		{ 
			if (isset($content["choix_$i$j"])) {
				fputs($xmlFile,"\n\t\t\t\t<repense>".$j."</repense>");
			} 
		}
		fputs($xmlFile,"\n\t\t\t</repenses>");
		fputs($xmlFile,"\n\t\t</question>");
	}
	fputs($xmlFile,"\n\t</questions>\n</QCM>");
	fclose($xmlFile);
}

function saveCoursCorrection($id_examen,$content)
{
	$nbrQuestion = intval($content['nbrQuestion']);

	$fileName = $id_examen."-".date('m-d-Y-h-i-s')."-cours";
	createFolderCorrection($id_examen);

	/************* creation du fichier XML *************************/
	$xmlFile = fopen('../../public/examens/'.$id_examen.'-corr/'.$fileName.'.xml', 'a');

	fputs($xmlFile, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n\n");

	fputs($xmlFile,"<QCours>");
	fputs($xmlFile,"\n\t<idExamen>".$id_examen."</idExamen>");
	fputs($xmlFile,"\n\t<nbrQuestion>".$nbrQuestion."</nbrQuestion>");
	fputs($xmlFile,"\n\t<corrections>");

	for ($i=1; $i < $nbrQuestion+1; $i++) 
	{
		fputs($xmlFile,"\n\t\t<question numero=\"".$i."\">");
		fputs($xmlFile,"\n\t\t\t<contenu>\n\t\t\t\t".utf8_encode(html_entity_decode($content["question_$i"]))."\t\t\t</contenu>");
		fputs($xmlFile,"\n\t\t</question>");
	}

	fputs($xmlFile,"\n\t</corrections>\n</QCours>");
	fclose($xmlFile);
}

function saveExercicesCorrection($id_examen,$content)
{
	$nbrQuestion = intval($content['nbrQuestion']);

	$fileName = $id_examen."-".date('m-d-Y-h-i-s')."-exercices";
	createFolderCorrection($id_examen);

	/************* creation du fichier XML *************************/
	$xmlFile = fopen('../../public/examens/'.$id_examen.'-corr/'.$fileName.'.xml', 'a');

	fputs($xmlFile, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n\n");

	fputs($xmlFile,"<PExercices>");
	fputs($xmlFile,"\n\t<idExamen>".$id_examen."</idExamen>");
	fputs($xmlFile,"\n\t<nbrExercices>".$nbrQuestion."</nbrExercices>");
	fputs($xmlFile,"\n\t<corrections>");

	for ($i=1; $i < $nbrQuestion+1; $i++) 
	{
		fputs($xmlFile,"\n\t\t<exercice numero=\"".$i."\">");
		fputs($xmlFile,"\n\t\t\t<contenu>\n\t\t\t\t".utf8_encode(html_entity_decode($content["question_$i"]))."\t\t\t</contenu>");
		fputs($xmlFile,"\n\t\t</exercice>");
	}

	fputs($xmlFile,"\n\t</corrections>\n</PExercices>");
	fclose($xmlFile);
}

function createFolder($id_examen)
{
	if (!file_exists('../../public/examens/'.$id_examen)) 
	{
		mkdir('../../public/examens/'.$id_examen);
	}
}


function createFolderCorrection($id_examen)
{
	if (!file_exists('../../public/examens/'.$id_examen."-corr")) 
	{
		mkdir('../../public/examens/'.$id_examen."-corr");
	}
}
?>