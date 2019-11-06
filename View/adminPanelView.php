<?php $title = 'Administration du blog'; ?>

<?php ob_start(); ?>
<p>Panneau Admin</p>


<?php
foreach ($posts as $post )
{
?>
    <div class="post">
		<div class="ticket">
			<h2>
				<?= htmlspecialchars($post['title']) ?>
			</h2>
			<br />
			<div class="postOptions">
				<p><em><i class="far fa-eye"></i><a href="<?=$GLOBALS['websitePath']?>/post/<?=$post['id']?>">Voir le Billet</a></em></p>
				<p><em><i class="fas fa-edit"></i><a href="<?=$GLOBALS['websitePath']?>/post/<?=$post['id']?>/update">Modifier le billet</a></em></p>
				<p><em><i class="far fa-trash-alt"></i><a href="<?=$GLOBALS['websitePath']?>/api/post/<?=$post['id']?>/delete">Supprimer le billet</a></em></p>
			</div>
		</div>
    </div>
<?php
}
$content = ob_get_clean();
require_once('template.php'); ?>
