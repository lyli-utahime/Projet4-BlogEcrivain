<?php

namespace Model;

require_once("Manager.php");

class ReportManager extends Manager{

    // ajout de l'id du commentaire signalé dans la base de donnée "reports"
    public function postReports($commentId) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('INSERT INTO reports(comment_id) VALUES(?)');
        $reported = $req->execute(array($commentId));

        return $reported;
    }

    // faire une jointure des tables comments et reports pour pouvoir afficher les informations dans la rubrique administration
    public function insertReports($commendId, $author, $postId, $comment) {
      $bdd = $this->dbConnect();
      // select les colonnes author et comment
      // de la table comments
      // récupérer le contenu de la table comments à joindre dans la table reports
      // par la colonne commune id de comments et comment_id de reports
      $reportsJoin = $bdd->query('SELECT author, post_id, comment 
      FROM comments LEFT JOIN reports
      ON comments.id = reports.comment_id ORDER BY reports.id DESC');
      $reportsJoin = $req->execute(array($commendId, $author, $postId, $comment));

      return $reportsJoin;
    }

    public function getReports() {
      $bdd = $this->dbConnect();
      $reports = $bdd->query('SELECT * FROM reports ORDER BY reports.id DESC');

      return $reports;
    }
}
