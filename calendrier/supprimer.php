<?php
	
	$id = $_GET['id'];
	
	$requete = $connexion->prepare("DELETE FROM calendrier 
	WHERE id = :id");
	$requete->bindParam(':id',$id);
	$resultat = $requete->execute();
		
	// var_dump($id);
	// var_dump($requete);
	// var_dump($resultat);
	// var_dump($requete->errorCode());
	// var_dump($requete->errorInfo());
	
	header('location:index.php?entite=calendrier');
	
	
	
	
