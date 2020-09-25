<?php
	
	$requete = $connexion->prepare("SELECT * FROM plat WHERE type=:type");
	$requete->bindParam(':type', $type);
	
	$type = "entree";
	$requete->execute();
	$liste_entree = $requete->fetchAll(PDO::FETCH_ASSOC);
	
	$type = "plat_principal";
	$requete->execute();
	$liste_plat = $requete->fetchAll(PDO::FETCH_ASSOC);
	
	$type = "dessert";
	$requete->execute();
	$liste_dessert = $requete->fetchAll(PDO::FETCH_ASSOC);
	
	// var_dump($liste_entree);
	// var_dump($liste_plat);
	// var_dump($liste_dessert);
?>

<h1>Ajout d'un menu</h1>

<form action='index.php?entite=menu&action=ajoutBDD' method='post'>
	<div class="form-group row">
		<label class='col-md-2 col-sm-12' for="entree">Entrée:</label>
		<select class="form-control col-md-10 col-sm-12" name="entree" id="entree">
			<?php
				foreach($liste_entree as $entree) {
					echo "<option value='".$entree['id']."'>".$entree['nom']."</option>";
				}
			?>
		</select>
	</div>
	<div class="form-group row">
		<label class='col-md-2 col-sm-12' for="plat_principal">Plat principal:</label>
		<select class="form-control col-md-10 col-sm-12" name="plat_principal" id="plat_principal">
			<?php
				foreach($liste_plat as $plat_principal) {
					echo "<option value='".$plat_principal['id']."'>".$plat_principal['nom']."</option>";
				}
			?>
		</select>
	</div>
	<div class="form-group row">
		<label class='col-md-2 col-sm-12' for="dessert">Dessert:</label>
		<select class="form-control col-md-10 col-sm-12" name="dessert" id="dessert">
			<?php
				foreach($liste_dessert as $dessert) {
					echo "<option value='".$dessert['id']."'>".$dessert['nom']."</option>";
				}
			?>
		</select>
	</div>
	<div>
		<button type="submit" class="btn btn-primary">Enregistrer</button>		
	</div>
</form>