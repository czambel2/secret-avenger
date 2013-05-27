<?php

/**
 * Représente un super-pouvoir.
 *
 * @property string $name Le nom du super-pouvoir.
 */
class Superpower extends SuperThing
{
	protected $name;

	/**
	 * @return string La représentation en chaîne de caractères du super-pouvoir.
	 */
	public function __toString()
	{
		return $this->name;
	}
}