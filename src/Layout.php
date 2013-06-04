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
	 * @var SuperHeroParser Le parser de super-héros. Utilisé pour afficher la liste des univers dans le menu.
	 */
	protected $parser;

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
	 * @param SuperHeroParser $parser Le parser de super-héros.
	 */
	public function setParser($parser)
	{
		$this->parser = $parser;
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

		$universes = '';
		foreach($this->parser->retrieveUniverseList() as $universe)
		{
			$url = SecretAvenger::__(SecretAvenger::url('universe', array('slug' => $universe['slug'])));
			$universe = SecretAvenger::__($universe['name']);

			$universes .= <<<EOF
				<li><a href="{$url}" title="Accéder à la liste de tous les super-héros de {$universe}">{$universe}</a></li>

EOF;
		}

		$base = $_SERVER['SECRET_AVENGER_PATH'];
		$homepageUrl = SecretAvenger::url('home');

		echo <<<EOF
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width"/>
		<title>{$title}</title>
		<link rel="stylesheet" type="text/css" href="{$base}/assets/style.css" />
	</head>
	<body>
		<header>
			<a href="{$homepageUrl}" title="Accéder à la page d'accueil">
				<div class="main-title"><strong>Secret Avenger</strong></div>
				<div class="sub-title"><em>La base internationale des super-héros</em></div>
			</a>
		</header>
		<nav>
			<ul>
				<li><a href="{$homepageUrl}" title="Accéder à la page d'accueil">Tous les super-héros</a></li>
{$universes}
			</ul>
		</nav>
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