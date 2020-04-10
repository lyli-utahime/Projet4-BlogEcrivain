<?php

namespace Model;

require_once("Manager.php");

class ReportManager extends Manager{

    // ajout de l'id du commentaire signalé dans la base de donnée "reports"
    public function postReports($commentId) {
        $bdd = $this->dbConnect();
<<<<<<< HEAD
        $req = $bdd->prepare("UPDATE comments SET report = '1' WHERE id =?");
=======
        $req = $bdd->prepare('INSERT INTO reports(comment_id) VALUES(?)');
>>>>>>> 594511e6976b935722a049fa75c355eff89c43cd

        return $req->execute(array($commentId));
    }

<<<<<<< HEAD
    // faire une jointure des tables pour pouvoir afficher les informations dans l'administration
    public function insertReports() {
        $bdd = $this->dbConnect();
        $req = $bdd->query("SELECT posts.title, comments.id, comments.author, comments.comment FROM comments
        INNER JOIN posts ON comments.post_id = posts.id
        WHERE comments.report = '1'
        ORDER BY id DESC");
        $req->execute(array());
        
=======
    // faire une jointure des tables comments et reports pour pouvoir afficher les informations dans la rubrique administration
    public function insertReports() {
        $bdd = $this->dbConnect();
        $req = $bdd->query('SELECT posts.id, posts.title, comments.id, comments.author, comments.comment, reports.comment_id FROM reports
        INNER JOIN comments ON reports.comment_id = comments.id
        INNER JOIN posts ON comments.post_id = posts.id');

>>>>>>> 594511e6976b935722a049fa75c355eff89c43cd
        return $req->fetchAll();
    }
}
