<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<div class="container-fluid brand-bg">
	<div class="container">
		<div class="ticket postCard">
			<h2><?= htmlspecialchars($post['title']);?></h2>
			<em><?= $post['creation_date_fr'];?></em>
			<p><?= nl2br(htmlspecialchars_decode($post['content']));?></p>
		</div>
		<div class="commentSection">
			<div class="mb-1">
				<div class="input-group">
					<input type="text" id="author" name="author" class="form-control" placeholder="Pseudonyme">
					<div class="input-group-append">
						<button class="btn btn-outline-secondary postBtn" type="button">Commenter</button>
					</div>
				</div>
			</div>
			<textarea id="commentInput"></textarea>
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

$.ajax({  // GET COMMENTS
	url:'<?= $GLOBALS['websitePath'] ?>/api/post/<?= $postID ?>/comment',
	method: "GET",
	dataType: "JSON"
}).done((data) =>{
	if(!data.length) return;
	$(".ticket").after(`
	<ul id="comments">
	</ul>
	`);
	data.forEach(element => {
		$("#comments").append(`
			<li class="comments p-3 my-2" data-id="` + element['id']+ `">
				<p class="author"><strong>` + element['author'] + `</strong></p>
				<p class="commentContent lead">` + element['comment'] + `</p>
				<p class="commentDate small">le ` + element['comment_date_fr'] + `</p>
				<?php if (isset($_SESSION['rank']) && $_SESSION['rank'] == 1)
				{ ?>
					<button class="deleteBtn btn btn-danger">Supprimer commentaire</button>
					<button class="updateBtn btn btn-warning">Modérer le commentaire</button>
					` + ((element['reported'] == 1)? `<span class="reportStatus"> /!\\ Commentaire signalé ! /!\\</span>`: ``) + `
				<?php } 
				else if (isset($_SESSION['rank']) && $_SESSION['rank'] !== 1){ ?>
					` + ((element['reported'] == 0)? `<button class="reportBtn">Signaler le commentaire</button>`: ``) + `
				<?php } ?>
			</li>
		`);
	});

	$('.reportBtn').click((e) => {
		e.preventDefault();
		e.stopPropagation();
		let commentID = $(e.target).parent().data("id");
		$.ajax({ // DELETE COMMENTS
		url:'<?= $GLOBALS['websitePath'] ?>/api/post/<?= $postID ?>/comment/' + commentID + '/report'
		}).done((data) =>{
			var container = new UploadContainer($("ul.notifications"));
			if (data == 1) {
			container.addMessage("Commentaire signalé avec succès !");
			e.target.innerHTML= "Signalé !";
			}
			else {
				container.addMessage("Erreur ! Veuillez réessayer");
				e.target.innerHTML= "Erreur, rechargez la page !";
			}
		});
	});

	$('.deleteBtn').click((e) => {
		e.preventDefault();
		e.stopPropagation();
		let commentID = $(e.target).parent().data("id");
		$.ajax({ // DELETE COMMENTS
		url:'<?= $GLOBALS['websitePath'] ?>/api/post/<?= $postID ?>/comment/' + commentID + '/delete'
		}).done((data) =>{
			var container = new UploadContainer($("ul.notifications"));
			if (data == 1) {
			container.addMessage("Commentaire supprimé avec succès !");
			e.target.innerHTML= "Supprimé !";
			}
			else {
				container.addMessage("Erreur ! Veuillez réessayer");
				e.target.innerHTML= "Erreur, rechargez la page !";
			}
		});
	});

	$('.updateBtn').click((e) => {
		e.preventDefault();
		e.stopPropagation();

		let commentID = $(e.target).parent().data("id");
		$.ajax({ // UPDATE COMMENTS
		url:'<?= $GLOBALS['websitePath'] ?>/api/post/<?= $postID ?>/comment/' + commentID + '/update'
		}).done((data) =>{
			var container = new UploadContainer($("ul.notifications"));
			if (data == 1) {
			container.addMessage("Commentaire modéré avec succès !");
			e.target.innerHTML= "Modéré !";
			}
			else {
				container.addMessage("Erreur ! Veuillez réessayer");
				e.target.innerHTML= "Erreur, rechargez la page !";
			}
		});
	});
});

$('.postBtn').click(() => // POST COMMENT ON CLICK
{
	let author = $('#author').val();
	let content = $('#commentInput').val();
	if (!author.length || !content.length) return;
	$.ajax({
		url: '<?= $GLOBALS['websitePath'] ?>/api/post/<?= $postID ?>/comment/create',
		method: "POST",
		data: {
			author: author,
			content: content
		}
	}).done((data) =>{
		if (data == 1)
		{
			$("#comments").append(
			`<li class="comments etheral" style="opacity: 0;transition: opacity 3s ease;">
				<p class="author">` + author + `</p>
				<p class="commentContent">` + content + `</p>
			</li>`
			);
			setTimeout(() => {
				$('.etheral').css('opacity', '1');
			}, 1);
		}
	});
});
</script>
<?php $content = ob_get_clean(); ?>

<?php require_once('template.php'); ?>
