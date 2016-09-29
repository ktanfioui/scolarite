<?php

//	geenerer un mot de passe aléatoire
function generateMDP($longueur)
{
	$mdp = "";
	$possible = "012346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ/*-+";
	$longueurMax = strlen($possible);
 
	if ($longueur > $longueurMax) {
		$longueur = $longueurMax;
	}
 
	$i = 0;
	while ($i < $longueur) {
		$caractere = substr($possible, mt_rand(0, $longueurMax-1), 1);
		if (!strstr($mdp, $caractere)) {
			$mdp .= $caractere;
			$i++;
		}
	}
 
	return $mdp;
}

?>
