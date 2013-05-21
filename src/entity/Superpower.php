<?php

class Superpower extends SuperThing
{
	protected $name;

	public function __toString()
	{
		return $this->name;
	}
}