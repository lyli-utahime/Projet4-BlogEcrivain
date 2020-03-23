<?php

namespace Model;

require_once("Manager.php");

class ReportManager extends Manager{

    public function getIdReports() {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT comment_id FROM reports');
        $req->execute(array());
        $reports = $req->fetchAll(\PDO::FETCH_ASSOC);
       	$idComment = array();
       	foreach ($reports as $value) {
       		$idComment[] = $value['comment_id'];
       	}

        return $idComment;
    }

    public function postReports($commentId) {
    	$bdd = $this->dbConnect();
    	$req = $bdd->prepare('INSERT INTO reports(comment_id, report_date) VALUES(?, NOW())');
    	$reported = $req->execute(array($commentId));

    	return $reported;
    }

    public function getReports() {
      $bdd = $this->dbConnect();
      $reports = $bdd->query('SELECT COUNT(*) AS nb_reports, comment_id, author, comment, DATE_FORMAT(comment_date, "%d/%m/%Y %H:%i:%s") AS date_c FROM reports INNER JOIN comments ON reports.comment_id = comments.id GROUP BY comment_id HAVING nb_reports >= 2 ORDER BY nb_reports DESC');

      return $reports;
    }

}
