<?php

/**
 * Représente une némésis.
 *
 * @property string $nickname  Le pseudonyme de la némésis.
 * @property string $firstName Le prénom de la némésis.
 * @property string $lastName  Le nom de famille de la némésis.
 */
class Nemesis extends SuperThing
{
	protected $nickname;
	protected $firstName;
	protected $lastName;

	/**
	 * @return string La représentation en chaîne de caractères de la némésis.
	 */
	public function __toString()
	{
		return $this->nickname ?: $this->firstName . " " . $this->lastName;
	}
}
