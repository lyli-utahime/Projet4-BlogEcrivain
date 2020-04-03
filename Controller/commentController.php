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
    public function postReport($postId) {
        $reportManager = new ReportManager();
        $postManager = new PostManager();

        $reported = $reportManager->postReports($_GET['comment_id']);
        $post = $postManager->getPost($postId);

        if ($reported === false) {
            throw new Exception('impossible de signaler le commentaire !');
        } else {
            header('Location: index.php?action=post&id=' . $postId . '&report=success#comments');
        }
    }

// afficher la liste des commentaires signalés
    public function displayReportsComments($postId, $commendId, $author, $comment) {
        $commentManager = new CommentManager();
        $postManager = new PostManager();

        $post = $postManager->getPost($postId);
        $comments = $commentManager->getComments($postId);
        $reported = $reportManager->postReports($commentId);
        $reportsJoin = $reportManager->insertReports($commendId, $author, $comment);

        require(__DIR__ . '/../View/backend/adminView.php');
    }

// afficher la page modération des commentaires
    public function dispayRemoveComment() {
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

        Header('Location: index.php?action=removeComment&comment_id' . $postId . '&report=success#comments');
    }

// pour supprimer un commentaire signalé
    public function removeCommentReport($commentId) {
        $commentManager = new CommentManager();

        $deletedComment = $commentManager->deleteCommentReport($commentId);

        Header('Location: index.php?action=displayAdmin');
    }
}