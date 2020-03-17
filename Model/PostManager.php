<?php

namespace Model;

use Model\Manager;

require_once("Manager.php");

class PostManager extends Manager
{
    // page index
    function getPosts($cPage, $postsPerPage) {
        $cPage = 1;

        $bdd = $this->dbConnect();
        $req = $bdd->prepare("SELECT id, title, extract, DATE_FORMAT(creation_date, '%d/%m/%Y %H:%i:%s') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT $cPage, $postsPerPage");
        $req->execute(array());
        $allPosts = $req->fetchAll();

        return $allPosts;
    }

    // page post : afficher un seul billet
    function getPost($postId) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    // modifier un billet
    public function updatePost($title, $extract, $content, $postId) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('UPDATE posts SET title = ?, extract = ?, content = ?, update_date = NOW() WHERE id = ?');
        $updated = $req->execute(array($title, $extract, $content, $postId));

        return $updated;
    }

    // créer un billet
    public function createPost($title, $extract, $content) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('INSERT INTO posts(title, extract, content, creation_date, update_date) VALUES (?, ?, ?, NOW(), NOW())');
        $newPost = $req->execute(array($title, $extract, $content));

        return $newPost;
    }
}