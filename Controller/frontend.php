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
        $cPage = 1;

        if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPage) {
            $cPage = (intval($_GET['page']) - 1) * $postsPerPage;
        }

        $posts = $postManager->getPosts($cPage, $postsPerPage);

        require(__DIR__ . '/../View/frontend/home.php');
    }

// pour afficher un seul billet
    public function post() {
        $postManager = new PostManager();
        $commentManager = new CommentManager();

        $post = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);

        require(__DIR__ . '/../View/frontend/postView.php');
    }

// mentions légales
    public function mentionsLegales() {
        require(__DIR__ . '/../View/frontend/mentionslegales.php');
    }

// page 404
    public function error404($e) {
        require(__DIR__ . '/../View/frontend/error404.php');
    }
}