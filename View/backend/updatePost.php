<?php $title = "Modifier un article"; ?>

<?php ob_start(); ?>

<section id="createPost">
    <h1>Modifier un article</h1>
    <div id="managerBlock">
    <?php
    if (isset($_GET['updatePost']) && $_GET['updatePost'] == 'success') {
        echo '<p id="success">L\'article a bien été modifié !</p>';
    }

    ?>
        <p class="returnLink"><a href="index.php?action=admin">Retour au panneau d'administration</a></p>
        <div id="col-lg-6">
            <form action="action="index.php?action=submitUpdate&amp;id=<?= $post['id'] ?>" method="post" class="contactForm">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="form-group contact-block1">
                        <input type="text" name="title" class="form-control" id="title" placeholder="Votre titre" size="80" /><br/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group contact-block1">
                        <textarea name="extract" class="form-control" id="extract" placeholder="Extrait de l'article"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group contact-block1">
                        <textarea name="content" class="form-control" id="content" placeholder="Votre article"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <input type="submit" class="btn" value="Poster" />
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</section>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>