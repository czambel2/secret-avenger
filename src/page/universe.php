<?php
$heroes = $parser->retrieveByUniverseSlug($universeSlug);
?>

<ul class="super-hero-list">
	<?php if($heroes): ?>
		<?php foreach ($heroes as $hero): ?>
			<li>
				<a href="<?php echo SecretAvenger::__(SecretAvenger::url('superhero', array('slug' => $hero->slug))); ?>" title="Accéder à la page descriptive de <?php echo $hero; ?>">
					<img src="<?php echo $base; ?>/assets/<?php echo $hero->picture; ?>" alt="<?php echo $hero; ?>" />
					<h2><?php echo $hero; ?></h2>
				</a>
			</li>
		<?php endforeach; ?>
	<?php else: ?>
		<div class="empty">
			Aucun super-héros trouvé pour l'univers <?php echo $universeSlug; ?>.
		</div>
	<?php endif; ?>
</ul>