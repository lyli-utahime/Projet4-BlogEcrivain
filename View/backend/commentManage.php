<?php $title = "Modérer les commentaires"; ?>

<?php ob_start(); ?>

<section id="createPost" class="main-content paddsection">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <h1>Modérer les commentaires</h1>
            <div id="managerBlock">
                <p class="returnLink"><a href="index.php?action=displayAdmin">Retour au panneau d'administration</a></p>

                <!-- afficahge de l'article correspondand -->
                <div id="col-lg-6">
                    <div class="content-main single-post padDiv">
                        <div class="post-meta">
                            <?php ob_start(); ?>
                            
                            <h2><?= htmlspecialchars($post['title']) ?></h2>
                            <ul class="list-unstyled mb-0">

                            <li class="date">date : le <?= $post['creation_date_fr'] ?></li>
                            </ul>
                        </div>
                        <p class="mb-30"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="comments text-left padDiv mb-30">

                        <!-- Affichage des commentaires -->
                        <div class="entry-comments" id="comments">
                            <h3 class="mb-30">Commentaires</h6>
                            <div class="entry-comments-list list-unstyled">

                                <!-- Messages d'erreurs -->
                                <?php
                                while ($comment = $comments->fetch())
                                { ?>
                                <div class="entry-comments-item">
                                    <div class="entry-comments-body">
                                        <h4 class="entry-comments-author"><?= htmlspecialchars($comment['author']) ?></h4>
                                        <span><a href="#"><?= $comment['comment_date_fr'] ?></a></span>
                                        <p class="contentPost"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                                    </div>

                                    <a class="btn" href="index.php?action=removeComment&amp;id=<?= $comment['id']; ?>" onclick="return confirm('Etes vous sûr de vouloir supprimer ce commentaire ?');"">Supprimer le commentaire</a>
                                </div>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require(__DIR__ . '/../frontend/template.php'); ?>