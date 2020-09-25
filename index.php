<?php

/**
 * Paramétrage de l'application
 */
setlocale(LC_TIME, "fr_FR");
/**
 * Analyse des paramètres de la requête HTTP
 */
if (isset($_GET['entite'])) {
	$entite = $_GET['entite'];
} else {
	$entite = "calendrier";
}

if (isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	$action = "liste";
}

/**
 * Routing
 */
include 'connect.php';

switch ($action) {
	case 'liste':
		$page = $entite . '/liste.php';
		break;

	case 'ajouter':
		$page = $entite . '/ajouter.php';
		break;

	case 'ajoutBDD':
		$page = $entite . '/ajoutBDD.php';
		break;

	case 'modifier':
		$page = $entite . '/modifier.php';
		break;

	case 'modifBDD':
		$page = $entite . '/modifBDD.php';
		break;

	case 'supprimer':
		$page = $entite . '/supprimer.php';
		break;

	case 'formMail':
		$page = $entite . '/formMail.php';
		break;

	case 'envoiMail':
		$page = $entite . '/envoiMail.php';
		break;

	default:
		echo "erreur 404";
		die;
		break;
}

/**
 * Construction de la page HTML
 */

include 'includes/head.php';
include 'includes/nav.php';
include $page;
include 'includes/footer.php';
