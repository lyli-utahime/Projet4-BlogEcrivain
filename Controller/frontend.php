<?php

namespace Controller;

require_once(__DIR__ . "/../Model/PostManager.php");
require_once(__DIR__ . "/../Model/CommentManager.php");
require_once(__DIR__ . "/../Model/Pagination.php");
require_once(__DIR__ . "/../Model/ReportManager.php");

// chargement des classes
use Model\PostManager;
use Model\CommentManager;
use Model\Pagination;
use Model\ReportManager;

class Frontend {
// pour les derniers posts sur la page d'accueil
    public function listPosts() {
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
            } else {
                header('Location: index.php?action=erreur404');
            }
        }

        $posts = $postManager->getPosts($cPage, $postsPerPage);

        require(__DIR__ . '/../View/frontend/home.php');
    }

// pour afficher un seul billet
    public function post() {
        $postManager = new PostManager();
        $commentManager = new CommentManager();
        
        $postId = (int) $_GET['id'];

        $post = $postManager->getPost($postId);
        $comments = $commentManager->getComments($postId);

        require(__DIR__ . '/../View/frontend/postView.php');
    }

// mentions légales
    public function mentionsLegales() {
        require(__DIR__ . '/../View/frontend/mentionslegales.php');
    }

// page 404
    public function erreur404($e) {
        require(__DIR__ . '/../View/frontend/erreur404.php');
    }
}