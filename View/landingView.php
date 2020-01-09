<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<!--- Image Slider -->
<div id="slides" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img src="Public/background.png">
			<div class="carousel-caption">
				<h1 class="display-2">Voyage vers l'Alaska</h1>
				<h3>Un journal de bord en ligne</h3>
				<button type="button" class="btn btn-outline-light btn-lg" id="readMore">En apprendre plus</button>
				<a role="button" class="btn btn-primary btn-lg" href="<?=$GLOBALS['websitePath']?>/post">Lire les billets</a>
			</div>
		</div>
	</div>
</div>

<!--- Jumbotron -->
<div class="container-fluid">
	<div class="row jumbotron">
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
			<p class="lead">
				Ceci est un des projets de ma formation OpenClassrooms : "Voyage vers l'Alaska", si vous souhaitez découvrir mes autres projets, rendez vous ici :
			</p>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-2">
			<a href="http://harounb.site/"><button type="button" class="btn btn-outline-secondary btn-lg">Autres Projets</button></a>
		</div>
	</div>
</div>

<!--- Welcome Section -->
<div class="container-fluid padding" id="welcome">
	<div class="row welcome text-center">
		<div class="col-12">
			<h1 class="display-4">Raconté avec amour.</h1>
		</div>
		<hr>
		<div class="col-12">
			<p class="lead">
				Bienvenue sur mon journal de board. Il sera mon plus cher compagnon lors de mon péril en Alaska.
				Vous pourrez suivre sur ce site confectionné avec la plus grande attention mes réussites comme mes échecs,
				mes joies comme mes doutes, mes surprises comme mes peurs.
				Entrez dans mon univers et perdez vous y le temps d'un thé, d'un café ou d'un peu plus...
			</p>
		</div>
	</div>
</div>
<hr class="my-4">
<!--- Two Column Section -->
<div class="container-fluid padding InfoDiv1">
	<div class="row padding">
		<div class="col-lg-6">
			<h2>Si vous decidez de me suivre</h2>
			<p>Vous profiterez d'une expérience au plus proche du réel contenant sensations, souvenirs et détails époustouflants.<br><br>
			Vous apprendrez à chaque chapitre des astuces de survie en haute montagne ainsi que des informations sur la faune et la flore rencontrées.<br><br>
			Et enfin, si le coeur vous en dit, vous pourrez peut etre vous attacher à ma petite personne et vouloir me rejoindre dans de nouvelles aventures</p>
			<br>
			<btn id="readMore2" class="btn btn-primary">En apprendre plus</btn>
		</div>
		<div class="col-lg-6">
			<img src="Public/travel.jpg" class="img-fluid rounded">
		</div>
	</div>
</div>

<hr class="my-4">
<!--- Fixed background -->
<figure>
	<div class="fixed-wrap">
		<div id="fixed">
		</div>
	</div>
</figure>
<!--- Meet the team -->
<div class="container-fluid padding" id="teamDiv">
	<div class="row welcome text-center">
		<div class="col-12">
			<h1 class="display-4">Rencontrez l'équipe !</h1>
			<p>Votre écrivain préféré accompagné de ses deux fideles acolytes ! </p>
		</div>
		<hr>
	</div>
</div>

<!--- Cards -->
<div class="container-fluid padding">
	<div class="row padding">
		<div class="col-md-4">
			<div class="card h-100">
				<img class="card-img-top" src="Public/team/2.png">
				<div class="card-body">
					<h4 class="card-title">Claudie Bouyeure</h4>
					<p class="card-text">La photographe suivant Jean sur toutes ses aventures pour figer les plus beaux moments et vous les retranscrire par l'image.</p>
					<a href="#" class="btn btn-outline-secondary">See Profile</a>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card h-100">
				<img class="card-img-top" src="Public/team/1.png">
				<div class="card-body">
					<h4 class="card-title">Jean Forteroche</h4>
					<p class="card-text">Jean Forteroche est un écrivain passionné par la découverte de nouveaux horizons, de paysages époustouflants et de cultures inspirantes.</p>
					<a href="#" class="btn btn-outline-secondary">See Profile</a>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card h-100">
				<img class="card-img-top" src="Public/team/3.png">
				<div class="card-body">
					<h4 class="card-title">Julien Rival</h4>
					<p class="card-text">Son meilleur ami depuis 20 ans, Julien est un pro de la survie en millieu hostile et escortera Jean pour la plupart de ses aventures.</p>
					<a href="#" class="btn btn-outline-secondary">See Profile</a>
				</div>
			</div>
		</div>
	</div>
</div>

<!--- Two Column Section -->
<div class="container-fluid padding">
	<div class="row padding">
		<div class="col-lg-6">
			<img src="Public/chooseWhereIGo.jpg" class="img-fluid rounded">
		</div>
		<div class="col-lg-6">
			<h2>Choisissez ma prochaine destination !</h2>
			<p>Après chaque voyage, je prends une pause pour me ressourcer, me replonger dans mes aventures et pouvoir tirer le maximum des richesse que mes périples ont pu m'apporter. <br>
			Mais c'est aussi une occasion pour moi de pouvoir prendre le temps de discuter avec ma communauté et répondre aux questions que vous m'avez posé ! <br><br>
			C'est pourquoi j'ai crée cette newsletter avec vous, pour vous prévenir des grands moments, des nouveaux articles, mais aussi pour recevoir vos demandes et vous faire interagir! <br>
			Vous allez même pouvoir choisir ma prochaine destination et les plus chanceux auront la chance de m'accompagner ! Alors n'hésitez plus et enregistrez vous ! </p>
				<form class="needs-validation" novalidate action="javascript:void(0);">
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text">@</div>
						</div>
						<input type="email" class="form-control" id="emailNewsletter" placeholder="E-mail" required>
						<div class="valid-feedback">
        					Looks good!
						</div>
					</div>
					<button class="btn btn-primary" type="submit">S'inscrire à la Newsletter!</button>
				</form>
		</div>
	</div>
	<hr class="my-4">
</div>
<!--- Three Column Section -->
<div class="container-fluid padding">
	<div class="row text-center padding">
		<div class="col-xs-12 col-sm-6 col-md-4">
			<i class="fas fa-bold"></i>
			<h3>BOOTSTRAP</h3>
			<p>Built with the latest version of Bootstrap, Bootstrap 4.</p>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<i class="fab fa-php"></i>
			<h3>PHP</h3>
			<p>Built with the latest version of PHP, PHP5.</p>
		</div>
		<div class="col-sm-12  col-md-4">
			<i class="fab fa-js-square"></i>
			<h3>JAVASCRIPT</h3>
			<p>Built with the latest version of Javascript, Javascript 7.</p>
		</div>
	</div>
</div>
<hr class="my-4">
<!--- Connect -->
<div class="container-fluid padding">
	<div class="row text-center padding">
		<div class="col-12">
			<h2>Connect</h2>
		</div>
		<div class="col-12 social padding">
			<a href="#"><i class="fab fa-facebook"></i></a>
			<a href="#"><i class="fab fa-twitter"></i></a>
			<a href="#"><i class="fab fa-instagram"></i></a>
			<a href="#"><i class="fab fa-youtube"></i></a>
		</div>
	</div>
</div>
<script src="Public/landingPage.js"></script>
<?php
$content = ob_get_clean(); 
require_once('template.php'); ?>
