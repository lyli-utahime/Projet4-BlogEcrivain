<?php

namespace Model;

use Model\Manager;

require_once("Manager.php");

class PostManager extends Manager
{
    // page index : les  3 derniers billets
    function getPosts() {
        $bdd = $this->dbConnect($cPage, $postsPerPage);
        $req = $bdd->query('SELECT id, title, extract, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT $cPage, $postsPerPage');

        return $req;
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

    // page liste des billets
//    function allPosts($cPage, $postsPerPage)
//    {
 //       $db = $this->dbConnect($cPage, $postsPerPage);
//        $req = $db->query('SELECT id, title, extract, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT $cPage, $postsPerPage');

//        return $req;
//    }
}