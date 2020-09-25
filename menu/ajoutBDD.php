<?php
	var_dump($_POST);
	
	$entree = $_POST['entree'];
	$plat_principal = $_POST['plat_principal'];
	$dessert = $_POST['dessert'];
	
	
	$requete = $connexion->prepare("INSERT INTO `menu`
	(`id`, `entree`, `plat_principal`, `dessert`) 
	VALUES (NULL, :entree,:plat_principal,:dessert)");
	$requete->bindParam(':entree',$entree);
	$requete->bindParam(':plat_principal',$plat_principal);
	$requete->bindParam(':dessert',$dessert);
	$resultat = $requete->execute();
	
	// var_dump($requete->errorInfo());
	// var_dump($resultat);
	header('location:index.php');
	
	
	
	
	