<?php $title = 'Login'; ?>

<?php ob_start(); ?>
<div class="row login-main">
	<div class="col-9 mx-auto">
		<div class="login-card card">
			<div class="row no-gutters">
				<div class="login-image col-auto">
					<img src="https://loremflickr.com/300/700" class="img-fluid" alt="">
				</div>
				<div class="col d-flex justify-content-center align-items-center">
					<div class="card-block p-5">
						<h4 class="card-title">Créer son compte</h4>
						<h5 class="card-subtitle text-muted login-subtitle">Tous mes lecteurs ont une place toute particulière dans mon coeur..</h5>
						<small class="text-muted">Mais ceux inscrits un peu plus quand même..</small>
						<form class="mt-5">
							<div class="form-group">
								<label for="login">Nom d'utilisateur</label>
								<input type="text" id="login" name="login" class="form-control" placeholder="Entrez votre pseudonyme" required />
								<small id="emailHelp" class="form-text text-muted">Choisis le bien !</small>
							</div>
							<div class="form-group">
								<label for="password">Mot de passe</label>
								<input type="password" id="password" name="password" class="form-control" placeholder="Et maintenant le MdP" required />
								<label for="password2">Confirmer le Mot de passe</label>
								<input type="password" id="password2" name="password2" class="form-control" placeholder="Exactement le meme !" required />
							</div>
							<button type="submit" id="loginSubmit" class="btn btn-primary">Commencer l'aventure</button>
						</form>
						<a class="link-login" href="<?=$GLOBALS['websitePath']?>/login"><small ><u>Si vous avez déjà un compte, c'est par là !</u></small></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- <form method="post" class="loginBox">
	<input type="text" id="login" name="login" class="loginInput" placeholder="Pseudonyme" required />
	<input type="password" id="password" name="password" class="loginInput" placeholder="Mot de Passe" required />
	<input type="password" id="password2" name="password2" class="loginInput" placeholder="Confirmer le MdP" required />
	<input type="submit" class="loginInput" value="S'inscrire !" />
</form> -->
<ul class="notifications"></ul>

<script>
$('#navRegister').addClass("active");

	class UploadContainer
	{ // MODAL LOGIN
		constructor(elem)
		{
			this.target = elem;
			this.messages = [];
		}

		addMessage(name)
		{
			this.target.append("<li class=\" added message\"><div class=\"container\"><span class=\"name\">"+name+"</span></div><div class=\"close\"></div></li>");
			let index = this.messages.length;
			this.messages.push(this.target.find("li.message.added"));
			this.messages[index].removeClass("added");
			this.messages[index].css({right: "-100%"});
			this.messages[index].animate({right: "0"}, 500, "swing");
			this.messages[index].find("div.close").click($.proxy(function(e)
			{
				this.removeMessage(this.messages[index]);
			}, this));
			window.setTimeout(this.removeMessage, 5000, this.messages[index]);
			return (this.messages[index]);
		}

		removeMessage(message)
		{
			message.animate({right: "-500px"}, 200, function(){message.remove();});
		}
	}

	$('#loginSubmit').click((e) => {
		e.preventDefault();
		e.stopPropagation();
		let login = $('#login').val();
		let password = $('#password').val();
		let password2 = $('#password2').val();
		if (!login.length || !password.length || !password2.length) return;
		$.ajax({  // Try register
			url:'<?= $GLOBALS['websitePath'] ?>/api/user/register',
			method: "POST",
			dataType : "JSON",
			data: {
				login: login,
				password: password,
				password2 : password2
			}
		}).done((data) =>{
			var container = new UploadContainer($("ul.notifications"));
			if (data == 'Erreur Inscription : Nom d\'utilisateur déjà utilisé !') {
				var modal = container.addMessage("Pseudonyme déjà utilisé !");
			}
			else if (data == 'Erreur Inscription : Les deux mots de passes ne correspondent pas !') {
				var modal = container.addMessage("Les mots de passes ne correspondent pas !");
			}
			else if (data == 'Inscription effectué ! Vous serez redirigé vers l\'accueil dans un instant !') {
				var modal = container.addMessage("Inscription effectué ! Vous serez redirigé vers l'accueil dans un instant !");
			}
		});
	});
</script>
<?php $content = ob_get_clean(); ?>

<?php require_once('template.php'); ?>
