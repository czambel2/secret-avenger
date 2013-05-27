<?php

/**
 * Représente un amant.
 *
 * @property string $nickname  Le pseudonyme de l'amant.
 * @property string $firstName Le prénom de l'amant.
 * @property string $lastName  Le nom de famille de l'amant.
 */
class Lover extends SuperThing
{
	protected $nickname;
	protected $firstName;
	protected $lastName;

	/**
	 * @return string La représentation en chaîne de caractères de l'amant.
	 */
	public function __toString()
	{
		return $this->nickname ?: $this->firstName . " " . $this->lastName;
	}
}
