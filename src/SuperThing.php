<?php

class SuperThing
{
	/**
	 * Méthode magique permettant d'utiliser la syntaxe très agréable $object->property.
	 * @param  string $name     Le nom de la propriété à récupérer.
	 * @return mixed            La valeur de la propriété à récupérer.
	 * @throws AvengerException Si la propriété $name n'existe pas dans la classe courante.
	 */
	public function __get($name)
	{
		if(property_exists(get_class($this), $name))
		{
			return $this->$name;
		}
		else
		{
			throw new AvengerException('Impossible de récupérer la propriété ' . get_class($this) . '::' . $name);
		}
	}

	/**
	 * Méthode magique permettant d'utiliser la syntaxe très agréable $object->property.
	 * @param  string $name     Le nom de la propriété à définir.
	 * @param  mixed  $value    La valeur de la propriété à définir.
	 * @return        $this     Interface fluente.
	 * @throws AvengerException Si la propriété $name n'existe pas dans la classe courante.
	 */
	public function __set($name, $value)
	{
		if(property_exists(get_class($this), $name))
		{
			$this->$name = $value;
			return $this;
		}
		else
		{
			throw new AvengerException('Impossible de récupérer la propriété ' . get_class($this) . '::' . $name);
		}
	}
}
