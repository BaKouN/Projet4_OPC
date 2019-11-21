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
		<meta name="description" content="Projet 4 OpenClassrooms : Blog de l'écrivain Jean Forteroche PHP MVC POO AJAX">
		<meta name="ICBM" content="45.7500, 4.8500">
        <title><?= $title ?></title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.19.1/ui/trumbowyg.min.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.19.1/trumbowyg.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.19.1/langs/fr.min.js"></script>
		<!-- <script src="./Public/cookies.js"></script> -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<link href="<?=$GLOBALS['websitePath']?>/Public/style.css" rel="stylesheet" /> 
		<script src="https://kit.fontawesome.com/a496bed872.js" crossorigin="anonymous"></script>
    </head>
        
    <body>
		<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
			<div class="container-fluid">
				<a class="navbar-brand" href="<?=$GLOBALS['websitePath']?>">
					<img src="<?=$GLOBALS['websitePath']?>/Public/logo-jf.png" width="30" height="30" class="d-inline-block align-top" alt="">
					Jean Forteroche
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav ml-auto">
						<li class=" nav-item">
							<a class="nav-link active" href="<?=$GLOBALS['websitePath']?>">Accueil</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?=$GLOBALS['websitePath']?>/post">Billets</a>
						</li>
						<?php if(isset($_SESSION['connected']) && $_SESSION['connected']) { 
							if (isset($_SESSION['rank']) && $_SESSION['rank'] == 1)
							{ ?>
						<li class="nav-item">
							<a class="nav-link" href="<?=$GLOBALS['websitePath']?>/adminPanel">Panneau d'administration</a>
						</li>
							<?php	} ?>
						<li class="nav-item">
							<a class="nav-link" href="<?=$GLOBALS['websitePath']?>/logout">Deconnexion</a>
						</li>
						<?php } else {?>
						<li class="nav-item">
							<a class="nav-link" href="<?=$GLOBALS['websitePath']?>/login">Connexion</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?=$GLOBALS['websitePath']?>/register">Inscription</a>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</nav>
		<?= $content ?>
	<!--- Footer -->
		<footer>
			<div class="container-fluid padding">
				<div class="row text-center">
					<div class="col-md-4">
						<p><img class="footerLogo" src="Public\logo-jf.png">Jean Forteroche</p>
						<hr class="light">
						<p>+33 6 54 32 19 87</p>
						<p>contact@jeanforteroche.blog</p>
						<p>100 rue de la République</p>
						<p>69001 Lyon 1er, France</p>
					</div>
					<div class="col-md-4">
						<hr class="light">
						<h5>Soutenez nous</h5>
						<hr class="light">
						<p>Tipee : tipee.com/mockup</p>
						<p>Utip : util.com/mockup</p>
						<p>Paypal : paypal.me/mockup</p>
					</div>
					<div class="col-md-4">
						<hr class="light">
						<h5>Itinéraire</h5>
						<hr class="light">
						<p>Tipee : tipee.com/mockup</p>
						<p>Utip : util.com/mockup</p>
						<p>Paypal : paypal.me/mockup</p>
					</div>
					<div class="col-12">
						<hr class="light-100">
						<h5>&copy; Haroun BAKHOUCHE - Harounb.pro</h5>
					</div>
				</div>
			</div>
		</footer>
    </body>
</html>
