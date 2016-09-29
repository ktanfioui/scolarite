<?php

function saveQCMCorrection($id_examen,$id_etudiant,$content)
{

	$nbrQuestion = intval($content['nbrQuestion_qcm']);

	$fileName = $id_examen."-".date('m-d-Y-h-i-s')."-qcm";
	createFolderRepense($id_examen,$id_etudiant);
	/************* creation du fichier XML *************************/
	$xmlFile = fopen('../../public/examens/'.$id_examen.'-rep/'.$id_etudiant.'/'.$fileName.'.xml', 'a');

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

function saveCoursCorrection($id_examen,$id_etudiant,$content)
{
	$nbrQuestion = intval($content['nbrQuestion_cours']);

	$fileName = $id_examen."-".date('m-d-Y-h-i-s')."-cours";
	createFolderRepense($id_examen,$id_etudiant);

	/************* creation du fichier XML *************************/
	$xmlFile = fopen('../../public/examens/'.$id_examen.'-rep/'.$id_etudiant.'/'.$fileName.'.xml', 'a');

	fputs($xmlFile, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n\n");

	fputs($xmlFile,"<QCours>");
	fputs($xmlFile,"\n\t<idExamen>".$id_examen."</idExamen>");
	fputs($xmlFile,"\n\t<nbrQuestion>".$nbrQuestion."</nbrQuestion>");
	fputs($xmlFile,"\n\t<repenses>");

	for ($i=1; $i < $nbrQuestion+1; $i++) 
	{
		fputs($xmlFile,"\n\t\t<question numero=\"".$i."\">");
		fputs($xmlFile,"\n\t\t\t<contenu>\n\t\t\t\t".utf8_encode(html_entity_decode($content["question_cours_$i"]))."\t\t\t</contenu>");
		fputs($xmlFile,"\n\t\t</question>");
	}

	fputs($xmlFile,"\n\t</repenses>\n</QCours>");
	fclose($xmlFile);
}

function saveExercicesCorrection($id_examen,$id_etudiant,$content)
{
	$nbrQuestion = intval($content['nbrQuestion_exercice']);

	$fileName = $id_examen."-".date('m-d-Y-h-i-s')."-exercices";
	createFolderRepense($id_examen,$id_etudiant);

	/************* creation du fichier XML *************************/
	$xmlFile = fopen('../../public/examens/'.$id_examen.'-rep/'.$id_etudiant.'/'.$fileName.'.xml', 'a');

	fputs($xmlFile, "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n\n");

	fputs($xmlFile,"<PExercices>");
	fputs($xmlFile,"\n\t<idExamen>".$id_examen."</idExamen>");
	fputs($xmlFile,"\n\t<nbrExercices>".$nbrQuestion."</nbrExercices>");
	fputs($xmlFile,"\n\t<repenses>");

	for ($i=1; $i < $nbrQuestion+1; $i++)
	{
		fputs($xmlFile,"\n\t\t<exercice numero=\"".$i."\">");
		fputs($xmlFile,"\n\t\t\t<contenu>\n\t\t\t\t".utf8_encode(html_entity_decode($content["question_exercice_$i"]))."\t\t\t</contenu>");
		fputs($xmlFile,"\n\t\t</exercice>");
	}

	fputs($xmlFile,"\n\t</repenses>\n</PExercices>");
	fclose($xmlFile);
}


function createFolderRepense($id_examen,$id_etudiant)
{
	if (!file_exists('../../public/examens/'.$id_examen."-rep")) 
	{
		mkdir('../../public/examens/'.$id_examen."-rep");
	}
	if (!file_exists('../../public/examens/'.$id_examen."-rep/".$id_etudiant)) 
	{
		mkdir('../../public/examens/'.$id_examen."-rep/".$id_etudiant);
	}
}
?>