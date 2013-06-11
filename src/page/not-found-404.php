<?php

Layout::getInstance()
	->setLayout(Layout::TINY_LAYOUT);

// Cette page peut être appelée soit en standalone, soit à partir d'une Avenger404Exception. Le cas échéant, elle doit
// afficher l'exception à l'écran.

?>
<div class="something-horrible">
	<h1>La page que vous demandez n'est pas accessible.</h1>

	<?php if(isset($exception)): ?>
		<p>
			<?php echo $exception->getMessage(); ?>
		</p>
	<?php endif; ?>

	<p>
		Si vous vous êtes perdu, rendez-vous sur la <a title="Accéder à la page d'accueil du site" href="<?php
		echo SecretAvenger::url('home'); ?>">page d'accueil</a>&#160;!
	</p>
</div>