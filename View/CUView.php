<?php $title = 'Creer un nouveau billet'; ?>

<?php ob_start(); ?>
<label for='title'>Titre :</label>
<input type=text id='title' name='title'>
<textarea id='trumbowyg-demo'></textarea>
<button type='button' class='postBtn'>Poster ce nouveau billet</button>
<script>
	$('#trumbowyg-demo').trumbowyg({ // Transformation de la div en WYSIWYG
		lang: 'fr'
	});

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
			return data;
		});
	});
</script>

<?php $content = ob_get_clean(); ?>

<?php require_once('template.php'); ?>
