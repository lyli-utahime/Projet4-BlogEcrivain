<?php

namespace Model;

require_once("Manager.php");

class ReportManager extends Manager{

    // ajout de l'id du commentaire signalé dans la base de donnée "reports"
    public function postReports($commentId) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare("UPDATE comments SET report = '1' WHERE id =?");

        return $req->execute(array($commentId));
    }

    // faire une jointure des tables pour pouvoir afficher les informations dans l'administration
    public function insertReports() {
        $bdd = $this->dbConnect();
        $req = $bdd->query("SELECT posts.title, comments.id, comments.author, comments.comment FROM comments
        INNER JOIN posts ON comments.post_id = posts.id
        WHERE comments.report = '1'
        ORDER BY id DESC");
        $req->execute(array());
        
        return $req->fetchAll();
    }
}
