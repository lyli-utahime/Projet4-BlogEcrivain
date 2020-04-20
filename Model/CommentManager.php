<?php

namespace Model;

require_once("Manager.php");

class CommentManager extends Manager {
// page post : récupère les commentaires sous un billet
    public function getComments($postId) {
        $bdd = $this->dbConnect();
        $comments = $bdd->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

// fonction pour poster un commentaire
    public function postComment($postId, $author, $comment) {
        $bdd = $this->dbConnect();
        $comments = $bdd->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');

        return $comments->execute(array($postId, $author, $comment));
    }

// supprimer un commentaire
    public function deleteComment($commentId) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM comments WHERE id = ?');

        return $req->execute(array($commentId));
}

// supprimer un commentaire signalé
    public function deleteCommentReport($commentId) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare("DELETE FROM comments WHERE id= ?");

        return $req->execute(array($commentId));
    }
    
// Suppression d'un commentaire si le billet est supprimé
    public function deleteComments($postId) {
        $bdd = $this->dbConnect();
        $req = $this->db->prepare('DELETE FROM comments WHERE post_id = ?');

        return $req->execute(array($postId));
    }
}
