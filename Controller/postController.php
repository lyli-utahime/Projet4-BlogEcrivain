<?php

require_once(__DIR__ . "/../Model/PostManager.php");
require_once(__DIR__ . "/../Model/CommentManager.php");
require_once(__DIR__ . "/../Model/Pagination.php");

// chargement des classes
use Model\PostManager;
use Model\CommentManager;
use Model\Pagination;

// les fonctions

class PostController
{
    // affichage du formulaire pour créer un billet
    function create() {
        require(__DIR__ . '/../View/frontend/createPostView.php');
    }
    // pour ajouter un billet
    function newPost($title, $content) {
        $postManager = new PostManager();

        $newPost = $postManager->createPost($title, $content);

        Header('Location: index.php?ction=admin&new-post=success');
    }
}