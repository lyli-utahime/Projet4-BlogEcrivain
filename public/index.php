<?php
 
session_start();
 
require_once(__DIR__ . '/../Controller/Frontend.php');
require_once(__DIR__ . '/../Controller/postController.php');

use Controller\Frontend;
use Controller\postController;

$frontend = new Frontend();
$postController = new PostController();

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            $frontend->listPosts();
        } elseif ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && (int) $_GET['id'] > 0) {
                $frontend->post();
            } else {
                throw new Exception('Aucun billet envoyé');
            }
        } elseif ($_GET['action'] === 'addComment') {
            if (isset($_GET['id']) && (int) $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    $frontend->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception("Impossible d'envoyer le formulaire");
            }
        } elseif ($_GET['action'] == 'logout') {
            $frontend->logout();
        } elseif ($_GET['action'] == 'postReport') {
            $frontend->postReport($_GET['id'], $_GET['comment-id'], $_SESSION['id']);
        } elseif ($_GET['action'] == 'loginAdmin') {
            if (isset($_SESSION)) {
                $postController->loginAdmin();
            }
        } elseif ($_GET['action'] === 'displayAdmin') {
            if (isset($_SESSION)) {
                $postController->displayAdmin();
            }
        } elseif ($_GET['action'] === 'create') {
            if (isset($_SESSION)) {
                $postController->create();
            } else {
                throw new Exception('Administrateur non identifié');
            }
        } elseif ($_GET['action'] === 'newPost') {
            if (!empty($_POST['title']) && !empty($_POST['extract']) && !empty($_POST['content'])) {
                $frontend->newPost($_POST['title'], $_POST['extract'], $_POST['content']);
            } else {
                throw new Exception('Contenu vide !');
            }
        } elseif ($_GET['action'] == 'displayUpdate') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (isset($_SESSION) && $_SESSION['groups_id'] == '1') {
                    $postController->displayUpdate();
                }  
            } else {
                throw new Exception('Administrateur non identifié');
            }
        } elseif ($_GET['action'] == 'submitUpdate') {
            $postController->submitUpdate($_POST['title'], $_POST['content'], $_GET['id']);
        } elseif ($_GET['action'] == 'removePost') {
            $postController->removePost($_GET['id']);
        } elseif ($_GET['action'] == 'removeComment') {
            $postController->removeComment($_GET['id']);
        } 
    } else {
        $frontend->listPosts();
    }
} catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}