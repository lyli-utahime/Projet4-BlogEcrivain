<?php

namespace Controller;

// chargement des classes
use Model\PostManager;
use Model\CommentManager;
use Model\Pagination;
use Model\ReportManager;

class commentController {
// pour ajouter un commentaire
    public function addComment($postId, $author, $comment) {
        $commentManager = new CommentManager();

        $affectedLines = $commentManager->postComment($postId, $author, $comment);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=post&id=' . $postId);
        }
    }

// signaler un commentaire
    public function postReport() {
        $reportManager = new ReportManager();

        $reported = $reportManager->postReports($_GET['comment_id']);

        if ($reported === false) {
            throw new Exception('impossible de signaler le commentaire !');
        } else {
            header('Location: index.php?action=post&id=' . $postId . '&report=success#comments');
        }
    }

// afficher la page modération des commentaires
    public function dispayRemoveComment() {
        $postManager = new PostManager();
        $commentManager = new CommentManager();

        $post = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);
        $deletedComment = $commentManager->deleteComment($_GET['comment_id']);

        require(__DIR__ . '/../View/backend/commentManage.php');
    }

// pour supprimer un commentaire
    public function removeComment($commentId) {
        $commentManager = new CommentManager();

        $deletedComment = $commentManager->deleteComment($_GET['comment_id']);

        Header('Location: index.php?action=displayAdmin');
    }
}