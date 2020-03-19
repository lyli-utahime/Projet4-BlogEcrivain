<?php

namespace Model;

require_once("Manager.php");

class Pagination extends Manager
{ 
    public function getPostsPagination() {
        $bdd = $this->dbConnect();
        $nbPosts = $bdd->query('SELECT COUNT(id) AS nbPosts FROM posts');
   
        return $nbPosts->fetch()['nbPosts'];
    }

    public function getPostsPages($nbPosts, $postsPerPage) {
        $nbPage = ceil($nbPosts/$postsPerPage);

        return $nbPage;
    }
}