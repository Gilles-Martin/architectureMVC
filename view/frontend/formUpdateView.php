<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php?action=listPosts">Retour à la liste des billets</a></p>


<div class="news">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
    </h3>

    <p>
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </p>
</div>

<h2>Modification du commentaire</h2>

<form action="index.php?action=updateComment&amp;id=<?= $post['id'] ?>&amp;idComment=<?= $comment['id'] ?>" method="post">
    <div>
        <label for="author">Auteur</label><br />
        <input type="text" id="author" value="<?= $comment['author'] ?>" disabled/>
    </div>
    <div>
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"><?= $comment['comment'] ?></textarea>
    </div>
    <div>
        <input type="submit" value="Modifier le commentaire" />
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>