<?php $title = 'Administration du blog'; ?>

<?php ob_start(); ?>


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
					<div class="ticket">
						<h2>
							<?= htmlspecialchars($post['title']) ?>
						</h2>
						<br />
						<div class="adminOptions">
							<p><i class="far fa-eye"></i><input type="button" class="viewPost" data-id="<?=$post['id']?>" name="viewPost" value="Voir le billet"></p>
							<p><i class="fas fa-edit"></i><input type="button" class="updatePost" data-id="<?=$post['id']?>" name="updatePost" value="Mettre à jour le billet"></p>
							<p><i class="far fa-trash-alt"></i><input type="button" class="deletePost" data-id="<?=$post['id']?>" name="deletePost" value="Supprimer le billet"></p>
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
							<p class="testdebug"><i class="far fa-eye"></i><input type="button" class="viewComment" data-id="<?=$post['id']?>" name="viewComment" value="Voir"></p>
							<p class="testdebug"><i class="fas fa-gavel"></i><input type="button" class="updateComment" data-id="<?=$reportedComment['id']?>" name="updateComment" value="Moderer"></p>
							<p class="testdebug"><i class="far fa-trash-alt"></i><input type="button" class="deleteComment" data-id="<?=$reportedComment['id']?>" name="deleteComment" value="Supprimer"></p>
						</div>
					</div>
				</div>
			<?php
			}
			?>
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
</script>

<?php
$content = ob_get_clean();
require_once('template.php'); ?>
