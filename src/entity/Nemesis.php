<?php

/**
 * @property string $nickname
 * @property string $firstName
 * @property string $lastName
 */
class Nemesis extends SuperThing
{
	protected $nickname;
	protected $firstName;
	protected $lastName;

	public function __toString()
	{
		return $this->nickname ?: $this->firstName . " " . $this->lastName;
	}
}
