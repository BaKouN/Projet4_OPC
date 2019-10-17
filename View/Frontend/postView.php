<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<div class="ticket">
	<h2><?= htmlspecialchars($post['title']);?></h2>
	<em><?= $post['creation_date_fr'];?></em>
	<p><?= nl2br(htmlspecialchars($post['content']));?></p>
</div>
<label for='author'>Pseudonyme : </label>
<input type=text id='author' name='author'>
<textarea id='trumbowyg-demo'></textarea>
<button type='button' class='postBtn'>Commenter</button>
<script>
	$('#trumbowyg-demo').trumbowyg({ // Transformation de la div en WYSIWYG
		lang: 'fr'
	});

	$(document).ready(() => {
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
					<li class="comments" data-id="` + element['id']+ `">
						<p class="author">` + element['author'] + `</p>
						<p class="commentDate">` + element['comment_date_fr'] + `</p>
						<p class="commentContent">` + element['comment'] + `</p>
						<button class="deleteBtn">Supprimer commentaire</button>
					</li>
				`);
			});

			$('.deleteBtn').click((e) => {
				let commentID = $(e.target).parent().data("id");
				$.ajax({ // DELETE COMMENTS
				url:'<?= $GLOBALS['websitePath'] ?>/api/post/<?= $postID ?>/comment/' + commentID + '/delete'
				}).done((data) =>{
					console.log(data.status);
				});
			});
		});

		$('.postBtn').click(() => // POST COMMENT ON CLICK
		{	
			let author = $('#author').val();
			let content = $('#trumbowyg-demo').trumbowyg('html');
			if (!author.length || !content.length) return;
			$.ajax({
				url: '<?= $GLOBALS['websitePath'] ?>/api/post/<?= $postID ?>/comment/create',
				method: "POST",
				data: {
					author: author,
					content: content
				}
			}).done((data) =>{
				console.log(data);
			});
		});
	});
</script>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
