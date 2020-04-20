<?php $title = "Modifier un article"; ?>

<?php ob_start(); ?>

<section id="createPost" class="main-content paddsection">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <h1>Modifier un article</h1>
            <div id="managerBlock">
                <p class="returnLink"><a href="index.php?action=displayAdmin">Retour au panneau d'administration</a></p>
                <div id="col-lg-6">
                    <form action="index.php?action=submitUpdate&amp;id=<?= $post['id'] ?>" method="post" class="contactForm">
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="form-group contact-block1">
                                <input type="text" name="title" class="form-control" id="title" required value="<?= $post['title'];?>" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group contact-block1">
                                <textarea name="extract" class="form-control" id="extract" style="height: 100px;" required><?= $post['extract'];?></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group contact-block1">
                                <textarea name="content" class="form-control" id="post" style="height: 200px;"><?= $post['content'];?></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <input type="submit" name="submit" class="btn" value="Modifier l'article" style="width: 100%;" />
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require(__DIR__ . '/../frontend/template.php'); ?>
