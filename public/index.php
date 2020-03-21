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
        } elseif ($_GET['action'] == 'subscribe') {
            $frontend->displaySubscribe();
        }
        elseif ($_GET['action'] == 'addMember') {
            if (!empty($_POST['pseudo']) && !empty($_POST['pass']) && !empty($_POST['pass_confirm']) && !empty($_POST['mail'])) {
                if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                    if ($_POST['pass'] == $_POST['pass_confirm']) {
                        $frontend->addMember(strip_tags($_POST['pseudo']), strip_tags($_POST['pass']), strip_tags($_POST['mail']));
                    } else {
                        throw new Exception('Les deux mots de passe ne sont pas identique.');
                    }
                } else {
                    throw new Exception('Adresse mail non valide.');
                }
            } else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        } elseif ($_GET['action'] == 'login') {
            $frontend->displayLogin();
        } elseif ($_GET['action'] == 'loginSubmit') {
            $frontend->loginSubmit(strip_tags($_POST['pseudo']), strip_tags($_POST['pass']));
        } elseif ($_GET['action'] == 'logout') {
            $frontend->logout();
        } elseif ($_GET['action'] == 'report') {
            $frontend->postReport($_GET['id'], $_GET['comment-id'], $_SESSION['id']);
        } elseif ($_GET['action'] == 'adminLogin') {
            if (isset($_SESSION)) {
                $postController->loginAdmin();
            }
        } elseif ($_GET['action'] === 'admin-login-view') {
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
        } elseif ($_GET['action'] == 'updatePost') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (isset($_SESSION) && $_SESSION['groups_id'] == '1') {
                    $postController->displayUpdate();
                }  
            } else {
                throw new Exception('Administrateur non identifié');
            }
        } elseif ($_GET['action'] == 'submitUpdate') {
            $postController->submitUpdate($_POST['title'], $_POST['content'], $_GET['id']);
        } elseif ($_GET['action'] == 'deletePost') {
            $postController->removePost($_GET['id']);
        } elseif ($_GET['action'] == 'deleteComment') {
            $postController->removeComment($_GET['id']);
        } elseif ($_GET['action'] == 'deleteMember') {
            $postController->removeMember($_GET['id']);
        }
    } else {
        $frontend->listPosts();
    }
} catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}