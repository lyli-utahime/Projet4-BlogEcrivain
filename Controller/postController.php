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

        header('Location: index.php?action=displayAdmin&newPost=success#postManage');
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

        header('Location: index.php?action=displayAdmin&submitUpdate=success#postManage');
    }

// pour supprimer un billet
    public function removePost($postId) {
        $postManager = new PostManager();
        $commentManager= new CommentManager();

        $deletedPost = $postManager->deletePost($postId);

         if ($deleteChapter === false || $deleteComments === false) {
            throw new Exception('Impossible de supprimer ce chapitre.');
        } else {
            header('Location: index.php?action=displayAdmin&removePost=success#postManage');
        }
    }
}