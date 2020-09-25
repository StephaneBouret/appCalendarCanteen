<?php
	
	// déclaration en local
	define('SERVER' ,"localhost");
	define('USER' ,"root");
	define('PASSWORD' , "");
	define('BASE' ,"cantine");
	
	// connexion
	try
	{
		$connexion = new PDO("mysql:host=".SERVER.";dbname="
		.BASE, USER, PASSWORD);
		$connexion->exec("SET NAMES 'UTF8'");
	}
	catch (Exception $e)
	{
		echo 'Erreur : ' . $e->getMessage();
	}		
