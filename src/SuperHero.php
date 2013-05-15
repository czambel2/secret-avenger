<?php

class SuperHero extends SuperThing
{
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
		foreach($this as $key => $value)
		{
			$v[$key] = $value;
		}
		var_dump($v);
	}
}
