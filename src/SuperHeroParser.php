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
		
		$xml = new DomDocument();
		
		if(!$xml->load($filename))
		{
			throw new AvengerException("Impossible d'analyser le fichier $filename");
		}
		
		$this->parse();
	}
	
	/**
	 * Analyse le fichier XML chargé dans $xml et récupère une liste de super-héros.
	 */
	protected function parse()
	{
		$superheroes = $xml->getElementsByTagName('superhero');
		
		// Parcourt la liste des super-héros trouvés
		foreach($superheroes as $superhero)
		{
			$sh = new SuperHero();
			
			
			
			$sh->nickname = $superhero->getElementsByTagName('nickname');
		}
	}
	
	protected function parseSubItems($parentNode, $character)
	{
		foreach($parentNode->childNodes as $node)
		{
			if($node->childNodes instanceof DOMNodeList and $node->length > 0)
			{
				// Le noeud contient des fils : tableau d'éléments
				// On analyse tous les fils les uns après les autres
				return $this->parseSubItems($node->nodeName, $node->$nodeValue);
			}
			else
			{
				// Le noeud ne contient pas de fils
				// On envoie directement l'attribut dans le personnage
				$character->addAttribute($node->nodeName, $node->nodeValue);
			}
		}
	}
	
	public function 
	
	
}
