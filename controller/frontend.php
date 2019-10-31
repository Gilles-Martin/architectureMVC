<?php

/** Loading Classes */
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

/**
 * Show all posts
 */
function listPosts()
{
    $postManager = new \Gilles\Blog\Model\PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}

/**
 * Post with all comments and 1 form to add comment
 */
function post()
{
    $postManager = new \Gilles\Blog\Model\PostManager();
    $commentManager = new \Gilles\Blog\Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

/**
 * Add a comment by POST data
 * @param int $postId
 * @param string $author
 * @param sting $comment
 * @throws Exception
 */
function addComment($postId, $author, $comment)
{
    $commentManager = new \Gilles\Blog\Model\CommentManager();
    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    } else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

/**
 * Form for updating coment
 * 
 * @param int $postId
 * @param int $commentId
 */
function formUpdateCommand($postId, $commentId)
{
    $postManager = new \Gilles\Blog\Model\PostManager();
    $commentManager = new \Gilles\Blog\Model\CommentManager();

    $post = $postManager->getPost($postId);
    $comment = $commentManager->getComment($commentId);

    require('view/frontend/formUpdateView.php');
}

/**
 * Update comment from POST
 * @param int $postId 
 * @param string $commentId
 * @param string $comment
 * @throws Exception
 */
function updateCommand($postId, $commentId, $comment)
{
    $commentManager = new \Gilles\Blog\Model\CommentManager();
    $affectedLines = $commentManager->updateComment($commentId, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    } else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
