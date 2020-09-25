<?php
	
	$id = $_GET['id'];
	
	$requete = "SELECT * FROM plat WHERE id = $id";
	$resultat = $connexion->query($requete);
	$liste = $resultat->fetch(PDO::FETCH_ASSOC);
	
	$entreeChecked = "";
	$platChecked = "";
	$dessertChecked = "";
	if ($liste['type']=="entree") {
		$entreeChecked = "checked";
		} 
	elseif ($liste['type']=="plat_principal") {
		$platChecked = "checked";
	} 
	elseif ($liste['type']=="dessert") {
		$dessertChecked = "checked";
	}
	
?>

<h1>Modifier un plat</h1>

<form action='index.php?entite=plat&action=modifBDD' method='post' enctype="multipart/form-data">
	<div class="form-group">
		<label for="id">Id:</label>
		<input type="texte" class="form-control" id="id" name="id" aria-describedby="id" 
		placeholder="id du plat" value='<?php echo $liste['id'] ?> '>		
	</div>	
	<div class="form-group">
		<label for="nom">Nom du plat:</label>
		<input type="texte" class="form-control" id="nom" name="nom" aria-describedby="nom" 
		placeholder="Nom du plat" value='<?php echo $liste['nom'] ?> '>		
	</div>	
	<div class="form-group">
		<label for="type">Type:</label>
		<div class="form-check-inline">
			<label class="form-check-label">
				<input type="radio" class="form-check-input" name="type" value='entree' <?php echo $entreeChecked;  ?>>Entrée
			</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
				<input type="radio" class="form-check-input" name="type" value='plat_principal' <?php echo $platChecked;  ?>>Plat
				</label>
				</div>
				<div class="form-check-inline">
					<label class="form-check-label">
						<input type="radio" class="form-check-input" name="type" value='dessert' <?php echo $dessertChecked;  ?>>Dessert
					</label>		
				</div>
	</div>
	<div class="form-group">
		<label for="photo">Photo:</label>
		<img src='<?php echo $liste['photo'] ?>' /> 
		<input type="file" class="form-control-file" id="photo" name="photo" aria-describedby="photo du plat" placeholder="Photo"		'>		
	</div>
	<div>
		<button type="submit" class="btn btn-primary">Enregistrer</button>		
	</div>
</form>

