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
			$filename = "../data/superheroes.xml";
		}

		$this->xml = new DOMDocument();

		if(!$this->xml->load($filename))
		{
			throw new AvengerException("Impossible d'analyser le fichier " .
			                           $filename);
		}

		$this->parse();
	}

	protected function parseSuperHero(DOMElement $superHeroNode)
	{
		$superHero = new SuperHero();

		foreach($superHeroNode->childNodes as $node)
		{
			if($node->nodeType == XML_ELEMENT_NODE)
			{
				$name = $node->nodeName;
				$value = $this->parseNode($node);

				$superHero->$name = $value;
			}
		}

		return $superHero;
	}

	protected function parseNode(DOMNode $node)
	{
		$singleValue = null;
		$values = array();

		// Parcours de tous les fils du noeud
		foreach($node->childNodes as $childNode)
		{
			// Si le noeud contient des éléments fils, on les analyse à leur
			// tour
			if($childNode->nodeType == XML_ELEMENT_NODE)
			{
				$values[] = $this->parseNode($childNode);
			}
			// Si le noeud contient du texte, on le récupère
			elseif($childNode->nodeType == XML_ATTRIBUTE_NODE or
			       $childNode->nodeType == XML_TEXT_NODE)
			{
				// On ne récupère pas les noeuds de whitespace
				if(trim($childNode->nodeValue) != "")
				{
					$singleValue = $childNode->nodeValue;
				}
			}
		}

		// php 5.3 : return $singleValue ?: $values;
		return count($values) ? $values : $singleValue;
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
