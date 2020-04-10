<?php

namespace Model;

require_once("Manager.php");

class PostManager extends Manager {
    // page index
    function getPosts($cPage, $postsPerPage) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare("SELECT id, title, extract, DATE_FORMAT(creation_date, '%d/%m/%Y %H:%i:%s') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT $cPage, $postsPerPage");
        $req->execute(array());

        return $req->fetchAll();
    }

    // page post : afficher un seul billet
    function getPost($postId) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));

        return $req->fetch();
    }

    // créer un billet
        public function createPost($title, $extract, $content) {
            $bdd = $this->dbConnect();
            $req = $bdd->prepare('INSERT INTO posts(title, extract, content, creation_date) VALUES (?, ?, ?, NOW())');

            return $req->execute(array($title, $extract, $content));
        }

    // page : modifier un billet, afficher le billet
    function getPostUpdate($postId) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT id, title, extract, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));

        return $req->fetch();
    }

    // modifier un billet
    public function updatePost($title, $extract, $content, $postId) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE posts SET title = ?, extract = ?, content = ?, creation_date = NOW() WHERE id = ?');

        return $req->execute(array($title, $extract, $content, $postId));
    }

    // supprimer un billet
    public function deletePost($postId) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM posts WHERE id = ?');

        return $req->execute(array($postId));
    }
}