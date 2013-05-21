<?php

class Layout
{
	protected $title;
	protected static $instance;

	protected function __construct($title = null)
	{
		$this->title = $title;
		ob_start();
	}

	public function setTitle($title = null)
	{
		$this->title = $title;
	}

	public static function getInstance()
	{
		if (!self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}


	public function __destruct()
	{
		$contents = ob_get_clean();

		$title = $this->title ? $this->title . ' - SecretAvenger' : 'SecretAvenger : la base des super-héros';

		echo <<<EOF
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8" />
		<title>{$title}</title>
		<link rel="stylesheet" type="text/css" href="assets/style.css" />
	</head>
	<body>
		<header>
			<a href="." title="Accéder à la page d'accueil">
				<h1>SecretAvenger</h1>
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