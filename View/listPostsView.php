<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<div class="container-fluid brand-bg">
	<div class="container">
		<p>Derniers billets du blog :</p>
		<?php
		$postController = new postController();
		foreach ($posts as $post )
		{
		?>
			<div class="col-11 offset my-3 p-3" onclick="location.href='<?=$GLOBALS['websitePath']?>/post/<?=$post['id']?>';">
					<h2 class="display-5">
						<?= htmlspecialchars($post['title']) ?>
					</h2>
					<div class="ticketContent">
						<?php 
							$decodedContent = htmlspecialchars_decode($post['content']);
							$spacedContent = str_replace('<', ' <', $decodedContent);
							$strippedContent = strip_tags($spacedContent);
							$trimmedText = $postController->shortText($strippedContent); 
							echo $trimmedText;
						?>
					</div>
					<small><em>le <?= $post['creation_date_fr'] ?></em></small>
			</div>
		<?php
		} ?>
	</div>
</div>

<script>
$('#navPost').addClass("active");
</script>
<?php
$content = ob_get_clean(); 
require_once('template.php'); ?>
