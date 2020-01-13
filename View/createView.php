<?php $title = 'Creer un nouveau billet'; ?>

<?php ob_start(); ?>
<div class="container-fluid brand-bg py-5">
	<div class="container">
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text">Titre du billet :</span>
			</div>
			<input type="text" id="title" name="title">
		</div>
		<textarea id='trumbowyg-demo'></textarea>
		<button type='button' class='postBtn btn btn-primary'>Poster ce nouveau billet</button>
	</div>
</div>
<ul class="notifications"></ul>
<script>
	$('#trumbowyg-demo').trumbowyg({ // Transformation de la div en WYSIWYG
		lang: 'fr'
	});

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

	$('.postBtn').click(() => // POST TICKET ON CLICK
	{	
		let title = $('#title').val();
		let content = $('#trumbowyg-demo').trumbowyg('html');
		if (!title.length || !content.length) return;
		$.ajax({
			url: '<?= $GLOBALS['websitePath'] ?>/api/post/create',
			method: "POST",
			data: {
				title: title,
				content: content
			}
		}).done((data) =>{
		var container = new UploadContainer($("ul.notifications"));
		if (data == 1) 
			var modal = container.addMessage("Billet mis en ligne avec succès !");
		else
			var modal = container.addMessage("Erreur ! Vérifiez la bonne mise en ligne du billet !");
		});
	});
</script>

<?php $content = ob_get_clean(); ?>

<?php require_once('template.php'); ?>
