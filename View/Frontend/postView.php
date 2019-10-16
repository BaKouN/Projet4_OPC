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
$('.testBtn').click(() =>
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
</script>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
