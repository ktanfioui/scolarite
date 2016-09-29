<?php
session_start();

if (!isset($_SESSION['etudiant'])) 
{
	header('Location:../../index.php');
}
?>