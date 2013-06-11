<?php

// On récupère la liste de tous les super-héros
$heroes = $parser->getAll();

?>

<ul class="super-hero-list">
	<?php foreach ($heroes as $hero): ?><li>
		<a href="<?php echo SecretAvenger::__(SecretAvenger::url('superhero', array('slug' => $hero->slug))); ?>" title="Accéder à la page descriptive de <?php echo SecretAvenger::__($hero); ?>">
			<img src="<?php echo $base; ?>/assets/<?php echo SecretAvenger::__($hero->picture); ?>" alt="<?php echo SecretAvenger::__($hero); ?>" />
			<strong><?php echo SecretAvenger::__($hero); ?></strong>
		</a>
	</li><?php endforeach; ?>
</ul>