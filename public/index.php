<?php
 
session_start();
 
require_once(__DIR__ . '/../Controller/frontend.php');
require_once(__DIR__ . '/../Controller/postController.php');
require_once(__DIR__ . '/../Controller/commentController.php');
require_once(__DIR__ . '/../Controller/adminController.php');

// chargement des classes
use Controller\Frontend;
use Controller\PostController;
use Controller\CommentController;
use Controller\AdminController;

// Filtres pour les $_GET
$argsGet = array(
    "action" => FILTER_SANITIZE_STRING,
    "id" => FILTER_VALIDATE_INT,
    "comment_id" => FILTER_VALIDATE_INT,
);
$getClean = filter_var_array($_GET, $argsGet);

// Filtres pour les $_POST
$argsPost = array(
    "title" => FILTER_SANITIZE_URL,
    "extract" => FILTER_SANITIZE_SPECIAL_CHARS,
    "content" => FILTER_SANITIZE_SPECIAL_CHARS,
    "author" => FILTER_SANITIZE_STRING,
    "comment" => FILTER_SANITIZE_STRING,
);
$postClean = filter_var_array($_POST, $argsPost);

$frontend = new Frontend();
$postController = new PostController();
$commentController = new CommentController();
$adminController = new AdminController();

try {
    if (isset($getClean['action'])) {

/**---------------------------------------------------------------------------*
*-----------------------blog visible pour tous--------------------------------*
*-----------------------------------------------------------------------------*/

// affichage des billets en page d'accueil
        if ($getClean['action'] === 'listPosts') {
            $frontend->listPosts();
// affichage d'un seul billet et les commentaires
        } elseif ($getClean['action'] === 'post') {
            if (isset($getClean['id']) && $getClean['id'] > 0) {
                $frontend->post();
            } else {
                throw new Exception('Aucun billet envoyé');
            }
// ajouter un commentaire
        } elseif ($getClean['action'] === 'addComment') {
            if (isset($getClean['id']) && $getClean['id'] > 0) {
                if (!empty($postClean['author']) && !empty($postClean['comment'])) {
                    $commentController->addComment($getClean['id'], $postClean['author'], $postClean['comment']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception("Impossible d'envoyer le formulaire");
            }
// signaler un commentaire
        } elseif ($getClean['action'] === 'postReport') {
            $commentController->postReport($getClean['comment_id']);
// mentions légales
        } elseif ($getClean['action'] == 'mentionsLegales') {
        $frontend->mentionsLegales();

/**---------------------------------------------------------------------------*
*--------------------------------connexion------------------------------------*
*-----------------------------------------------------------------------------*/

// lien vers formulaire de connexion
        } elseif ($getClean['action'] === 'displayLoginAdmin') {
            $adminController->displayLoginAdmin();
// lien vers le formulaire
        } elseif ($getClean['action'] === 'loginAdmin') {
            $adminController->loginAdmin();
// lien vers administration
        } elseif ($getClean['action'] === 'displayAdmin' && isset($_SESSION)) {
            $adminController->displayAdmin();


/**---------------------------------------------------------------------------*
*------------------------------administration---------------------------------*
*-----------------------------------------------------------------------------*/

// formulaire pour créer un billet
        } elseif ($getClean['action'] === 'create') {
            if (isset($_SESSION)) {
                $postController->create();
            } else {
                throw new Exception('Administrateur non identifié');
            }
// ajouter un billet
        } elseif ($getClean['action'] === 'newPost') {
            if (!empty($postClean['title']) && !empty($postClean['extract']) && !empty($postClean['content'])) {
                $postController->newPost($postClean['title'], $postClean['extract'], $postClean['content']);
            } else {
                throw new Exception('Contenu vide !');
            }
// formulaire pour modifier un billet
        } elseif ($getClean['action'] === 'displayUpdate') {
            if (isset($getClean['id']) && $getClean['id'] > 0) {
                if ('1' == isset($_SESSION)) {
                    $postController->displayUpdate();
                }
            } else {
                throw new Exception('Administrateur non identifié');
            }
// modifier un billet
        } elseif ($getClean['action'] === 'submitUpdate') {
            $postController->submitUpdate($postClean['title'], $postClean['extract'], $postClean['content'], $getClean['id']);
// supprimer un billet
        } elseif ($_GET['action'] === 'removePost') {
            $postController->removePost($getClean['id']);
// afficher la liste des commentaires signalés
        } elseif ($getClean['action'] === 'displayReportsComments') {
            $commentController->displayReportsComments($getClean['comment_id'], $getClean['author'], $getClean['id'], $getClean['comment']);
// afficher la page de modération des commentaires
        } elseif ($getClean['action'] === 'displayRemoveComment') {
            $commentController->displayRemoveComment();
// supprimer un commentaire
        } elseif ($getClean['action'] === 'removeComment') {
            $commentController->removeComment($getClean['comment_id']);
// supprimer un commentaire signalé
        } elseif ($getClean['action'] === 'removeCommentReport') {
            $commentController->removeCommentReport($getClean['comment_id'], $getClean['author']);
        }
    } else {
        $frontend->listPosts();
    }
} catch(Exception $e) {
    $frontend->erreur404($e);
}