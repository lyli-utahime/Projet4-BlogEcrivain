<?php

require_once(__DIR__ . "/../Model/PostManager.php");
require_once(__DIR__ . "/../Model/CommentManager.php");

// chargement des classes
use Model\PostManager;
use Model\CommentManager;

// les fonctions
function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();

    require(__DIR__ . '/../View/frontend/home.php');
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require(__DIR__ . '/../View/frontend/postView.php');
}

function pagePosts()
{
    $postManager = new PostManager();
    $posts = $postManager->allPosts();

    require(__DIR__ . '/../View/frontend/listPostView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
