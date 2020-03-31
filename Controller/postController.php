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

class PostController {
// affichage du formulaire pour créer un billet
    public function create() {
        require(__DIR__ . '/../View/backend/createPost.php');
    }
// pour ajouter un billet
    public function newPost($title, $extract, $content) {
        $postManager = new PostManager();

        $newPost = $postManager->createPost($title, $extract, $content);

        Header('Location: index.php?action=displayAdmin&newPost=success');
    }

// pour modifier un billet
    public function displayUpdate() {
        $postManager = new PostManager();

        $post = $postManager->getPostUpdate($_GET['id']);
        require(__DIR__ . '/../View/backend/updatePost.php');
    }

    public function submitUpdate($title, $extract, $content, $postId) {
        $postManager = new PostManager();

        $updated = $postManager->updatePost($title, $extract, $content, $postId);

        Header('Location: index.php?action=displayAdmin&submitUpdate=success');
    }

// pour supprimer un billet
    public function removePost($postId) {
        $postManager = new PostManager();

        $deletedPost = $postManager->deletePost($postId);

        Header('Location: index.php?action=displayAdmin');
    }
}