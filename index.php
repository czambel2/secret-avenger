<?php

require_once 'src/autoload.php';

$parser = new SuperHeroParser();

// Affectation du parser dans le layout, ce qui permet d'afficher la liste des univers possibles
Layout::getInstance()->setParser($parser);

// On récupère l'URL demandée par l'utilisateur
$queryString = $_SERVER['REQUEST_URI'];
$base = $_SERVER['SECRET_AVENGER_PATH'];

// On enlève de l'URL l'éventuel préfixe du chemin
$queryString = str_replace($base, '', $queryString);

if(preg_match('#^/$#', $queryString))
{
	require_once('src/page/home.php');
}
elseif(preg_match('#^/([a-z0-9-]+)\.html$#', $queryString, $matches))
{
	$superHeroSlug = $matches[1];
	require_once('src/page/superhero.php');
}
elseif(preg_match('#^/universe/([a-z0-9-]+)\.html$#', $queryString, $matches))
{
	$universeSlug = $matches[1];
	require_once('src/page/universe.php');
}