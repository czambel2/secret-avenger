<?php

class SuperThing
{
	protected $attributes;
	
	public function addAttribute($name, $value)
	{
		$this->attributes[$name] = $value;
		return $this;
	}
}
