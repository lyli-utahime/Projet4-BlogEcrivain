<!-- start section navbar -->
<nav id="main-nav">
    <div class="row">
      <div class="container">

        <div class="logo">
            <a href="index.php?action=listPosts">Billet simple pour l'alaska</a>
        </div>

        <div class="responsive"><i data-icon="m" class="ion-navicon-round"></i></div>

        <ul class="nav-menu list-unstyled">
            <li><a href="index.php?action=listPosts" class="smoothScroll">Accueil</a></li>
            <li><a href="index.php?action=displayLoginAdmin" class="smoothScroll">Administration</a></li>
            <li><a href="index.php?action=displayLogin" class="smoothScroll">Se connecter</a></li>
        </ul>

      </div>
    </div>
</nav>
<!-- End section navbar -->

<?php 

$title = "Panneau d'administration"; ?>

<?php ob_start(); ?>

<section id="paddsection">
    <div class="container">
        <div class="section-title text-center">
            <h1>Panneau d'administration</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div id=adminFrame>

                <!-- bouton pour ajouter un billet -->
                <button class="btn"><a href="index.php?action=create">Ecrire un article</a></button>

                <!-- gestion des billets -->
                <div id="postManage">
                    <h2>Gestion des Articles</h2>

                    <?php
                    if (isset($_GET['update-status']) &&  $_GET['update-status'] == 'success') {
                        echo '<p id="success">L\'article a bient été modifié !<p>';
                    }
                    elseif (isset($_GET['new-post']) &&  $_GET['new-post'] == 'success') {
                        echo '<p id="success">L\'article a bient été posté !<p>';
                    }
                    elseif (isset($_GET['remove-post']) &&  $_GET['remove-post'] == 'success') {
                        echo '<p id="success">L\'article a bien été supprimé !</p>';
                    }

                    $countPost = 0;
                    foreach($posts as $post) {
                    ?>

                    <div class="block-main mb-30">
                                <h3><?= $post['title']; ?></h3>
                                <p class="contentPost">
                                    <?= nl2br(htmlspecialchars($post['extract'])) ?><br />
                                </p>
                                <button class="btn"><a href="index.php?action=displayUpdate&amp;id=<?= $post['id']; ?>">Modifier l'article</a></button>
                                    <div id="postModal<?= $countPost ?>">
                                    <a href="index.php?action=removePost&amp;id=<?= $post['id']; ?>">Supprimer l'article</a> : <em><?= $post['title']; ?></em>
                                    </div>
                                <a href="index.php?action=updatePost&amp;id=<?= $post['id']; ?>"></a>
                                <em style="color:#000000;">le <?= $post['creation_date_fr'] ?></em>
                    </div>

                    <?php
                    }

                    if ($nbPage >= 2) {
                    ?>

                    <div class="pagination">
                    <?php
                        for ($i = 1; $i <= $nbPage; $i++) {
                            if ((!isset($_GET['page']) && $i == 1) || (isset($_GET['page']) && $_GET['page'] == $i)) {
                                echo "<span>$i</span>";
                            } else {
                                echo "<a href=\"index.php?action=admin&amp;page=$i\">$i</a>";
                            }
                        }
                    ?>
                    </div>

                    <?php
                    }
                    ?>
                </div>

                <!-- gestion des commentaires -->
                <div id="commentManage">
                    <h3>Gestion des commentaires signalés</h3>
                    <?php 
                    if (isset($_GET['remove-comment']) &&  $_GET['remove-comment'] == 'success') {
                        echo '<p id="success">Le commentaire a bien été supprimé !</p>';
                    }

                    $countReport = 0;
                    while ($report = $reports->fetch()) {
                    ?>
                    <div class="block-main mb-30">
                        <a href="#"><?= $report['author']; ?></a>
                        <em style="color:#000000;"><?= $report['date_c']; ?></em>
                        <button class="btn"></button>
                            <div id="reportModal<?= $countReport ?>" class="modal">
                                <div class="modalContent">
                                    <p>Voulez-vous vraiment supprimer le commentaire de <em><?= $report['author']; ?></em> ?</p>
                                    <a href="index.php?action=deleteComment&amp;id=<?= $report['comment_id']; ?>">Oui</a>
                                    <span id="closeCommentModal<?= $countReport++ ?>">Non</span>
                                </div>
                            </div>
                        <p class="nbReports"><?= $report['nb_reports']; ?> signalements</p>
                        <p><?= $report['comment']; ?></p>	
                    </div>
                    <?php
                    }
                    $reports->closeCursor();
                    ?>
                </div>


            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>