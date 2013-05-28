<?php

/**
 * Représente le modèle de page.
 */
class Layout
{
	/**
	 * @var string Le titre de la page. (balise <title />)
	 */
	protected $title;

	/**
	 * @var Layout L'instance de Layout (singleton).
	 */
	protected static $instance;

	/**
	 * Construit un nouvel objet Layout.
	 *
	 * Le constructeur ne doit être appelé qu'en interne. Sinon, il faut utiliser Layout::getInstance() pour récupérer
	 *  l'instance singleton.
	 *
	 * @param string $title Le titre de la page.
	 */
	protected function __construct($title = null)
	{
		$this->title = $title;
		ob_start();
	}

	/**
	 * @param string $title Le titre de la page.
	 */
	public function setTitle($title = null)
	{
		$this->title = $title;
	}

	/**
	 * @return Layout L'instance actuelle de Layout.
	 */
	public static function getInstance()
	{
		if (!self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Affiche à l'écran le contenu du tampon.
	 */
	public function __destruct()
	{
		$contents = ob_get_clean();

		$title = $this->title ? $this->title . ' - SecretAvenger' : 'SecretAvenger : la base des super-héros';

		echo <<<EOF
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width" />
		<title>{$title}</title>
		<link rel="stylesheet" type="text/css" href="assets/style.css" />
	</head>
	<body>
		<header>
			<a href="." title="Accéder à la page d'accueil">
				<h1>Secret Avenger</h1>
				<p>La base internationale des super-héros</p>
			</a>
		</header>
		<!-- <nav>
			<ul>
				<li><a href="." title="Accéder à la page d'accueil">Accueil</a></li>
			</ul>
		</nav> -->
		{$contents}
		<footer>
			<p>
				Secret-Avenger est un projet universitaire de l'<a href="http://www.utbm.fr/"
				title="Se rendre sur le site de l'Université de Technologie de Belfort-Montbéliard">Université de
				Technologie de Belfort-Montbéliard</a>.
			</p>
			<p>
				Les héros représentés dans ces pages sont des marques déposées de leurs propriétaires respectifs.
			</p>
		</footer>
	</body>
</html>
EOF;
	}
}