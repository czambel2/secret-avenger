<?php

/**
 * Tente de charger la classe passée en paramètre en incluant le fichier correspondant.
 * @param string $className Le nom de la classe à charger.
 */
function autoload($className)
{
	$directories = array('src/', 'src/entity/');

	foreach ($directories as $directory) {
		$filename = $directory . $className . '.php';

		if (file_exists($filename)) {
			require_once($filename);
		}
	}
}

spl_autoload_register('autoload');