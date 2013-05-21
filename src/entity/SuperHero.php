<?php

/**
 * @property int    $id
 * @property string $nickname
 * @property string $firstName
 * @property string $lastName
 * @property string $universe
 * @property string $picture
 * @property array  $superpowers
 * @property array  $nemeses
 * @property array  $lovers
 * @property array  $sidekicks
 */
class SuperHero extends SuperThing
{
	protected $id;
	protected $nickname;
	protected $firstName;
	protected $lastName;
	protected $universe;
	protected $picture;
	protected $superpowers;
	protected $nemeses;
	protected $lovers;
	protected $sidekicks;

	public function dump()
	{
		$v = array();
		foreach ($this as $key => $value) {
			$v[$key] = $value;
		}
		var_dump($v);
	}

	public function __contruct()
	{
		$this->superpowers = array();
		$this->nemeses = array();
		$this->lovers = array();
		$this->sidekicks = array();
	}
}
