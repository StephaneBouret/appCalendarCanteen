<?php
	
	$id = $_GET['id'];
	
	$requete = $connexion->prepare("SELECT * FROM calendrier WHERE id = :id");
	$requete->bindParam(':id',$id);
	$resultat = $requete->execute();
	$liste = $requete->fetch(PDO::FETCH_ASSOC);
	// var_dump($liste);
	
	// $requete_menu = "SELECT * FROM menu";
	$requete_menu = "SELECT menu.*, plat_entree.nom as nom_entree,
							plat_principal.nom as nom_plat_principal, 
							plat_dessert.nom as nom_dessert 
				FROM menu
				JOIN plat as plat_entree
				ON menu.entree = plat_entree.id
				JOIN plat as plat_principal
				ON menu.plat_principal = plat_principal.id
				JOIN plat as plat_dessert
				ON menu.dessert = plat_dessert.id";
	$resultat_menu = $connexion->query($requete_menu);
	$liste_menu = $resultat_menu->fetchAll(PDO::FETCH_ASSOC);	
?>

<h1>Modifier une affectation de menu à date</h1>

<form action='index.php?entite=calendrier&action=modifBDD' method='post'>
	<div class="form-group row">
		<label class='col-md-2 col-sm-12' for="id">identifiant:</label>
		<input type="text" class="form-control col-md-6 col-sm-12" id="id" name="id" aria-describedby="id" value='<?php echo $liste['id']; ?>' readonly >		
	</div>
	<div class="form-group row">
		<label class='col-md-2 col-sm-12' for="date">date:</label>
		<input type="date" class="form-control col-md-6 col-sm-12" id="date" name="date" aria-describedby="date" value='<?php echo $liste['date']; ?>' >		
	</div>	
	<div class="form-group row">
		<label class='col-md-2 col-sm-12' for="id_menu">Menu:</label>
		<select class="form-control col-md-6 col-sm-12" name="id_menu" id="id_menu">
		<?php
			foreach($liste_menu as $menu) {
				$menu_text = $menu['id'].": ".$menu['nom_entree']." / ".$menu['nom_plat_principal']." / ".$menu['nom_dessert'];
				$selected = ($menu['id']==$liste['id_menu'])?"selected":"";
				echo "<option value='".$menu['id']."' $selected>".$menu_text."</option>";
			}
		?>
	</select>
	</div>
	<div>
		<button type="submit" class="btn btn-primary">Enregistrer</button>		
	</div>
</form>
