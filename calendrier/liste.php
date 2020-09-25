<?php

$semaine = (isset($_GET['semaine'])) ? $_GET['semaine'] : strftime("%U");
$annee = (isset($_GET['annee'])) ? $_GET['annee'] : strftime("%Y");

/**
 * Calcul de la semaine précédente et suivante pour navigation
 * Règles de gestion: 
 * 		calcul de la semaine précédente (semaine - 1):
 * 			si (semaine-1) = 0 alors 
 * 				la semaine précédente <- 52
 * 			Finsi
 * 		calcul de la semaine suivante (semaine + 1):
 * 			si (semaine+1) > 52 alors 
 * 				la semaine suivante <- 1
 * 			Finsi
 * 		ToDo : prévoir le cas des années avec 53 semaines
 */
$semainePrec = $semaine - 1;
$anneePrec = $annee;
if ($semainePrec == 0) {	
	$anneePrec = $annee - 1;
	// $derniere_semaine = date('W', strtotime($anneePrec . '-12-31'));
	// $semainePrec = $derniere_semaine;
	$semainePrec = 52;
}

$derniere_semaine = date('W', strtotime($annee . '-12-31'));
$semaineSuiv = $semaine + 1;
$anneeSuiv = $annee;
if ($derniere_semaine == '01') {
	$derniere_semaine = date('W', strtotime($annee . '-12-24'));
}

if ($semaineSuiv  > $derniere_semaine ) {
	$semaineSuiv = 1;
	$anneeSuiv = $annee + 1;
}

