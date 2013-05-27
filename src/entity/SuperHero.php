<?php

/**
 * Représente un super-héros.
 *
 * @property int    $id          L'idenifiant du super-héros.
 * @property string $nickname    Le pseudonyme du super-héros.
 * @property string $firstName   Le prénom du super-héros.
 * @property string $lastName    Le nom de famille du super-héros.
 * @property string $universe    L'univers d'origine du super-héros.
 * @property string $description La description du super-héros.
 * @property string $picture     L'image du super-héros.
 * @property array  $superpowers Les super-pouvoirs du super-héros.
 * @property array  $nemeses     Les némésis du super-héros.
 * @property array  $lovers      Les amants du super-héros.
 * @property array  $sidekicks   Les amis du super-héros.
 */
class SuperHero extends SuperThing
{
	protected $id;
	protected $nickname;
	protected $firstName;
	protected $lastName;
	protected $universe;
	protected $description;
	protected $picture;
	protected $superpowers;
	protected $nemeses;
	protected $lovers;
	protected $sidekicks;

	/**
	 * Initialise les tableaux du super-héros.
	 */
	public function __contruct()
	{
		$this->superpowers = array();
		$this->nemeses = array();
		$this->lovers = array();
		$this->sidekicks = array();
	}

	/**
	 * @return string Le nom réel du super-héros.
	 */
	public function getRealName()
	{
		return $this->firstName . " " . $this->lastName;
	}

	/**
	 * @return string La représentation en chaîne de caractères du super-héros.
	 */
	public function __toString()
	{
		return $this->nickname ? $this->nickname : $this->firstName . " " . $this->lastName;
	}
}
