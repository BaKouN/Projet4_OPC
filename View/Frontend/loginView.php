<?php $title = 'Login'; ?>

<?php ob_start(); ?>
<form method="post" class="loginBox">
	<input type="text" id="login" name="login" class="loginInput" placeholder="Pseudonyme" required />
	<input type="password" id="password" name="password" class="loginInput" placeholder="Mot de Passe" required />
	<input type="submit" class="loginInput" value="Se connecter !" />
</form>
<ul class="notifications"></ul>

<script>
	class UploadContainer
	{
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






	$('.loginBox>input[type="submit"]').click((e) => {
		e.preventDefault();
		e.stopPropagation();
		let login = $('#login').val();
		let password = $('#password').val();
		if (!login.length || !password.length) return;
		$.ajax({  // TRY LOGIN
			url:'<?= $GLOBALS['websitePath'] ?>/api/login',
			method: "POST",
			dataType : "JSON",
			data: {
				login: login,
				password: password
			}
		}).done((data) =>{
			var container = new UploadContainer($("ul.notifications")); // Set container
			if (data === 'Erreur Authentification : Utilisateur inexistant !') {
				var modal = container.addMessage("Utilisateur inexistant !");
			}
			else if (data === 'Erreur Authentification : Mot de passe éronné !') {
				var modal = container.addMessage("Mot de passe éronné !");
			}
			else if (data === 'Erreur Authentification : Token non généré !') {
				var modal = container.addMessage("Token non généré !");
			}
			else {
				console.log(data);
			}
		});	
	});
</script>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
