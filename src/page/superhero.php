<?php

// On vérifie que l'identifiant a bien été fourni en paramètre
if(!array_key_exists('id', $_GET) or !is_numeric($id = $_GET['id']))
{
	throw new Avenger404Exception("Le super-héros n'a pas été fourni en paramètre.");
}

$parser = new SuperHeroParser();
$superhero = $parser->getSuperHeroById($id);

?>

	<section class="main">
		<img class="thumbnail" src="assets/<?php echo $superhero->picture; ?>" alt="<?php echo $superhero->nickname; ?>" />
		<aside class="identity-card">
			<h2>
				<?php echo $superhero->nickname; ?>

				<?php if($superhero->getRealName()): ?>
					<small>(<?php echo $superhero->getRealName(); ?>)</small>
				<?php endif; ?>
			</h2>
			<p>Super-héros de <?php echo $superhero->universe; ?></p>
			<p class="description">
				<?php echo $superhero->description; ?>
			</p>
		</aside>
		<div class="characteristics"><?php
			if($superhero->superpowers): ?><aside class="superpowers">
				<h3>Pouvoirs de <?php echo $superhero; ?></h3>
				<ul>
					<?php foreach($superhero->superpowers as $superpower): ?>
						<li><?php echo $superpower; ?></li>
					<?php endforeach; ?>
				</ul>
			</aside><?php endif;
			if($superhero->nemeses): ?><aside class="nemeses">
				<h3>Némésis de <?php echo $superhero; ?></h3>
				<ul>
					<?php foreach($superhero->nemeses as $nemesis): ?>
						<li><?php echo $nemesis; ?></li>
					<?php endforeach; ?>
				</ul>
			</aside><?php endif;
			if($superhero->lovers): ?><aside class="lovers">
				<h3>Amants de <?php echo $superhero; ?></h3>
				<ul>
					<?php foreach($superhero->lovers as $lover): ?>
						<li><?php echo $lover; ?></li>
					<?php endforeach; ?>
				</ul>
			</aside><?php endif;
			if($superhero->sidekicks): ?><aside class="sidekicks">
				<h3>Amis de <?php echo $superhero; ?></h3>
				<ul>
					<?php foreach($superhero->sidekicks as $sidekick): ?>
						<li><?php echo $sidekick; ?></li>
					<?php endforeach; ?>
				</ul>
			</aside><?php endif;
		?></div>
	</section>

	<div class="disclaimer">
		<a href="http://creativecommons.org/licenses/by-sa/3.0/deed.fr">Contenu soumis à la licence CC-BY-SA</a>.
		Source&nbsp;: Article <em><a href="http://fr.wikipedia.org/wiki/<?php echo $superhero->getWikipediaArticleSlug(); ?>"><?php echo $superhero->wikipediaArticleName; ?></a></em>
		de <a href="http://fr.wikipedia.org/">Wikipédia en français</a>
		(<a href="http://fr.wikipedia.org/w/index.php?title=<?php echo $superhero->getWikipediaArticleSlug(); ?>&action=history">auteurs</a>)
	</div>