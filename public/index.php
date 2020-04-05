<?php
 
session_start();
 
require_once(__DIR__ . '/../Controller/Frontend.php');
require_once(__DIR__ . '/../Controller/PostController.php');
require_once(__DIR__ . '/../Controller/CommentController.php');
require_once(__DIR__ . '/../Controller/AdminController.php');

use Controller\Frontend;
use Controller\PostController;
use Controller\CommentController;
use Controller\AdminController;

$frontend = new Frontend();
$postController = new PostController();
$commentController = new CommentController();
$adminController = new AdminController();

try {
    if (isset($_GET['action'])) {

//-----------------------------------------------------------
//                 blog visible par tous
//-----------------------------------------------------------
// affichage des billets en page d'accueil
        if ($_GET['action'] === 'listPosts') {
            $frontend->listPosts();
// affichage d'un seul billet et les commentaires
        } elseif ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && (int) $_GET['id'] > 0) {
                $frontend->post();
            } else {
                throw new Exception('Aucun billet envoyé');
            }
// ajouter un commentaire
        } elseif ($_GET['action'] === 'addComment') {
            if (isset($_GET['id']) && (int) $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    $commentController->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception("Impossible d'envoyer le formulaire");
            }
// signaler un commentaire
        } elseif ($_GET['action'] === 'postReport') {
            $commentController->postReport($_GET['comment_id']);
// mentions légales
        } elseif ($_GET['action'] == 'mentionsLegales') {
        $frontend->mentionsLegales();

//-----------------------------------------------------------
//                    connexion
//-----------------------------------------------------------
// lien vers formulaire de connexion
        } elseif ($_GET['action'] === 'displayLoginAdmin') {
            $adminController->displayLoginAdmin();
// lien vers le formulaire
        } elseif ($_GET['action'] === 'loginAdmin') {
            $adminController->loginAdmin();
// lien vers administration
        } elseif ($_GET['action'] === 'displayAdmin' && isset($_SESSION)) {
            $adminController->displayAdmin();

//-----------------------------------------------------------
//                    administration
//-----------------------------------------------------------
// formulaire pour créer un billet
        } elseif ($_GET['action'] === 'create') {
            if (isset($_SESSION)) {
                $postController->create();
            } else {
                throw new Exception('Administrateur non identifié');
            }
// ajouter un billet
        } elseif ($_GET['action'] === 'newPost') {
            if (!empty($_POST['title']) && !empty($_POST['extract']) && !empty($_POST['content'])) {
                $postController->newPost($_POST['title'], $_POST['extract'], $_POST['content']);
            } else {
                throw new Exception('Contenu vide !');
            }
// formulaire pour modifier un billet
        } elseif ($_GET['action'] === 'displayUpdate') {
            if (isset($_GET['id']) && (int) $_GET['id'] > 0) {
                if ('1' == isset($_SESSION)) {
                    $postController->displayUpdate();
                }
            } else {
                throw new Exception('Administrateur non identifié');
            }
// modifier un billet
        } elseif ($_GET['action'] === 'submitUpdate') {
            $postController->submitUpdate($_POST['title'], $_POST['extract'], $_POST['content'], $_GET['id']);
// supprimer un billet
        } elseif ($_GET['action'] === 'removePost') {
            $postController->removePost($_GET['id']);
// afficher la liste des commentaires signalés
        } elseif ($_GET['action'] === 'displayReportsComments') {
            $commentController->displayReportsComments($_GET['id'], $_GET['comment_id'], $_GET['author'], $_GET['comment']);
// afficher la page de modération des commentaires
        } elseif ($_GET['action'] === 'dispayRemoveComment') {
            $commentController->dispayRemoveComment();
// supprimer un commentaire
        } elseif ($_GET['action'] === 'removeComment') {
            $commentController->removeComment($_GET['comment_id']);
// supprimer un commentaire signalé
        } elseif ($_GET['action'] === 'removeCommentReport') {
            $commentController->removeCommentReport($_GET['comment_id']);
        }
    } else {
        $frontend->listPosts();
    }
} catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}