<?php

require_once(__DIR__ . "/../Model/PostManager.php");
require_once(__DIR__ . "/../Model/CommentManager.php");
require_once(__DIR__ . "/../Model/Pagination.php");

// chargement des classes
use Model\PostManager;
use Model\CommentManager;
use Model\Pagination;

// les fonctions

// pour les derniers posts sur la page d'accueil
function listPosts()
{
    $pagination = new Pagination();
    $postManager = new PostManager();

    $postsPerPage = 4;

    $nbPosts = $pagination->getPostsPagination();
    $nbPage = $pagination->getPostsPages($nbPosts, $postsPerPage);

    if (!isset($_GET['page'])) {
        $cPage = 0;
    } else {
    if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPage) {
    $cPage = (intval($_GET['page']) - 1) * $postsPerPage;
        }
    }
    
    $posts = $postManager->getPosts($cPage, $postsPerPage);

    require(__DIR__ . '/../View/frontend/home.php');
}

// pour affciher un seul billet
function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require(__DIR__ . '/../View/frontend/postView.php');
}

// pour afficher la liste complète des posts
//function pagePosts()
//{
//    $postManager = new PostManager();
 //   $pagination = new Pagination();

//    $postsPerPage = 4;
//    $nbPosts = $pagination->getPostsPagination();
//    $nbPage = $pagination->getPostsPages($nbPosts, $postsPerPage);

//    if (!isset($_GET['page'])) {
//        $cPage = 0;
//    } else {
//        if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPage) {
//            $cPage = (intval($_GET['page']) - 1) * $postsPerPage;
//        }
//    }

//    $posts = $postManager->allPosts($cPage, $postsPerPage);

//    require(__DIR__ . '/../View/frontend/listPostView.php');
//}

// pour ajouter un commentaire
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
