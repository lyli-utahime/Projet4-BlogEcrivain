<?php

namespace Controller;

// chargement des classes
use Model\PostManager;
use Model\CommentManager;
use Model\Pagination;
use Model\ReportManager;

class adminController {
// pour s'enregistrer
    public function displayLoginAdmin() {
        require(__DIR__ . '/../View/frontend/loginAdmin.php');
    }

    public function loginAdmin() {
        $pass = '$2y$12$0MzIRzJG56zpUm89GKlPcOhCcDMI5CV46bcrJazU4N4PVSgeQaIQq';
        if (isset($_POST['login']) && isset($_POST['pass']) && $_POST['login'] === "admin" && password_verify($_POST['pass'], $pass)) {
            header('Location: index.php?action=displayAdmin');

        }  else {
            header('Location: index.php?action=displayLoginAdmin&account-status=unsuccess-login');
        }
    }


// affichage du panneau d'administration
    public function displayAdmin() {
        $postManager = new PostManager(); 
        $pagination = new Pagination();
        $reportManager = new ReportManager();
        $commentManager = new CommentManager();

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

        $reports = $reportManager->insertReports();

        require(__DIR__ . '/../View/backend/adminView.php');
    }
}