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
						<h4 class="card-title">Se connecter</h4>
						<h5 class="card-subtitle mb-5 text-muted login-subtitle">Cela vous permettra de participer activement à mon aventure !</h5>
						<form>
							<div class="form-group">
								<label for="login">Nom d'utilisateur</label>
								<input type="text" id="login" name="login" class="form-control" placeholder="Entrez votre pseudonyme" required />
								<small id="emailHelp" class="form-text text-muted">C'est mignon comme surnom ça ...</small>
							</div>
							<div class="form-group">
								<label for="password">Mot de passe</label>
								<input type="password" id="password" name="password" class="form-control" placeholder="Et maintenant le MdP" required />
							</div>
							<button type="submit" id="loginSubmit" class="btn btn-primary">Se connecter</button>
						</form>
						<a class="link-register" href="<?=$GLOBALS['websitePath']?>/register"><small ><u>Si vous n'avez pas encore de compte ...</u></small></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<ul class="notifications"></ul>

<script>

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
		if (!login.length || !password.length) return;
		$.ajax({  // TRY LOGIN
			url:'<?= $GLOBALS['websitePath'] ?>/api/user/login',
			method: "POST",
			dataType : "JSON",
			data: {
				login: login,
				password: password
			}
		}).done((data) =>{

			var container = new UploadContainer($("ul.notifications"));
			if (data == 'Erreur Authentification : Utilisateur inexistant !') {
				var modal = container.addMessage("Utilisateur inexistant !");
			}
			else if (data == 'Erreur Authentification : Mot de passe éronné !') {
				var modal = container.addMessage("Mot de passe éronné !");
			}
			else if (data == 'Erreur Authentification : Token non généré !') {
				var modal = container.addMessage("Token non généré !");
			}
			else {
				// setCookie('token', data.token);
				// setCookie('login', data.username);
				// let token = getCookie('token');
				window.location.replace("<?=$GLOBALS['websitePath']?>");
			}
		});	
	});
</script>
<?php $content = ob_get_clean(); ?>

<?php require_once('template.php'); ?>
