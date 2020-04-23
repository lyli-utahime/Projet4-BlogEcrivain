<?php 

$title = "Panneau d'administration"; ?>

<?php ob_start(); ?>

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
        </ul>

      </div>
    </div>
</nav>
<!-- End section navbar -->

<section id="paddsection">
    <div class="container">
        <div class="section-title text-center">
            <h1>Panneau d'administration</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-offset-1 col-md-9 col-sm-12">
            <div id=adminFrame>

                <!-- bouton pour ajouter un billet -->
                <div class="createPost">
                    <h2>Ajouter un article</h2>
                    <a class="btn" href="index.php?action=create">Ecrire un article</a>
                </div>

                <!-- gestion des billets -->
                <div id="postManage">
                    <h2>Gestion des Articles</h2></br>

                    <?php
                    if (isset($_GET['removeComment']) && $_GET['removeComment'] == 'success') {
                        echo '<p style="color: red">Le commentaire a bien été supprimé.</p>';
                    }

                    if (isset($_GET['newPost']) && $_GET['newPost'] == 'success') {
                        echo '<p style="color: red">L\'article a bien été posté.</p>';
                    }

                    if (isset($_GET['submitUpdate']) && $_GET['submitUpdate'] == 'success') {
                        echo '<p style="color: red">L\'article a bien été modifé.</p>';
                    }
                    
                    if (isset($_GET['removePost']) && $_GET['removePost'] == 'success') {
                        echo '<p style="color: red">L\'article a bien été supprimé.</p>';
                    }
                    
                    foreach($posts as $post) {
                    ?>

                    <div class="block-main mb-30">
                        <div class="postTitle">
                            <h3 style="color:#000;"><?= $post['title']; ?></h3>
                        </div>
                        <div class="contentPost">
                            <em style="color:#000000;">le <?= $post['creation_date_fr'] ?></em>
                            <p><?= nl2br(htmlspecialchars($post['extract'])) ?></p>
                        </div>
                            <a class="btn" href="index.php?action=displayUpdate&amp;id=<?= $post['id']; ?>">Modifier l'article</a>
                            <a class="btn" href="index.php?action=removePost&amp;id=<?= $post['id']; ?>" onclick="return confirm('Etes vous sûr de vouloir supprimer cet article ?');">Supprimer l'article</a>
                            <a class="btn" href="index.php?action=displayRemoveComment&amp;id=<?= $post['id']; ?>">Modération des commentaires</a>
                    </div>

                    <?php
                    }

                    if ($nbPage >= 2) {
                    ?>

                    <div class="dialing">
                    <?php
                        for ($i = 1; $i <= $nbPage; $i++) {
                            if ((!isset($_GET['page']) && $i == 1) || (isset($_GET['page']) && $_GET['page'] == $i)) {
                                echo "<a class='cPage'>$i</a>";
                            } else {
                                echo "<a href=\"index.php?action=displayAdmin&amp;page=$i\">$i</a>";
                            }
                        }
                    ?>
                    </div>

                    <?php
                    }
                    ?>
                </div>

                <!-- gestion des commentaires -->
                <div id="removeComment">
                    <h3>Gestion des commentaires signalés</h3></br>
                    
                    <?php
                    if (isset($_GET['removeCommentReport']) && $_GET['removeCommentReport'] == 'success') {
                        echo '<p style="color: red">Le commentaire a bien été supprimé.</p>';
                    }
                        
                    if (isset($_GET['ignoreCommentReport']) && $_GET['ignoreCommentReport'] == 'success') {
                        echo '<p style="color: red">Le commentaire n\'est plus signalé.</p>';
                    }
                    
                    if (isset($_GET['displayReportsComments']) && $_GET['displayReportsComments'] == 'success') {
                        echo '<p style="color: red">Aucun commentaire signalé.</p>';
                    }
                    
                    foreach ($reports as $report) {
                    
                    ?>

                    <div class="block-main mb-30">
                        <div class="contentPost">
                            <span style="color: #000; font-weight: 600;">Auteur du commentaire :</span> <span style="color: #b8a07c;"><?= $report['author']; ?></span><br />
                            <span style="color: #000; font-weight: 600;">Sous le billet :</span> <?= $report['title']; ?>
                            <p style="color: #000;"><?= $report['comment']; ?></p>
                        </div>
                        <a class="btn" href="index.php?action=removeCommentReport&amp;id=<?= $report['id']; ?>" onclick="return confirm('Etes vous sûr de vouloir supprimer ce commentaire ?');">Supprimer le commentaire</a>
                        <a class="btn" href="index.php?action=ignoreCommentReport&id=<?= $report['id'] ?>" onclick="return confirm('Etes vous sûr de vouloir ignorer ce commentaire ?');">Retirer de la liste</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require(__DIR__ . '/../frontend/template.php'); ?>