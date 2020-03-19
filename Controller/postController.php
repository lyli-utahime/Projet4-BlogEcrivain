<?php

namespace Controller;

require_once(__DIR__ . "/../Model/PostManager.php");
require_once(__DIR__ . "/../Model/CommentManager.php");
require_once(__DIR__ . "/../Model/Pagination.php");
require_once(__DIR__ . "/../Model/Admin.php");
require_once(__DIR__ . "/../Model/ReportManager.php");
require_once(__DIR__ . "/../Model/MemberManager.php");

// chargement des classes
use Model\PostManager;
use Model\CommentManager;
use Model\Pagination;
use Model\Admin;
use Model\ReportManager;
use Model\MemberManager;

class PostController {
    // affichage du formulaire pour s'enregistrer
    function displayLogIn() {
        require(__DIR__ . '/../view/frontend/login.php');
    }

    // pour s'enregistrer
    function logInAdmin() {
        if (isset($_POST['pass']) AND $_POST['pass'] == "test") {
            header('Location: index.php?action=displayAdmin');
        } else {
            header('Location: index.php?action=logInAdmin&account-status=unsuccess-login');
        }
    }

    // affichage du panneau d'administration
    function displayAdmin() {
        $postManager = new PostManager(); 
        $pagination = new Pagination();

        $postsPerPage = 4;
    
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

        require(__DIR__ . '/../view/backend/adminView.php');
    }

    // affichage du formulaire pour créer un billet
    function create() {
        require(__DIR__ . '/../View/backend/createPostView.php');
    }
    // pour ajouter un billet
    function newPost($title, $content) {
        $postManager = new PostManager();

        $newPost = $postManager->createPost($title, $content);

        Header('Location: index.php?action=admin&newPost=success');
    }

    // pour modifier un billet
    function displayUpdate() {
        $postManager = new PostManager();
    
        $post = $postManager->getPost($_GET['id']);
        require('view/backend/updatePostView.php');
    }
    
    function submitUpdate($title, $content, $postId) {
        $postManager = new PostManager();
        
        $updated = $postManager->updatePost($title, $content, $postId);
    
        Header('Location: index.php?action=admin&update-status=success');
    }

    // pour supprimer un billet
    function removePost($postId) {
        $postManager = new PostManager();
    
        $deletedPost = $postManager->deletePost($postId);
    
        Header('Location: index.php?action=admin&remove-post=success');
    }
    
    // pour supprimer un commentaire
    function removeComment($commentId) {
        $commentManager = new CommentManager();
    
        $deletedComment = $commentManager->deleteComment($commentId);
    
        Header('Location: index.php?action=admin&remove-comment=success');
    }
}