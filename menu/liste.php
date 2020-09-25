<?php	
	
	$requete = "SELECT menu.*, plat_entree.nom as nom_entree,
							plat_principal.nom as nom_plat_principal, 
							plat_dessert.nom as nom_dessert 
				FROM menu
				JOIN plat as plat_entree
				ON menu.entree = plat_entree.id
				JOIN plat as plat_principal
				ON menu.plat_principal = plat_principal.id
				JOIN plat as plat_dessert
				ON menu.dessert = plat_dessert.id";
	$resultat = $connexion->query($requete);

	$liste = $resultat->fetchAll(PDO::FETCH_ASSOC);
	// var_dump($liste);
	echo "<div class='row'><div class='col'><h1>Gestion des menus</h1></div></div>";
	echo "<div class='row'><div class='col'><a class='btn btn-success my-3 pull-right' href='index.php?entite=menu&action=ajouter'>Ajouter</a></div></div>";

	echo "<div class='row'><div class='col'>";
	echo "<table class='table table-striped'>";
	echo "<tr>
		<th>Id</th>
		<th>Entrée</th>
		<th>Plat principal</th>
		<th>Dessert</th>
		<th>Supp</th>
		<th>Modif</th>
		</tr>";
	foreach($liste as $menu) {		
		echo "<tr><td>" 
		. $menu['id'] 
		. "</td><td>"
		. $menu['nom_entree'] 
		. "</td><td>"
		. $menu['nom_plat_principal'] 
		. "</td><td>"
		. $menu['nom_dessert'] 
		. "</td><td><a class='btn btn-danger' href='index.php?entite=menu&action=supprimer&id="
		. $menu['id'] 
		. "'>Supprimer</a></td>"
		. "</td><td><a class='btn btn-primary' href='index.php?entite=menu&action=modifier&id="
		. $menu['id'] 
		. "'>Modifier</a></td>"
		. "</td></tr>";
	}		
	echo "</table>";
	echo "</div></div>";
	
	
	
	
	
