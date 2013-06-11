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

// Forcer le chargement de la classe SecretAvenger (elle est nécessaire pour le destructeur de Layout)
autoload('SecretAvenger');

// Récupérer les exceptions lancées, et les afficher à l'écran
set_exception_handler(function(Exception $exception)
{
	// On supprime le contenu du buffer, pour éviter d'afficher des pages à demi-générées
	ob_end_clean();

	// On modifie le layout
	Layout::getInstance()->setLayout(Layout::TINY_LAYOUT);

	// On envoie les codes de statut HTTP correspondants
	if($exception instanceof Avenger404Exception)
	{
		header("HTTP/1.0 404 Not Found");
		require_once('src/page/not-found-404.php');
		exit;
	}
	else
	{
		header("HTTP/1.0 500 Internal Server Error");
	}

	echo <<<EOF
	<div class="something-horrible">
		<h1>Une erreur est survenue !</h1>
		<p>
			{$exception->getMessage()}
		</p>
	</div>
EOF;

});