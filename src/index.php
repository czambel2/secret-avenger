<?php

require_once 'autoload.php';

if(php_sapi_name() != 'cli') echo '<pre style="font-family: Consolas, Inconsolata, monospace">';

$parser = new SuperHeroParser();

foreach($parser->characters as $character)
{
	$character->dump();
}
