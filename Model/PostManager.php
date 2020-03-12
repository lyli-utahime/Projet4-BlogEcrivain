<?php

namespace Model;

use Model\Manager;

require_once("Manager.php");

class PostManager extends Manager
{
    // page index : les  3 derniers billets
    function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 3');

        return $req;
    }

    // page post : afficher un seul billet
    function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    // page liste des billets
    function allPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM posts');

        return $req;
    }
}