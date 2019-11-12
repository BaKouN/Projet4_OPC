<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<p>Derniers billets du blog :</p>


<?php
$postController = new postController();
foreach ($posts as $post )
{
?>
    <div class="post">
		<div class="ticket">
			<h2>
				<?= htmlspecialchars($post['title']) ?>
			</h2>
			<p><em>le <?= $post['creation_date_fr'] ?></em></p>
			<p>
				<?= $postController->shortText(nl2br(htmlspecialchars_decode($post['content']))) ?>
				<br />
				<em><a href="<?=$GLOBALS['websitePath']?>/post/<?=$post['id']?>">En savoir plus...</a></em>
			</p>
		</div>
    </div>
<?php
}
$content = ob_get_clean(); 
require_once('template.php'); ?>
