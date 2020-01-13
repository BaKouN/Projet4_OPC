<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<div class="container">
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
				<div class="ticketContent">
					<?php 
						$trimmedText = $postController->shortText(strip_tags($post['content'])); 
						echo $trimmedText;
					?>
				</div>
				<p><a href="<?=$GLOBALS['websitePath']?>/post/<?=$post['id']?>">En savoir plus...</a></p>
			</div>
		</div>
	<?php
	} ?>
</div>

<script>
$('#navPost').addClass("active");
</script>
<?php
$content = ob_get_clean(); 
require_once('template.php'); ?>
