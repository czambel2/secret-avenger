<?php

/**
 * Contient diverses fonctions utiles.
 */
abstract class SecretAvenger
{
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