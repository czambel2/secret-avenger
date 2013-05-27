<?php

// On récupère la liste de tous les super-héros
$parser = new SuperHeroParser();

$heroes = $parser->getAll();

?>

<ul class="super-hero-list">
	<?php foreach ($heroes as $hero): ?><li>
		<a href="<?php echo SecretAvenger::url('superhero', array('id' => $hero->id)); ?>" title="Accéder à la page descriptive de <?php echo $hero; ?>">
			<img src="assets/<?php echo $hero->picture; ?>" alt="<?php $hero->nickname; ?>" />
			<h2><?php echo $hero->nickname; ?></h2>
		</a>
	</li><?php endforeach; ?>
</ul>