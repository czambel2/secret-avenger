<?php

class Lover extends SuperThing
{
	protected $nickname;
	protected $firstName;
	protected $lastName;

	public function __toString()
	{
		return $this->nickname ?: $this->firstName . " " . $this->lastName;
	}
}
