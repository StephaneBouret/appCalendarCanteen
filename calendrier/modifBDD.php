<?php

$id = $_POST['id'];
$date = $_POST['date'];
$id_menu = $_POST['id_menu'];

$requete = $connexion->prepare("UPDATE `calendrier`
	SET `date` = :date, `id_menu`=:id_menu
	WHERE id = :id");
$requete->bindParam(':id', $id);
$requete->bindParam(':date', $date);
$requete->bindParam(':id_menu', $id_menu);
$resultat = $requete->execute();

// var_dump($_POST);
// var_dump($requete);
// var_dump($resultat);
// echo "<div class='row my-3'>";
// echo "<div class='col'>";
// if ($resultat) {
// 	echo "<p class='alert alert-success'>Modification effectuée avec succès</p>";
// } else {	
// 	$date_fr = strftime("%A %d %B %Y");
// 	echo "<p class='alert alert-danger'>Erreur lors de la modification : vérifiez s'il n'y a pas déjà un menu affecté en date du <b>"
// 	.utf8_encode($date_fr)
// 	."</b></p>";
// }	

//echo "</div></div>";
	header('location:index.php?entite=calendrier');
