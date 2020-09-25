<?php	
	
	$requete = "SELECT * FROM plat ORDER BY nom";
	$resultat = $connexion->query($requete);
	
	$liste = $resultat->fetchAll(PDO::FETCH_ASSOC);
	// var_dump($liste);
	echo "<div class='row'><div class='col'><h1>Gestion des plats</h1></div></div>";
	echo "<div class='row'><div class='col'><a class='btn btn-success my-3 pull-right' href='index.php?entite=plat&action=ajouter'>Ajouter</a></div></div>";
	
	echo "<div class='row'><div class='col'>";
	echo "<table class='table table-striped'>";
	echo "<tr>
	<th>Id</th>
	<th>Nom</th>
	<th>Photo</th>
	<th>Type de plat</th>
	<th>Supp</th>
	<th>Modif</th>
	</tr>";
	foreach($liste as $plat) {		
		echo "<tr><td>" 
		. $plat['id'] 
		. "</td><td>"
		. $plat['nom'] 
		. "</td><td>"
		. "<img src='". $plat['photo'] . "' height='50px'>"
		. "</td><td>"
		. $plat['type'] 
		. "</td><td><a class='btn btn-danger'  href='index.php?entite=plat&action=supprimer&id="
		. $plat['id'] 
		. "'>Supprimer</a></td>"
		. "</td><td><a class='btn btn-primary'  href='index.php?entite=plat&action=modifier&id="
		. $plat['id'] 
		. "'>Modifier</a></td>"
		. "</td></tr>";
	}		
	echo "</table>";
	echo "</div></div>";
	
	
	
	
	
