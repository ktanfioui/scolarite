<?php

	try 
	{
		//$BDD = new PDO('mysql:host=localhost;dbname=ensakfor_examen','ensakfor_root', '0102030405');
				$BDD = new PDO('mysql:host=localhost;dbname=ensakfor_examen','root', 'khaoula');


		$BDD->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	} 
	catch (PDOException $e) 
	{
		echo $e->getMessage();
	}

?>
