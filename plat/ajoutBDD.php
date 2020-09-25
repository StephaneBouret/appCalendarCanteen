<?php
	// var_dump($_POST);
	// var_dump($_FILES);
	
	$nom = $_POST['nom'];
	$type = $_POST['type'];
	
	$photo = "img\undefine.jpg";
	
	if (isset($_FILES['photo']) && !empty($_FILES['photo'])) {
		$emplacement_temporaire = $_FILES['photo']['tmp_name'];
		$nom_fichier = $_FILES['photo']['name'];
		// $emplacement_destination = 'C:\wamp64\www\cours\2019_DWWM\appCantine\img\\'. $nom_fichier;
		$emplacement_destination = 'img\\'. $nom_fichier;
		var_dump($emplacement_temporaire);
		var_dump($emplacement_destination);
		
		$result = move_uploaded_file ( $emplacement_temporaire , $emplacement_destination );
		if ($result) {
			$photo = 'img\\'.$nom_fichier;
		}		
	}	
	
	$requete = $connexion->prepare("INSERT INTO `plat`
	(`id`, `nom`, `photo`, `type`) 
	VALUES (NULL, :nom,:photo,:type)");
	$requete->bindParam(':nom',$nom);
	$requete->bindParam(':type',$type);
	$requete->bindParam(':photo',$photo);
	$resultat = $requete->execute();
	
	// var_dump($requete);
	// var_dump($resultat);
	header('location:index.php?entite=plat');
	
	
	
	
