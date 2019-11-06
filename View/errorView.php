<?php $title = 'Erreur'; ?>

<?php ob_start(); ?>
<h1 >Il y a un petit probleme ...</h1>
<p>Mais ne vous inquietez pas, on s'occupe de tout ;)</p>

<p>Mais si tu es un petit malin, tu peux essayer de voir de quoi ça parle :</p> <br>
<p class="error"><?= 'Erreur : ' . $e->getMessage(); ?></p>

<?php $content = ob_get_clean(); ?>

<?php require_once('template.php'); ?>
