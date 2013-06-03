<?php

/**
 * Contient diverses fonctions utiles.
 */
abstract class SecretAvenger
{
	/**
	 * Échappe une chaîne de caractères pour un affichage sur une page HTML.
	 * @param  string $url La chaîne de caractères à échapper.
	 * @return string      La chaîne de caractères échappée.
	 */
	public static function __($url)
	{
		return htmlspecialchars($url);
	}

	/**
	 * Génère une URL.
	 * @param  string $page Le nom de la page à afficher.
	 * @param  array  $args Les arguments de la page à afficher.
	 * @return string       L'URL.
	 */
	public static function url($page, $args = array())
	{
		$url = 'index.php?page=' . urlencode($page);

		foreach($args as $key => $value)
		{
			$url .= '&' . urlencode($key) . '=' . urlencode($value);
		}

		return $url;
	}
}