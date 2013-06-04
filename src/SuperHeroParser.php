<?php

/**
 * Permet d'analyser le XML des super-héros.
 */
class SuperHeroParser
{
	/**
	 * @var DOMDocument Le document XML.
	 */
	protected $xml;

	/**
	 * @var array Le tableau des super-héros.
	 */
	protected $characters;

	/**
	 * Initialise l'analyseur XML.
	 * @param  string           $filename Le chemin du fichier XML à analyser.
	 * @throws AvengerException           Si le fichier n'est pas accessible ou correctement construit.
	 */
	public function __construct($filename = null)
	{
		if (!$filename) {
			$filename = "data/superheroes.xml";
		}

		$this->xml = new DOMDocument();

		if (!$this->xml->load($filename)) {
			throw new AvengerException("Impossible d'analyser le fichier " .
				$filename);
		}

		if (!$this->xml->validate())
		{
			throw new AvengerException("Impossible de valider le fichier " .
				$filename . " par rapport à la DTD. Assurez-vous que le fichier " .
				" soit valide.");
		}

		$this->parse();
	}

	/**
	 * Récupère une propriété "simple" (sans sous-propriétés) d'un super-héros.
	 * @param  DOMElement $superHeroNode Le noeud du super-héros.
	 * @param  string     $property      Le nom de la propriété à récupérer.
	 * @return string                    Le contenu de la propriété.
	 */
	protected function getNodeProperty(DOMElement $superHeroNode, $property)
	{
		return $superHeroNode->getElementsByTagName($property)->item(0)->nodeValue;
	}

	/**
	 * Analyse les super-pouvoirs d'un super-héros.
	 * @param  DOMElement $superHeroNode Le noeud du super-héros.
	 * @return array                     La liste des pouvoirs du super-héros.
	 */
	protected function parseSuperpowers(DOMElement $superHeroNode)
	{
		$superpowersNode = $superHeroNode->getElementsByTagName('superpowers')->item(0);

		$superpowers = array();

		foreach ($superpowersNode->getElementsByTagName('superpower') as $superpowerNode) {
			$superpower = new Superpower();
			$superpower->name = $superpowerNode->nodeValue;
			$superpowers[] = $superpower;
		}

		return $superpowers;
	}

	/**
	 * Analyse les némésis d'un super-héros.
	 * @param  DOMElement $superHeroNode Le noeud du super-héros.
	 * @return array                     La liste des némésis du super-héros.
	 */
	protected function parseNemeses(DOMElement $superHeroNode)
	{
		$nemesesNode = $superHeroNode->getElementsByTagName('nemeses')->item(0);

		$nemeses = array();

		foreach ($nemesesNode->getElementsByTagName('nemesis') as $nemesisNode) {
			$nemesis = new Nemesis();
			$nemesis->nickname = $nemesisNode->nodeValue;
			$nemesis->firstName = $nemesisNode->getAttribute('firstName');
			$nemesis->lastName = $nemesisNode->getAttribute('lastName');
			$nemeses[] = $nemesis;
		}

		return $nemeses;
	}

	/**
	 * Analyse les amants d'un super-héros.
	 * @param  DOMElement $superHeroNode Le noeud du super-héros.
	 * @return array                     La liste des amants du super-héros.
	 */
	protected function parseLovers(DOMElement $superHeroNode)
	{
		$loversNode = $superHeroNode->getElementsByTagName('lovers')->item(0);

		$lovers = array();

		foreach ($loversNode->getElementsByTagName('lover') as $loverNode) {
			$lover = new Lover();
			$lover->nickname = $loverNode->nodeValue;
			$lover->firstName = $loverNode->getAttribute('firstName');
			$lover->lastName = $loverNode->getAttribute('lastName');
			$lovers[] = $lover;
		}

		return $lovers;
	}

	/**
	 * Analyse les amis d'un super-héros.
	 * @param  DOMElement $superHeroNode Le noeud du super-héros.
	 * @return array                     La liste des amis du super-héros.
	 */
	protected function parseSidekicks(DOMElement $superHeroNode)
	{
		$sidekicksNode = $superHeroNode->getElementsByTagName('sidekicks')->item(0);

		$sidekicks = array();

		foreach ($sidekicksNode->getElementsByTagName('sidekick') as $sidekickNode) {
			$sidekick = new Sidekick();
			$sidekick->nickname = $sidekickNode->nodeValue;
			$sidekick->firstName = $sidekickNode->getAttribute('firstName');
			$sidekick->lastName = $sidekickNode->getAttribute('lastName');
			$sidekicks[] = $sidekick;
		}

		return $sidekicks;
	}

