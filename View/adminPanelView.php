<?php $title = 'Administration du blog'; ?>

<?php ob_start(); ?>

<div class="container-fluid admin-main">
	<div class="container">
		<div class="row">
			<div class="col-7">
				<div class="">
					<div class="addPost">
						<i class="far fa-plus-square"></i>
						<p>Ajouter un post</p>
					</div>
				</div>
				<?php
				foreach ($posts as $post )
				{
				?>
					<div>
						<div class="ticket text-center">
							<h2>
								<?= htmlspecialchars($post['title']) ?>
							</h2>
							<br />
							<div class="adminOptions">
								<p><button class="btn btn-outline-secondary viewPost" data-id="<?=$post['id']?>" name="viewPost"><i class="far fa-eye btn-outline-secondary pr-2"></i>Voir le billet</button></p>
								<p><button class="btn btn-outline-warning updatePost" data-id="<?=$post['id']?>" name="updatePost"><i class="fas fa-edit btn-outline-warning pr-2"></i>Mettre à jour le billet</button></p>
								<p><button class="btn btn-outline-danger deletePost" data-id="19" name="deletePost"><i class="far fa-trash-alt btn-outline-danger pr-2" aria-hidden="true"></i>Supprimer le billet</button></p>
							</div>
						</div>
					</div>
				<?php
				}
				?>
			</div>
			<div class="col-5">
				<div class="">
					<div class="commentAdmin ">
						<p>Commentaires reportés</p>
					</div>
				</div>
				<?php
				foreach ($reportedComments as $reportedComment )
				{
				?>
					<div>
						<div class="ticket">
							<h2>
								<?= htmlspecialchars($reportedComment['author']) ?>
								<small class="text-muted"><?= htmlspecialchars($reportedComment['comment_date_fr']) ?></small>
							</h2>
							<p><?= $reportedComment['comment'] ?></p>
							<div class="adminOptions">
								<p class="testdebug"><i class="far fa-eye"></i><input type="button" class="viewComment" data-post-id="<?=$reportedComment['post_id']?>" name="viewComment" value="Voir"></p>
								<p class="testdebug"><i class="fas fa-gavel"></i><input type="button" class="updateComment" data-comment-id="<?=$reportedComment['id']?>" data-post-id="<?=$reportedComment['post_id']?>" name="updateComment" value="Moderer"></p>
								<p class="testdebug"><i class="far fa-trash-alt"></i><input type="button" class="deleteComment" data-comment-id="<?=$reportedComment['id']?>" data-post-id="<?=$reportedComment['post_id']?>" name="deleteComment" value="Supprimer"></p>
							</div>
						</div>
					</div>
				<?php
				}
				?>
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

$('.addPost').click((e)=> {
	window.location.replace(`<?=$GLOBALS['websitePath']?>/post/create`);
});

$('.updatePost').click((e) => {
	e.preventDefault();
	e.stopPropagation();
	window.location.replace(`<?=$GLOBALS['websitePath']?>/post/${e.target.dataset.id}/update`);
});

$('.viewPost').click((e) => {
	e.preventDefault();
	e.stopPropagation();
	window.location.replace(`<?=$GLOBALS['websitePath']?>/post/${e.target.dataset.id}`);
});

$('.deletePost').click((e) => {
	e.preventDefault();
	e.stopPropagation();
	$.ajax({  //DELETE POST
		url:'<?=$GLOBALS['websitePath']?>/api/post/' + e.target.dataset.id + '/delete',
		method: "DELETE"
	}).done((data) =>{
		var container = new UploadContainer($("ul.notifications"));
		if (data == 1) 
			var modal = container.addMessage("Billet supprimé avec succès !");
		else
			var modal = container.addMessage("Erreur ! La bonne suppression du billet ne peut etre confirmée");
	});	
});

$('.viewComment').click((e) => {
	e.preventDefault();
	e.stopPropagation();
	window.location.replace(`<?=$GLOBALS['websitePath']?>/post/${e.target.dataset.postId}`);
});

$('.updateComment').click((e) => {
	e.preventDefault();
	e.stopPropagation();

	let commentID = $(e.target).parent().data("id");
	$.ajax({ // UPDATE COMMENTS
	url:`<?= $GLOBALS['websitePath'] ?>/api/post/${e.target.dataset.postId}/comment/${e.target.dataset.commentId}/update`
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

$('.deleteComment').click((e) => {
	e.preventDefault();
	e.stopPropagation();
	let commentID = $(e.target).parent().data("id");
	$.ajax({ // DELETE COMMENTS
	url:`<?= $GLOBALS['websitePath'] ?>/api/post/${e.target.dataset.postId}/comment/${e.target.dataset.commentId}/delete`
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
</script>

<?php
$content = ob_get_clean();
require_once('template.php'); ?>
