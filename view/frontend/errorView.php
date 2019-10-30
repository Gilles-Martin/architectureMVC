<?php $title = 'Error Message' ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php?action=listPosts">Retour à la liste des billets</a></p>


<div class="error-message">   
        <?= $errorMessage ?>   
</div>



<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>