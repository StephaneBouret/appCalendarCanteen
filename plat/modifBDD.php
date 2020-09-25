<?php

// var_dump($_POST);
// var_dump($_FILES);

$id = $_POST['id'];
$nom = $_POST['nom'];
$type = $_POST['type'];

if (isset($_FILES['photo']) && ($_FILES['photo']['size']>0)) {
	$photo = "img\undefine.jpg";
	$emplacement_temporaire = $_FILES['photo']['tmp_name'];
	$nom_fichier = $_FILES['photo']['name'];
	$emplacement_destination = 'C:\wamp64\www\cours\2019_DWWM\appCantine\img\\' . $nom_fichier;
	// var_dump($emplacement_temporaire);
	// var_dump($emplacement_destination);		
	$result = move_uploaded_file($emplacement_temporaire, $emplacement_destination);
	if ($result) {
		$photo = 'img\\' . $nom_fichier;
	}

	$requete = $connexion->prepare("UPDATE `plat`
		SET `nom`=:nom, `photo`=:photo, `type`=:type 
		WHERE id=:id");
	$requete->bindParam(':photo', $photo);
} else {
	$requete = $connexion->prepare("UPDATE `plat`
		SET `nom`=:nom, `type`=:type 
		WHERE id=:id");
}

$requete->bindParam(':id', $id);
$requete->bindParam(':nom', $nom);
$requete->bindParam(':type', $type);
$resultat = $requete->execute();

// var_dump($id);
// var_dump($requete);
// var_dump($requete->errorInfo());
// var_dump($resultat);

header('location:index.php?entite=plat');
