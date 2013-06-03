<?php

// On récupère la liste de tous les super-héros d'un univers
$universe = urldecode($_GET['u']);
$heroes = $parser->retrieveByUniverse($universe);
?>

<ul class="super-hero-list">
	<?php if($heroes): ?>
		<?php foreach ($heroes as $hero): ?>
			<li>
				<a href="<?php echo SecretAvenger::__(SecretAvenger::url('superhero', array('id' => $hero->id))); ?>" title="Accéder à la page descriptive de <?php echo $hero; ?>">
					<img src="assets/<?php echo $hero->picture; ?>" alt="<?php $hero->nickname; ?>" />
					<h2><?php echo $hero->nickname; ?></h2>
				</a>
			</li>
		<?php endforeach; ?>
	<?php else: ?>
		<div class="empty">
			Aucun super-héros trouvé pour l'univers <?php echo $universe; ?>.
		</div>
	<?php endif; ?>
</ul>