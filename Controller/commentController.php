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
            header('Location: index.php?action=post&id=' . $postId . '&addComment=success#comments');
        }
    }

// signaler un commentaire
    public function postReport($commentId) {
        $reportManager = new ReportManager();

        $commentId = (int) $_GET['comment_id'];
        $reported = $reportManager->postReports($commentId);

        if ($reported === false) {
            throw new Exception('impossible de signaler le commentaire !');
        } else {
            header('Location: index.php?action=post&id=' . $_GET['id'] . '&report=success#comments');
        }
    }

// afficher la liste des commentaires signalés
    public function displayReportsComments($commendId, $author, $postId, $comment) {
        $reportManager = new reportManager();

        $reported = $reportManager->postReports($postId, $commentId);
        $reports = $reportManager->insertReports();

        require(__DIR__ . '/../View/backend/adminView.php');
    }

// afficher la page modération des commentaires
    public function displayRemoveComment() {
        $postManager = new PostManager();
        $commentManager = new CommentManager();

        $post = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);

        require(__DIR__ . '/../View/backend/commentManage.php');
    }

// pour supprimer un commentaire
public function removeComment($commentId) {
    $commentManager = new CommentManager();

    $deletedComment = $commentManager->deleteComment($commentId);

    Header('Location: index.php?action=displayRemoveComment&id=' . $_GET['id'] . '&removeComment=success#comments');
}

// pour supprimer un commentaire signalé
    public function removeCommentReport($commentId, $author) {
        $commentManager = new CommentManager();

        $deletedComment = $commentManager->deleteCommentReport($commentId, $author);

        Header('Location: index.php?action=displayAdmin&removeComment=success#commentManage');
    }
}