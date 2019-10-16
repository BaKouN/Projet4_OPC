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
<button type='button' class='testBtn'>TEST</button>
<script>
$(document).ready(() => { 
	$('.testBtn').click(() => // POST COMMENT ON CLICK
	{	
		let author = $('#author').val();
		let content = $('#trumbowyg-demo').trumbowyg('html');
		console.log('avant le IF');
		if (!author.length || !content.length) return; console.log("Apres le IF");
		$.ajax({
			url: '<?= $GLOBALS['websitePath'] ?>/api/post/<?= $postID ?>/comment/create',
			method: "POST",
			data: {
				author: author,
				content: content
			}
		}).done((data) =>{
			console.log(data);
		})
	});
	$('#trumbowyg-demo').trumbowyg({
		lang: 'fr'
	});

	$.ajax({
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
				</li>
			`);
			console.table(element);
		});

	});
});

</script>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
