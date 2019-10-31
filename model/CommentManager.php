<?php

namespace Gilles\Blog\Model; // La classe sera dans ce namespace

require_once("model/Manager.php");

class CommentManager extends Manager
{

    function getComments($postId)
    {

        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    function getComment($postIdComment)
    {

        $db = $this->dbConnect();
        $comment = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ? ');
        $comment->execute(array($postIdComment));      

        return $comment->fetch();
    }

    function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    function updateComment($commentId, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET comment=?, comment_date=NOW() WHERE id=?');
        $affectedLines = $comments->execute(array($comment, $commentId));

        return $affectedLines;
    }

}
