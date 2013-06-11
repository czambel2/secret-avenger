<?php
$heroes = $parser->retrieveByUniverseSlug($universeSlug);

if(!$heroes)
{
	throw new Avenger404Exception('Aucun héros trouvé pour l\'univers ' . $universeSlug);
}

Layout::getInstance()->addBreadcrumb($heroes[0]->universe, SecretAvenger::__('universe', array('slug' => $universeSlug)));

?>

<ul class="super-hero-list">
	<?php if($heroes): ?>
		<?php foreach ($heroes as $hero): ?>
			<li>
				<a href="<?php echo SecretAvenger::__(SecretAvenger::url('superhero', array('slug' => $hero->slug))); ?>" title="Accéder à la page descriptive de <?php echo SecretAvenger::__($hero); ?>">
					<img src="<?php echo $base; ?>/assets/<?php echo SecretAvenger::__($hero->picture); ?>" alt="<?php echo SecretAvenger::__($hero); ?>" />
					<strong><?php echo SecretAvenger::__($hero); ?></strong>
				</a>
			</li>
		<?php endforeach; ?>
	<?php endif; ?>
</ul>