<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<div class="ticket">
	<h2><?= htmlspecialchars($post['title']);?></h2>
	<em><?= $post['creation_date_fr'];?></em>
	<p><?= nl2br(htmlspecialchars($post['content']));?></p>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
