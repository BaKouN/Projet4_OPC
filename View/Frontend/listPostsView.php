<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p>Derniers billets du blog :</p>


<?php
while ($post = $posts->fetch())
{
?>
    <div class="post">
		<div class="ticket">
			<h2>
				<?= htmlspecialchars($post['title']) ?>
				<em>le <?= $post['creation_date_fr'] ?></em>
			</h2>
			
			<p>
				<?= nl2br(htmlspecialchars($post['content'])) ?>
				<br />
				<em><a href="<?=$GLOBALS['websitePath']?>/post/<?=$post['id']?>">En savoir plus...</a></em>
			</p>
		</div>
    </div>
<?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
