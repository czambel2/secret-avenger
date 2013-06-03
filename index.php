<?php

require_once 'src/autoload.php';

$parser = new SuperHeroParser();

// Affectation du parser dans le layout, ce qui permet d'afficher la liste des univers possibles
Layout::getInstance()->setParser($parser);

$page = array_key_exists('page', $_GET) ? $_GET['page'] : 'home';

switch ($page) {
	case 'home':      // Page d'accueil
	case 'superhero': // Page dédiée à un super-héros
	case 'universe':  // Page listant tous les super-héros d'un univers
		require_once('src/page/' . $page . '.php');
		break;
	default:          // Page de message d'erreur
		require_once('src/page/not-found-404.php');
		break;
}