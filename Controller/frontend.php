<?php

namespace Controller;

require_once(__DIR__ . "/../Model/PostManager.php");
require_once(__DIR__ . "/../Model/CommentManager.php");
require_once(__DIR__ . "/../Model/Pagination.php");
//require_once(__DIR__ . "/../Model/ReportManager.php");
//require_once(__DIR__ . "/../Model/MemberManager.php");

// chargement des classes
use Model\PostManager;
use Model\CommentManager;
use Model\Pagination;
//use Model\ReportManager;
//use Model\MemberManager;

class Frontend {
    // pour les derniers posts sur la page d'accueil
    function listPosts() {
        $pagination = new Pagination();
        $postManager = new PostManager();

        $postsPerPage = 3;

        $nbPosts = $pagination->getPostsPagination();
        $nbPage = $pagination->getPostsPages($nbPosts, $postsPerPage);

        if (!isset($_GET['page'])) {
            $cPage = 1;
        } else {
        if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPage) {
        $cPage = (intval($_GET['page']) - 1) * $postsPerPage;
            }
        }
        
        $posts = $postManager->getPosts($cPage, $postsPerPage);

        require(__DIR__ . '/../View/frontend/home.php');
    }

    // pour afficher un seul billet
    function post() {
        $postManager = new PostManager();
        $commentManager = new CommentManager();

        $post = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);

        require(__DIR__ . '/../View/frontend/postView.php');
    }

    // pour ajouter un commentaire
    function addComment($postId, $author, $comment) {
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
    function postReport($postId, $commentId, $memberId) {
        $reportManager = new ReportManager();

        $reported = $reportManager->postReports($commentId, $memberId);

        header('Location: index.php?action=post&id=' . $postId . '&report=success#commentsFrame');
    }

    // function pour se connecter
    function loginSubmit($pseudo, $pass) {
        $memberManager = new MemberManager();

        $member = $memberManager->loginMember($pseudo);

        $isPasswordCorrect = password_verify($_POST['pass'], $member['pass']);

        if (!$member) {
            header('Location: index.php?action=login&account-status=unsuccess-login');
        }
        else {
            if ($isPasswordCorrect) {
                $_SESSION['id'] = $member['id'];
                $_SESSION['pseudo'] = ucfirst(strtolower($pseudo));
                $_SESSION['groups_id'] = $member['groups_id'];
                header('Location: index.php');
            }
            else {
                header('Location: index.php?action=login&account-status=unsuccess-login');
            }
        }
    }

    // deconnexion
    function logout() {
        $_SESSION = array();
        setcookie(session_name(), '', time() - 42000);
        session_destroy();

        header('Location: index.php?logout=success');
    }
}