	/**
	 * Analse un super-héros.
	 * @param  DOMElement $node Le noeud du super-héros.
	 * @return SuperHero        Le super-héros.
	 */
	protected function parseSuperHero(DOMElement $node)
	{
		$superHero = new SuperHero();

		$superHero->id = $node->getAttribute('id');
		$superHero->wikipediaArticleName = $node->getAttribute('wikipediaArticleName');
		$superHero->slug = $node->getAttribute('slug');

		// Récupération des données statiques
		foreach (array(
			         'nickname',
			         'firstName',
			         'lastName',
			         'universe',
			         'description',
			         'picture',
		         ) as $property) {
			$superHero->$property = $this->getNodeProperty($node, $property);
		}

		$superHero->universeSlug = $node->getElementsByTagName('universe')->item(0)->getAttribute('slug');

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

		if ($superHeroesTags->length != 1) {
			throw new AvengerException("Malformation du fichier XML : il
			   manque le noeud racine <superheroes>, ou il y en a plusieurs.");
		}

		$superHeroesTag = $superHeroesTags->item(0);
		$superHeroes = $superHeroesTag->getElementsByTagName('superhero');

		$characters = array();

		// Parcours de la liste des super-héros trouvés
		foreach ($superHeroes as $superHero) {
			$character = $this->parseSuperHero($superHero);
			$id = $character->id;
			$characters[$id] = $character;
		}

		$this->characters = $characters;
	}

	/**
	 * Tente de récupérer un super-héros par son identifiant.
	 * @param  int       $id       L'identifiant du super-héros à récupérer.
	 * @return SuperHero           Le super-héros récupéré.
	 * @throws Avenger404Exception Si aucun super-héros correspondant n'est trouvé.
	 */
	public function getSuperHeroById($id)
	{
		if (array_key_exists($id, $this->characters))
		{
			return $this->characters[$id];
		}
		else
		{
			throw new Avenger404Exception("Impossible de charger le héros numéro $id.");
		}
	}

	/**
	 * Tente de récupérer un super-héros par son nom interne.
	 * @param  string    $slug     Le nom interne du super-héros à récupérer.
	 * @return SuperHero           Le super-héros récupéré.
	 * @throws Avenger404Exception Si aucun super-héros correspondant n'est trouvé.
	 */
	public function getSuperHeroBySlug($slug)
	{
		foreach($this->characters as $character)
		{
			if($character->slug == $slug)
			{
				return $character;
			}
		}

		throw new Avenger404Exception("Impossible de charger le héros de slug $slug.");
	}

	/**
	 * Récupère tous les super-héros.
	 * @return array Le tableau contenant tous les super-héros.
	 */
	public function getAll()
	{
		return $this->characters;
	}

	/**
	 * Récupère tous les super-héros d'un univers donné.
	 * @param  string $universe L'univers.
	 * @return array            Le tableau contenant tous les super-héros de l'univers donné.
	 */
	public function retrieveByUniverse($universe)
	{
		$characters = array();
		foreach($this->getAll() as $character)
		{
			if($character->universe == $universe)
			{
				$characters[] = $character;
			}
		}
		return $characters;
	}

	/**
	 * Récupère tous les super-héros d'un univers donné.
	 * @param  string $universeSlug Le nom interne de l'univers.
	 * @return array                Le tableau contenant tous les super-héros de l'univers donné.
	 */
	public function retrieveByUniverseSlug($universeSlug)
	{
		$characters = array();
		foreach($this->getAll() as $character)
		{
			if($character->universeSlug == $universeSlug)
			{
				$characters[] = $character;
			}
		}
		return $characters;
	}

	/**
	 * Récupère la liste de tous les univers possibles.
	 * @return array La liste de tous les univers possibles.
	 *
	 * Cette fonction retourne un tableau de tableaux. Chaque sous-tableau contient un élément `name' contenant
	 *  le nom de l'univers (e.g. Marvel) et un élément `slug' contenant le nom interne de l'unviers (e.g. marvel).
	 */
	public function retrieveUniverseList()
	{
		$universes = array();
		foreach($this->getAll() as $character)
		{
			$universe = array('name' => $character->universe, 'slug' => $character->universeSlug);
			if(!in_array($universe, $universes))
			{
				$universes[] = $universe;
			}
		}
		return $universes;
	}
}
