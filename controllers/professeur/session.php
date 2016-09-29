<?php
session_start();

if (!isset($_SESSION['professeur'])) 
{
	header('Location:../../index.php');
}
?>