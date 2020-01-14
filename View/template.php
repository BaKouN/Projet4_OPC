<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="Public\logo-jf.png"/>
		<meta property="og:locale" content="fr_FR">
		<meta property="og:title" content="Projet 4 OpenClassRooms">
		<meta property="og:type" content="website">
		<meta property="og:url" content="">
		<meta property="og:site_name" content="Projet 4 OpenClassRooms">
		<meta property="og:description" content="Projet 4 OpenClassrooms : Blog de l'écrivain Jean Forteroche">
		<meta property="og:image" content="">
		<meta name="robots" content="index,follow">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="geo.region" content="FR">
		<meta name="geo.placename" content="Lyon">
		<meta name="geo.position" content="45.7500;4.8500">
		<meta name="twitter:image" content="">
		<meta name="twitter:card" content="summary">
		<meta name="twitter:site" content="Projet 4 OpenClassrooms">
		<meta name="twitter:creator" content="Haroun BAKHOUCHE">
		<meta name="twitter:title" content="Projet 4 OpenClassrooms">
		<meta name="twitter:description" content="Projet 4 OpenClassrooms : Blog de l'écrivain Jean Forteroche">
		<meta name="description" content="Projet 4 OpenClassrooms : Blog de l'écrivain Jean Forteroche PHP MVC POO AJAX"> <!--- AJOUTER DESCRIPTION MAX 160 CHAR --->
		<meta name="ICBM" content="45.7500, 4.8500">
		<title>Haroun BAKHOUCHE Projet 4 &middot; Blog de Jean Forteroche &middot; Alaska &middot; <?= $title ?></title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.19.1/ui/trumbowyg.min.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.19.1/trumbowyg.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.19.1/langs/fr.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<link href="<?=$GLOBALS['websitePath']?>/Public/style.css" rel="stylesheet" /> 
		<script src="https://kit.fontawesome.com/a496bed872.js" crossorigin="anonymous"></script>
    </head>
        
    <body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
			<div class="container-fluid">
				<a class="navbar-brand" href="<?=$GLOBALS['websitePath']?>">
					<img src="Public/logo-jf.png" width="30" height="30" class="d-inline-block align-top" alt="">
					Jean Forteroche
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav ml-auto">
						<li class=" nav-item">
							<a class="nav-link" id="navLandingPage" href="<?=$GLOBALS['websitePath']?>">Accueil</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="navPost" href="<?=$GLOBALS['websitePath']?>/post">Billets</a>
						</li>
						<?php if(isset($_SESSION['connected']) && $_SESSION['connected']) { 
							if (isset($_SESSION['rank']) && $_SESSION['rank'] == 1)
							{ ?>
						<li class="nav-item">
							<a class="nav-link" id="navAdminPanel" href="<?=$GLOBALS['websitePath']?>/adminPanel">Panneau d'administration</a>
						</li>
							<?php	} ?>
						<li class="nav-item">
							<a class="nav-link">Content de te revoir, <?= $_SESSION['user'] ?> !</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?=$GLOBALS['websitePath']?>/logout">Deconnexion</a>
						</li>
						<?php } else {?>
						<li class="nav-item">
							<a class="nav-link" id="navLogin" href="<?=$GLOBALS['websitePath']?>/login">Connexion</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="navRegister" href="<?=$GLOBALS['websitePath']?>/register">Inscription</a>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</nav>
		<?= $content ?>
		<footer>
			<div class="container-fluid padding">
				<div class="row text-center">
					<div class="col-md-4">
						<p><img class="footerLogo" src="Public\logo-jf-light.png">Jean Forteroche</p>
						<hr class="light">
						<p>+33 6 01 20 20 66</p>
						<p>contact@jeanforteroche.blog</p>
						<p>404 rue du vrai numéro</p>
						<p>33777 Call me, Now</p>
					</div>
					<div class="col-md-4">
						<hr class="light">
						<h5>Soutenez nous</h5>
						<hr class="light">
						<p><a>Tipeee : tipeee.com/jeanforteroche</a></p>
						<p><a>Utip : utip.io/jeanforteroche</a></p>
						<p><a>Paypal : paypal.me/jeanforteroche</a></p>
					</div>
					<div class="col-md-4">
						<hr class="light">
						<h5>To-Do Liste</h5>
						<hr class="light">
						<ul class="list-unstyled">
							<li>Parc National Denali</li>
							<li>Parc Glacier Bay</li>
							<li><s>Glacier Mendenhall</s></li>
							<li>Aurores Boréales</li>
							<li><s>Combattre un ours</s></li>
						</ul>
					</div>
					<div class="col-12">
						<hr class="light-100">
						<h5><a class="text-light" href="http://harounb.site/">&copy; Haroun BAKHOUCHE - Harounb.site</a></h5>
					</div>
				</div>
			</div>
		</footer>
    </body>
</html>
