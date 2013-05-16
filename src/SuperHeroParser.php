<?php

class SuperHeroParser
{
	/**
	 * @var DOMDocument
	 */
	protected $xml;

	public $characters;

	function __construct($filename = null)
	{
		if(!$filename)
		{
			$filename = "data/superheroes.xml";
		}

		$this->xml = new DOMDocument();

		if(!$this->xml->load($filename))
		{
			throw new AvengerException("Impossible d'analyser le fichier " .
			                            $filename);
		}

		$this->parse();
	}

	protected function getNodeProperty(DOMElement $superHeroNode, $property)
	{
		return $superHeroNode->getElementsByTagName($property)->item(0)->nodeValue;
	}

	protected function parseSuperpowers(DOMElement $superHeroNode)
	{
		$superpowersNode = $superHeroNode->getElementsByTagName('superpowers')->item(0);

		$superpowers = array();

		foreach($superpowersNode->getElementsByTagName('superpower') as $superpowerNode)
		{
			$superpower = new Superpower();
			$superpower->name = $superpowerNode->nodeValue;
			$superpowers[] = $superpower;
		}

		return $superpowers;
	}

	protected function parseNemeses(DOMElement $superHeroNode)
	{
		$nemesesNode = $superHeroNode->getElementsByTagName('nemeses')->item(0);

		$nemeses = array();

		foreach($nemesesNode->getElementsByTagName('nemesis') as $nemesisNode)
		{
			$nemesis = new Nemesis();
			$nemesis->nickname = $nemesisNode->nodeValue;
			$nemesis->firstName = $nemesisNode->getAttribute('firstName');
			$nemesis->lastName = $nemesisNode->getAttribute('lastName');
			$nemeses[] = $nemesis;
		}

		return $nemeses;
	}

	protected function parseLovers(DOMElement $superHeroNode)
	{
		$loversNode = $superHeroNode->getElementsByTagName('lovers')->item(0);

		$lovers = array();

		foreach($loversNode->getElementsByTagName('lover') as $loverNode)
		{
			$lover = new Lover();
			$lover->nickname = $loverNode->nodeValue;
			$lover->firstName = $loverNode->getAttribute('firstName');
			$lover->lastName = $loverNode->getAttribute('lastName');
			$lovers[] = $lover;
		}

		return $lovers;
	}

	protected function parseSidekicks(DOMElement $superHeroNode)
	{
		$sidekicksNode = $superHeroNode->getElementsByTagName('sidekicks')->item(0);

		$sidekicks = array();

		foreach($sidekicksNode->getElementsByTagName('sidekick') as $sidekickNode)
		{
			$sidekick = new Sidekick();
			$sidekick->nickname = $sidekickNode->nodeValue;
			$sidekick->firstName = $sidekickNode->getAttribute('firstName');
			$sidekick->lastName = $sidekickNode->getAttribute('lastName');
			$sidekicks[] = $sidekick;
		}

		return $sidekicks;
	}

	protected function parseSuperHero(DOMElement $node)
	{
		$superHero = new SuperHero();

		// Récupération des données statiques
		foreach(array(
			'nickname',
			'firstName',
			'lastName',
			'universe',
			'picture',
				) as $property)
		{
			$superHero->$property = $this->getNodeProperty($node, $property);
		}

		// Récupération des données objet
		$superHero->superpowers = $this->parseSuperpowers($node);
		$superHero->nemeses = $this->parseNemeses($node);
		$superHero->lovers = $this->parseLovers($node);
		$superHero->sidekicks = $this->parseSidekicks($node);

		return $superHero;
	}

	/**
	 * Analyse le fichier XML chargé dans $this->xml et récupère une liste de
	 * super-héros.
	 */
	protected function parse()
	{
		// Récupération du noeud parent 'superheroes'
		$superHeroesTags = $this->xml->getElementsByTagName('superheroes');

		if($superHeroesTags->length != 1)
		{
			throw new AvengerException("Malformation du fichier XML : il
			   manque le noeud racine <superheroes>, ou il y en a plusieurs.");
		}

		$superHeroesTag = $superHeroesTags->item(0);
		$superHeroes = $superHeroesTag->getElementsByTagName('superhero');

		$characters = array();

		// Parcours de la liste des super-héros trouvés
		foreach($superHeroes as $superHero)
		{
			$characters[] = $this->parseSuperHero($superHero);
		}

		$this->characters = $characters;
	}
}
