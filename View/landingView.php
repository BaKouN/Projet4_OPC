<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<!--- Image Slider -->
<div id="slides" class="carousel slide" data-ride="carousel">
	<ul class="carousel-indicators">
		<li data-target="#slides" data-slide-to="0" class="active"></li>
		<li data-target="#slides" data-slide-to="1"></li>
		<li data-target="#slides" data-slide-to="2"></li>
	</ul>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img src="Public/background.png">
			<div class="carousel-caption">
				<h1 class="display-2">Voyage vers l'Alaska</h1>
				<h3>Un journal de bord en ligne</h3>
				<button type="button" class="btn btn-outline-light btn-lg">En apprendre plus</button>
				<button type="button" class="btn btn-primary btn-lg">Lire les billets</button>
			</div>
		</div>
		<div class="carousel-item">
			<img src="Public/background2.png">
		</div>
		<div class="carousel-item">
			<img src="Public/background3.png">
		</div>
	</div>
</div>

<!--- Jumbotron -->
<div class="container-fluid">
	<div class="row jumbotron">
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
			<p class="lead">
				Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae quaerat eum aliquid dolorem autem!
			</p>
		</div>
		<div clas="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-2">
			<a href="#"><button type="button" class="btn btn-outline-secondary btn-lg">Lorem Ipsum</button></a>
		</div>
	</div>
</div>

<!--- Welcome Section -->
<div class="container-fluid padding">
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

<!--- Three Column Section -->
<div class="container-fluid padding">
	<div class="row text-center padding">
		<div class="col-xs-12 col-sm-6 col-md-4">
			<i class="fab fa-html5"></i>
			<h3>HTML5</h3>
			<p>Built with the latest version of HTML, HTML5.</p>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<i class="fas fa-bold"></i>
			<h3>BOOTSTRAP</h3>
			<p>Built with the latest version of Bootstrap, Bootstrap 4.</p>
		</div>
		<div class="col-sm-12  col-md-4">
			<i class="fab fa-css3"></i>
			<h3>CSS3</h3>
			<p>Built with the latest version of CSS, CSS3.</p>
		</div>
	</div>
</div>
<hr class="my-4">
<!--- Two Column Section -->
<div class="container-fluid padding">
	<div class="row padding">
		<div class="col-lg-6">
			<h2>Si vous decidez de me suivre</h2>
			<p>Vous profiterez d'une expérience au plus proche du réel contenant sensations, souvenirs et détails époustouflants</p>
			<p>Vous apprendrez à chaque chapitre des astuces de survie en haute montagne ainsi que des informations sur la faune et la flore rencontrées</p>
			<p>Et enfin, si le coeur vous en dit, vous pourrez peut etre vous attaché à ma petite personne et vouloir me rejoindre dans de nouvelles aventures</p>
			<br>
			<a href="#" class="btn btn-primary">En apprendre plus</a>
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

<!--- Emoji Section -->
<button class="fun" data-toggle="collapse" data-target="#emoji">click for fun</button>
<div id="emoji" class="collapse">
	<div class="container-fluid padding">
		<div class="row text-center">
			<div class="col-sm-6 col-md-3">
				<img class="gif" src="Public/gif/panda.gif">
			</div>
			<div class="col-sm-6 col-md-3">
				<img class="gif" src="Public/gif/poo.gif">
			</div>
			<div class="col-sm-6 col-md-3">
				<img class="gif" src="Public/gif/unicorn.gif">
			</div>
			<div class="col-sm-6 col-md-3">
				<img class="gif" src="Public/gif/chicken.gif">
			</div>
		</div>
	</div>
</div>
<!--- Meet the team -->
<div class="container-fluid padding">
	<div class="row welcome text-center">
		<div class="col-12">
			<h1 class="display-4">Meet the Team</h1>
		</div>
		<hr>
	</div>
</div>

<!--- Cards -->
<div class="container-fluid padding">
	<div class="row padding">
		<div class="col-md-4">
			<div class="card">
				<img class="card-img-top" src="Public/team/1.png">
				<div class="card-body">
					<h4 class="card-title">John Doe</h4>
					<p class="card-text">Joe is an Internet entrepreneur with almost 20 years of experience.</p>
					<a href="#" class="btn btn-outline-secondary">See Profile</a>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<img class="card-img-top" src="Public/team/2.png">
				<div class="card-body">
					<h4 class="card-title">John Doe</h4>
					<p class="card-text">Joe is an Internet entrepreneur with almost 20 years of experience.</p>
					<a href="#" class="btn btn-outline-secondary">See Profile</a>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card">
				<img class="card-img-top" src="Public/team/3.png">
				<div class="card-body">
					<h4 class="card-title">John Doe</h4>
					<p class="card-text">Joe is an Internet entrepreneur with almost 20 years of experience.</p>
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
			<p>Vous profiterez d'une expérience au plus proche du réel contenant sensations, souvenirs et détails époustouflants</p>
			<p>Vous apprendrez à chaque chapitre des astuces de survie en haute montagne ainsi que des informations sur la faune et la flore rencontrées</p>
			<p>Et enfin, si le coeur vous en dit, vous pourrez peut etre vous attaché à ma petite personne et vouloir me rejoindre dans de nouvelles aventures</p>
			<br>
			<a href="#" class="btn btn-primary">En apprendre plus</a>
		</div>
	</div>
	<hr class="my-4">
</div>

<!--- Connect -->
<div class="container-fluid padding">
	<div class="row text-center padding">
		<div class="col-12">
			<h2>Connect</h2>
		</div>
		<div class="col-12 social padding">
			<a href="#"><i class="fab fa-facebook"></i></a>
			<a href="#"><i class="fab fa-twitter"></i></a>
			<a href="#"><i class="fab fa-google-plus-g"></i></a>
			<a href="#"><i class="fab fa-instagram"></i></a>
			<a href="#"><i class="fab fa-youtube"></i></a>
		</div>
	</div>
</div>
<?php
$content = ob_get_clean(); 
require_once('template.php'); ?>
