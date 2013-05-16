<?php
$id = $_GET['id'];
$parse = new SuperHeroParser();
$superhero = $parse->getSuperHeroById($id);
$return = <<<EOF
<style>
	.info{
width: 960px;
margin: 16px auto 0 auto;
background-color: #ff6060;
padding: 8px;
border: 8px red solid;
border-radius: 16px;
display: block;
	}
	
.img{
	float:left;
	position:relative;
	width:50%;
}
</style>
<div>
<div class="info">
<ul>
	<li><strong>Surnom</strong> {$superhero->nickname}</li>
	<li><strong>Prénom</strong> {$superhero->firstName}</li>
	<li><strong>Nom</strong> {$superhero->lastName}</li>
	<li><strong>Univers</strong> {$superhero->universe}</li>

EOF;

$power = "<li><strong>Superpower</strong><ul>";
foreach($superhero->superpowers as $superpower){
	$power .= <<<EOF
			<li>{$superpower->name}</li>
EOF;
	}
$power .= <<<EOF
	</ul></li>
EOF;

$nemeses = "<li><strong>Nemeses</strong><ul>";
foreach($superhero->nemeses as $nemesis){
	$nemeses .= <<<EOF
				<li>{$nemesis->firstName} {$nemesis->lastName}: {$nemesis->nickname} </li>		
EOF;
	}
$nemeses .= <<<EOF
	</ul></li>
EOF;

$lovers = "<li><strong>Lovers</strong><ul>";
foreach($superhero->lovers as $lover){
	$lovers .= <<<EOF
				<li>{$lover->firstName} {$lover->lastName}: {$lover->nickname} </li>
EOF;
	}
$lovers .= <<<EOF
	</ul></li>
EOF;

$sidekicks = "<li><strong>SideKicks</strong><ul>";
foreach($superhero->sidekicks as $sidekick){
	$sidekicks .= <<<EOF
				<li>{$sidekick->firstName} {$sidekick->lastName}: {$sidekick->nickname} </li>
EOF;
	}
$sidekicks .= <<<EOF
	</ul></li>
EOF;

$return .= <<<EOF
		{$power}
		{$nemeses}
		{$lovers}
		{$sidekicks}
	</ul>
</div>
<div class="img">
<img src="{$superhero->picture}" />
</div>
<div>

</div>
</div>
EOF;

echo $return;
?>


 