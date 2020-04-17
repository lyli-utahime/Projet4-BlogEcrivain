<?php

ob_start();

$title = "Billet simple pour l'Alaska";

?>

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

<!-- start section main content -->
<section class="main-content paddsection">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="container-main single-main">
                        <div class="col-md-12">
                            <div class="block-main mb-30">
                                <img src="../public/images/blog-post-big.jpg" class="img-responsive" alt="reviews2">

                                <!-- Affichage du Billet -->
                                <div class="content-main single-post padDiv">
                                    <div class="post-meta">
                                        <h2><?= ($post['title']) ?></h2>
                                        <ul class="list-unstyled mb-0">

                                        <li class="date">date : le <?= $post['creation_date_fr'] ?></li>
                                        </ul>
                                    </div>
                                    <p class="mb-30"><?= strip_tags($post['content']) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="comments text-left padDiv mb-30">

                                <!-- Affichage des commentaires -->
                                <div class="entry-comments" id="comments">
                                    <h3 class="mb-30">Commentaires</h6>
                                    <div class="entry-comments-list list-unstyled">

                                        <!-- Meesages d'erreurs -->
                                        <?php
                                        if (isset($_GET['report']) && $_GET['report'] == 'success') {
                                            echo '<p>Le commentaire a bien été signalé.</p>';
                                        }

                                        if (isset($_GET['addComment']) && $_GET['addComment'] == 'success') {
                                            echo '<p>Le commentaire a bien été ajouté.</p>';
                                        }

                                        while ($comment = $comments->fetch())
                                        { ?>

                                            <div class="entry-comments-item">
                                                <div class="entry-comments-body">
                                                    <h4 class="entry-comments-author"><?= ($comment['author']) ?></h4>
                                                    <span><a href="#"><?= $comment['comment_date_fr'] ?></a></span>
                                                    <p class="contentPost"><?= ($comment['comment']) ?></p>
                                                </div>
                                                <a href="index.php?action=postReport&amp;id=<?= $post['id'] ?>&amp;comment_id=<?= $comment['id'] ?>" onclick="return(confirm('Etes-vous sûr de vouloir signaler ce commentaire ?'));"><i class="fas fa-exclamation-triangle"></i> Signaler</a></p>
                                            </div>

                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="cmt padDiv">

                                <!-- formulaire pour ajouter un commentaire -->
                                <h6>Ajouter un commentaire</h6></br>
                                <form id="comment-form" method="post" action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" role="form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input id="author" type="text" name="author" class="form-control" placeholder="PSEUDO" required="required">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <textarea id="comment" name="comment" class="form-control" placeholder="COMMENTAIRE" style="height: 200px;" required="required"></textarea>
                                        </div>
                                    </div>
                                        <div class="col-lg-12">
                                            <input type="submit" class="btn" value="ENVOYER LE COMMENTAIRE">
                                        </div>
                                    </div>
                                </form>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- start section main content -->

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>