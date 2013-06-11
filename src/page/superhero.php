<?php

$superhero = $parser->getSuperHeroBySlug($superHeroSlug);

Layout::getInstance()
	->addBreadcrumb($superhero->universe, SecretAvenger::url('universe', array('slug' => $superhero->universeSlug)))
	->addBreadcrumb($superhero->__toString(), SecretAvenger::url('superhero', array('slug' => $superhero->slug)));

?>

	<section class="main">
		<div class="thumbnail">
			<img src="<?php echo $base; ?>/assets/<?php echo SecretAvenger::__($superhero->picture); ?>"
			     alt="<?php echo SecretAvenger::__($superhero->nickname); ?>" />
		</div>
		<article class="identity-card">
			<h1>
				<?php echo SecretAvenger::__($superhero->nickname); ?>

				<?php if($superhero->getRealName()): ?>
					<span>(<?php echo SecretAvenger::__($superhero->getRealName()); ?>)</span>
				<?php endif; ?>
			</h1>
			<p>Super-héros de <?php echo SecretAvenger::__($superhero->universe); ?></p>
			<p class="description">
				<?php echo SecretAvenger::__($superhero->description); ?>
			</p>
		</article>
		<div class="characteristics"><?php
			if($superhero->superpowers): ?><aside class="superpowers">
				<h3>Pouvoirs de <?php echo SecretAvenger::__($superhero); ?></h3>
				<ul>
					<?php foreach($superhero->superpowers as $superpower): ?>
						<li><?php echo SecretAvenger::__($superpower); ?></li>
					<?php endforeach; ?>
				</ul>
			</aside><?php endif;
			if($superhero->nemeses): ?><aside class="nemeses">
				<h3>Némésis de <?php echo SecretAvenger::__($superhero); ?></h3>
				<ul>
					<?php foreach($superhero->nemeses as $nemesis): ?>
						<li><?php echo SecretAvenger::__($nemesis); ?></li>
					<?php endforeach; ?>
				</ul>
			</aside><?php endif;
			if($superhero->lovers): ?><aside class="lovers">
				<h3>Amants de <?php echo SecretAvenger::__($superhero); ?></h3>
				<ul>
					<?php foreach($superhero->lovers as $lover): ?>
						<li><?php echo SecretAvenger::__($lover); ?></li>
					<?php endforeach; ?>
				</ul>
			</aside><?php endif;
			if($superhero->sidekicks): ?><aside class="sidekicks">
				<h3>Amis de <?php echo SecretAvenger::__($superhero); ?></h3>
				<ul>
					<?php foreach($superhero->sidekicks as $sidekick): ?>
						<li><?php echo SecretAvenger::__($sidekick); ?></li>
					<?php endforeach; ?>
				</ul>
			</aside><?php endif;
		?></div>
	</section>

	<div class="disclaimer">
		<a title="Accéder à la page descriptive de la licence Creative Commons CC-BY-SA" href="http://creativecommons.org/licenses/by-sa/3.0/deed.fr">Contenu soumis à la licence CC-BY-SA</a>.
		Source&#160;: Article <em><a title="Accéder à l'article Wikipédia de <?php echo SecretAvenger::__($superhero); ?>" href="http://fr.wikipedia.org/wiki/<?php echo SecretAvenger::__($superhero->getWikipediaArticleSlug()); ?>"><?php echo SecretAvenger::__($superhero->wikipediaArticleName); ?></a></em>
		de <a title="Accéder à la page d'accueil de Wikipédia en français" href="http://fr.wikipedia.org/">Wikipédia en français</a>
		(<a title="Accéder à l'historique des modifications de l'article Wikipédia de <?php echo SecretAvenger::__($superhero); ?>" href="http://fr.wikipedia.org/w/index.php?title=<?php echo SecretAvenger::__($superhero->getWikipediaArticleSlug()); ?>&amp;action=history">auteurs</a>)
	</div>