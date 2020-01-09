<?php $title = 'Administration du blog'; ?>

<?php ob_start(); ?>
<!--- Contenu Panel Admin --->
<div class="container-fluid admin-main">
	<div class="container">
		<div class="row">
			<div class="col-12 col-lg-7">
				<div class="addPost">
					<div class="text-center">
						<button class="btn btn-outline-success flex-column align-items-center">
						<i class="far fa-plus-square"></i>
						<p>Nouveau billet de blog</p>
						</button>
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
							<div class="adminOptions flex-column flex-xl-row">
								<p><button class="btn btn-secondary viewPost" data-id="<?=$post['id']?>" name="viewPost"><i class="far fa-eye pr-2"></i>Voir le billet</button></p>
								<p><button class="btn btn-warning updatePost" data-id="<?=$post['id']?>" name="updatePost"><i class="fas fa-edit pr-2"></i>Mettre à jour le billet</button></p>
								<p><button class="btn btn-danger deleteModalTrigger" data-post-title="<?=$post['title']?>" data-id="<?=$post['id']?>" name="deletePost" data-toggle="modal" data-target="#deletePostModal"><i class="far fa-trash-alt pr-2" aria-hidden="true"></i>Supprimer le billet</button></p>
							</div>
						</div>
					</div>
				<?php
				}
				?>
			</div>
			<div class="col-12 col-lg-5">
				<div class="">
					<div class="commentAdmin ">
						<p class="lead" id="anchorComments">Commentaires reportés</p>
					</div>
				</div>
				<?php
					foreach ($reportedComments as $reportedComment ) 
					{
					?>
						<div>
							<div class="ticket text-center">
								<h2>
									<?= htmlspecialchars($reportedComment['author']) ?>
								</h2>
								<small class="text-muted"><?= htmlspecialchars($reportedComment['comment_date_fr']) ?></small>
								<p><?= $reportedComment['comment'] ?></p>
								<div class="adminOptions flex-column flex-xl-row">
									<p><button class="btn btn-secondary viewComment" data-post-id="<?=$reportedComment['post_id']?>" name="viewComment"><i class="far fa-eye pr-2"></i>Voir</button></p>
									<p><button class="btn btn-success validateComment" data-comment-id="<?=$reportedComment['id']?>" data-post-id="<?=$reportedComment['post_id']?>" name="validateComment" ><i class="fas fa-clipboard-check pr-2"></i>Valider</button></p>
									<p><button class="btn btn-warning updateComment" data-comment-id="<?=$reportedComment['id']?>" data-post-id="<?=$reportedComment['post_id']?>" name="updateComment"><i class="fas fa-gavel pr-2"></i>Moderer</button></p>
									<p><button class="btn btn-danger  deleteComment" data-comment-id="<?=$reportedComment['id']?>" data-post-id="<?=$reportedComment['post_id']?>" name="deleteComment"><i class="far fa-trash-alt  pr-2"></i>Supprimer</button></p>
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
<!--- MODAL DE NOTIFICATIONS --->
<ul class="notifications"></ul>
<!--- MODAL DE SUPPRESION DE POST --->
<div class="modal fade" id="deletePostModal" tabindex="-1" role="dialog" aria-labelledby="deletePostModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Suppression d'un billet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Attention ! La suppression d'un billet de blog est irréversible !<br>
		Etes vous sur de vouloir supprimé le billet suivant : "..." ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" id="deletePostBtn" class="btn btn-danger" data-dismiss="modal"><i class="far fa-trash-alt  pr-2"></i>Supprimer le billet</button>
      </div>
    </div>
  </div>
</div>
<!--- ANCRE POUR MOBILES --->
<div class="anchorComments btn btn-dark d-lg-none">
	<i class="fas fa-arrow-down"></i>
	<div>Commentaires</div>
</div>
<!-- Javascript --->
<script>
$('#navAdminPanel').addClass("active");

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

$('#deletePostBtn').click((e) => {
	$.ajax({  //DELETE POST
		url:`<?=$GLOBALS['websitePath']?>/api/post/${e.target.dataset.id}/delete`,
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

$('.validateComment').click((e) => {
	e.preventDefault();
	e.stopPropagation();

	let commentID = $(e.target).parent().data("id");
	$.ajax({
		url:`<?= $GLOBALS['websitePath'] ?>/api/post/${e.target.dataset.postId}/comment/${e.target.dataset.commentId}/validate`
	}).done((data) =>{
		var container = new UploadContainer($("ul.notifications"));
		if (data == 1) {
		container.addMessage("Commentaire validé avec succès !");
		e.target.innerHTML= "Validé !";
		}
		else {
			container.addMessage("Erreur ! Veuillez réessayer");
			e.target.innerHTML= "Erreur, rechargez la page !";
		}	
	});
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

$('.deleteModalTrigger').click(function() {
	var id = $(this).data('id');
	var title = $(this).data('postTitle');
	console.log(id);
	$('#deletePostBtn').attr('data-id', id);
	$('.modal-body').html(`Attention ! La suppression d'un billet de blog est irréversible !<br> Etes vous sur de vouloir supprimé le billet suivant : <br> "<b>${title}</b>" ?`);
});

$('.anchorComments').click((e) => {
	e.preventDefault();
	e.stopPropagation();
	$([document.documentElement, document.body]).animate({
        scrollTop: $("#anchorComments").offset().top
    }, 1000);
});
</script>

<?php
$content = ob_get_clean();
require_once('template.php'); ?>
