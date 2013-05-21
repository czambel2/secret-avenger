<?php

// On récupère la liste de tous les super-héros
$parser = new SuperHeroParser();

$heroes = $parser->getAll();

?>

<ul class="super-hero-list">
    <?php foreach($heroes as $hero): ?>
        <li>
            <div class="profile-pic">
                <img src="<?php echo $hero->picture; ?>" alt="<?php $hero->nickname; ?>" style="width: 128px;" />
            </div>
            <h2><?php echo $hero->nickname; ?></h2>
        </li>
    <?php endforeach; ?>
</ul>