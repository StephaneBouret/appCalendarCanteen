<h1>Ajout d'un plat</h1>

<form action='index.php?entite=plat&action=ajoutBDD' method='post' enctype="multipart/form-data">
	<div class="form-group">
		<label for="nom">Nom du plat:</label>
		<input type="texte" class="form-control" id="nom" name="nom" aria-describedby="nom" placeholder="Nom du plat">		
	</div>	
	<div class="form-group">
		<label for="type">Type:</label>
		<div class="form-check-inline">
			<label class="form-check-label">
				<input type="radio" class="form-check-input" name="type" value='entree'>Entrée
			</label>
		</div>
		<div class="form-check-inline">
			<label class="form-check-label">
				<input type="radio" class="form-check-input" name="type" value='plat_principal'>Plat
			</label>
		</div>
		<div class="form-check-inline">
			<label class="form-check-label">
				<input type="radio" class="form-check-input" name="type" value='dessert'>Dessert
			</label>		
		</div>
	</div>
	<div class="form-group">
		<label for="photo">Photo:</label>
		<input type="file" class="form-control-file" id="photo" name="photo" aria-describedby="nom" placeholder="Photo">		
	</div>
	<div>
		<button type="submit" class="btn btn-primary">Enregistrer</button>		
	</div>
</form>