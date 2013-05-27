<?php

/**
 * Représente un ami.
 *
 * @property string $nickname  Le pseudonyme de l'ami.
 * @property string $firstName Le prénom de l'ami.
 * @property string $lastName  Le nom de famille de l'ami.
 */
class Sidekick extends SuperThing
{
	protected $nickname;
	protected $firstName;
	protected $lastName;

	/**
	 * @return string La représentation en chaîne de caractères de l'ami.
	 */
	public function __toString()
	{
		return $this->nickname ?: $this->firstName . " " . $this->lastName;
	}
}
