<?php	
	
	$id = $_POST['id'];
	$entree = $_POST['entree'];
	$plat_principal = $_POST['plat_principal'];
	$dessert = $_POST['dessert'];
	
	$requete = $connexion->prepare("UPDATE `menu`
	SET `entree` = :entree, `plat_principal`=:plat_principal, `dessert`=:dessert 
	WHERE id = :id");
	$requete->bindParam(':id',$id);
	$requete->bindParam(':entree',$entree);
	$requete->bindParam(':plat_principal',$plat_principal);
	$requete->bindParam(':dessert',$dessert);
	$resultat = $requete->execute();
		
		// var_dump($id);
	// var_dump($requete);
	// var_dump($requete->errorInfo());
	// var_dump($resultat);
	
	
	header('location:index.php');
	
	
	
	
	