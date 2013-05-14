<?php

class SuperHeroParser
{
	/**
	 * @var DomDocument
	 */
	protected $xml;

	function __construct($filename = null)
	{
		if(!$filename)
		{
			$filename = "../data/superheroes.xml";
		}

		$this->xml = new DomDocument();

		if(!$this->xml->load($filename))
		{
			throw new AvengerException("Impossible d'analyser le fichier $filename");
		}

		$this->parse();
	}

	/**
	 * Analyse le fichier XML chargé dans $this->xml et récupère une liste de super-héros.
	 */
	protected function parse()
	{
		$superheroes = $this->xml->getElementsByTagName('superhero');

		// Parcourt la liste des super-héros trouvés
		foreach($superheroes as $superhero)
		{
			$character = new SuperHero();
			
			foreach($superhero->childNodes as $childNode)
			{
				if($childNode->nodeType == XML_ELEMENT_NODE)
				{
					foreach($childNode->childNodes as $node)
					{
						if($node->nodeType == XML_ELEMENT_NODE)
						{
							echo 'CONTENEUR';// $node;
						}
					}
				
					echo $childNode->nodeName . " => " . $childNode->nodeValue . "<br />";
				}
			}
			
			$character->nickname = $superhero->getElementsByTagName('nickname');
		}
	}
}
