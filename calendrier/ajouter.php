<?php
	
	// $requete = "SELECT * FROM menu";
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
?>

<h1>Affectation d'un menu à une date</h1>


<form action='index.php?entite=calendrier&action=ajoutBDD' method='post'>
	<div class="form-group row">
		<label class='col-md-2 col-sm-12' for="entree">date:</label>
		<input type="date" class="form-control col-md-6 col-sm-12" id="date" name="date" aria-describedby="date">		
	</div>
	<div class="form-group row">
		<label class='col-md-2 col-sm-12' for="id_menu">Menu:</label>
		<select class="form-control col-md-6 col-sm-12" name="id_menu" id="id_menu">
		<?php
			foreach($liste as $menu) {
				$menu_text = $menu['id'].": ".$menu['nom_entree']." / ".$menu['nom_plat_principal']." / ".$menu['nom_dessert'];
				echo "<option value='".$menu['id']."'>".$menu_text."</option>";
			}
		?>
	</select>
	</div>
	<div>
		<button type="submit" class="btn btn-primary">Enregistrer</button>		
	</div>
</form>

