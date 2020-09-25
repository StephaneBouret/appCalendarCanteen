<?php
	
	$id = $_GET['id'];
	
	// $requete = "DELETE FROM user WHERE id = $id";
	// $resultat = $connexion->exec($requete);
		
	$requete = $connexion->prepare("DELETE FROM menu 
	WHERE id = :id");
	$requete->bindParam(':id',$id);
	$resultat = $requete->execute();
	
	// var_dump($id);
	// var_dump($requete);
	// var_dump($resultat);
	
	header('location:index.php');
	
	
	
	