$requete = $connexion->prepare("SELECT calendrier.*, WEEK(date) as semaine, calendrier.id as id_calendrier, menu.*, menu.id as id_menu,
							plat_entree.nom as nom_entree,
							plat_entree.photo as photo_entree,
							plat_principal.nom as nom_plat_principal, 
							plat_principal.photo as photo_plat_principal, 
							plat_dessert.nom as nom_dessert, 
							plat_dessert.photo as photo_dessert 
				FROM calendrier
				JOIN menu
				ON calendrier.id_menu = menu.id
				JOIN plat as plat_entree
				ON menu.entree = plat_entree.id
				JOIN plat as plat_principal
				ON menu.plat_principal = plat_principal.id
				JOIN plat as plat_dessert
				ON menu.dessert = plat_dessert.id
				WHERE WEEK(date) = :semaine AND YEAR(date) = :annee
				ORDER BY calendrier.date ");
$requete->bindParam(':semaine', $semaine);
$requete->bindParam(':annee', $annee);
$resultat = $requete->execute();
$liste = $requete->fetchAll(PDO::FETCH_ASSOC);

/**
 * constitution des dates du lundi au vendredi inclus (titres colonnes)
 */
$titre_semaine = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi'];

$date_obj = new DateTime();
$date = $date_obj->setISOdate($annee, $semaine + 1)->format('Y/m/d');

if (!empty($liste)) {
	$date = $liste[0]['date'];
}

for ($i = 1; $i < 6; $i++) {
	$rel = $i - date('N', strtotime($date));
	//calcul du lundi avec cet écart
	$titre_semaine[$i] = utf8_encode(strftime('%A %d %B', strtotime("$rel days", strtotime($date))));
}

/**
 * Constitution du tableau des repas / jour semaine
 */
foreach ($liste as $jour_calendrier) {
	$jour = strftime("%u", strtotime($jour_calendrier['date']));
	$tableau_semaine[$jour] = $jour_calendrier;
}

echo "<div class='row my-3'><div class='col'>"
	. "<h1 class='text-center'>"
	. "<a href='index.php?entite=calendrier&semaine=" . $semainePrec . "&annee=" . $anneePrec . "'><i class='fas fa-chevron-left'></i></a> Menu de la semaine "
	. $semaine . "-" . $annee
	. " <a href='index.php?entite=calendrier&semaine=" . $semaineSuiv . "&annee=" . $anneeSuiv . "'><i class='fas fa-chevron-right'></i></a></h1>"
	. "</div></div>";
echo "<div class='row'><div class='col'><a class='btn btn-success my-3 pull-right btn-lg' href='index.php?entite=calendrier&action=ajouter'>Ajouter</a></div></div>";

/**
 * 3ème version 
 */
echo "<div class='row justify-content-between text-center'>";
for ($num_jour = 1; $num_jour < 6; $num_jour++) {
	$color = ($num_jour%2)?"bg-light":"";
	echo "<div class='col-md-2 col-sm-12 $color'>";
	echo "<p><h5  class='bg-dark text-white p-3'>$titre_semaine[$num_jour]</h5></p>";
	if (isset($tableau_semaine[$num_jour])) {
		echo "<p><a class='btn btn-danger m-2' href='index.php?entite=calendrier&action=supprimer&id="
			. $tableau_semaine[$num_jour]['id_calendrier']
			. "' title='supprimer le menu sur cette journée'><i class='fas fa-trash'></i></a>";
		echo "<a class='btn btn-primary m-2' href='index.php?entite=calendrier&action=modifier&id="
			. $tableau_semaine[$num_jour]['id_calendrier']
			. "' title='modifier le menu sur cette journée'><i class='fas fa-pen'></i></a>";
		echo  "<p><img src='"
			. $tableau_semaine[$num_jour]['photo_entree']
			. "' height='100px'></p><p>"
			. $tableau_semaine[$num_jour]['nom_entree']
			. "</p><p><img src='"
			. $tableau_semaine[$num_jour]['photo_plat_principal']
			. "' height='100px'></p><p>"
			. $tableau_semaine[$num_jour]['nom_plat_principal']
			. "</p><p><img src='"
			. $tableau_semaine[$num_jour]['photo_dessert']
			. "' height='100px'></p><p>"
			. $tableau_semaine[$num_jour]['nom_dessert']
			. "</p>";
	} else {
		echo "<p><em>Pas de menu affecté</em></p>";
	}
	echo "</div>";
}
echo "</div>";
echo "</div></div>";


/**
 * 2ème version 
 */
// echo "<div class='row'><div class='col'>";
// echo "<table class='table table-striped table-bordered'>";
// echo "<tr class='text-center'>
// 		<th>Lundi $lundi</th>
// 		<th>Mardi $mardi</th>
// 		<th>Mercredi $mercredi</th>
// 		<th>Jeudi $jeudi</th>
// 		<th>Vendredi $vendredi</th>		
// 		</tr><tr>";

// for ($num_jour = 1; $num_jour < 6; $num_jour++) {
// 	echo "<td class='text-center'>";
// 	if (isset($tableau_semaine[$num_jour])) {
// 		echo "<a class='btn btn-danger m-2' href='index.php?entite=calendrier&action=supprimer&id="
// 			. $tableau_semaine[$num_jour]['id_calendrier']
// 			. "' title='supprimer le menu sur cette journée'><i class='fas fa-trash'></i></a>";
// 		echo "<a class='btn btn-primary m-2' href='index.php?entite=calendrier&action=modifier&id="
// 			. $tableau_semaine[$num_jour]['id_calendrier']
// 			. "' title='modifier le menu sur cette journée'><i class='fas fa-pen'></i></a>";
// 		echo  "<p><img src='"
// 			. $tableau_semaine[$num_jour]['photo_entree']
// 			. "' height='100px'></p><p>"
// 			. $tableau_semaine[$num_jour]['nom_entree']
// 			. "</p><p><img src='"
// 			. $tableau_semaine[$num_jour]['photo_plat_principal']
// 			. "' height='100px'></p><p>"
// 			. $tableau_semaine[$num_jour]['nom_plat_principal']
// 			. "</p><p><img src='"
// 			. $tableau_semaine[$num_jour]['photo_dessert']
// 			. "' height='100px'></p><p>"
// 			. $tableau_semaine[$num_jour]['nom_dessert']
// 			. "</p>";
// 	}
// 	echo "</td>";
// }
// echo "</tr></table>";
// echo "</div></div>";


/**
 * 1ère version 
 */
// echo "<div class='row'><div class='col'>";
// echo "<table class='table table-striped'>";
// echo "<tr>
// 		<th>Id</th>
// 		<th>Semaine</th>
// 		<th>Date</th>
// 		<th>Entrée</th>
// 		<th>Plat</th>
// 		<th>Dessert</th>
// 		<th>Supp</th>
// 		<th>Modif</th>
// 		</tr>";
// foreach ($liste as $jour_calendrier) {
// 	echo "<tr><td>"
// 		. $jour_calendrier['id_calendrier']
// 		. "</td><td>"
// 		. $jour_calendrier['semaine']
// 		. "</td><td>"
// 		. $jour_calendrier['date']
// 		. "</td><td>"
// 		. $jour_calendrier['nom_entree']
// 		. "</td><td>"
// 		. $jour_calendrier['nom_plat_principal']
// 		. "</td><td>"
// 		. $jour_calendrier['nom_dessert']

// 		. "</td><td><a class='btn btn-danger' href='index.php?entite=calendrier&action=supprimer&id="
// 		. $jour_calendrier['id_calendrier']
// 		. "'>Supprimer</a></td>"
// 		. "</td><td><a class='btn btn-primary' href='index.php?entite=calendrier&action=modifier&id="
// 		. $jour_calendrier['id_calendrier']
// 		. "'>Modifier</a></td>"
// 		. "</td></tr>";
// }
// echo "</table>";
// echo "</div></div>";
