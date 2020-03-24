<?php $title = "Nouvel article"; ?>

<?php ob_start(); ?>

<section id="createPost" class="main-content paddsection">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-md-offset-2">
                <h1>Nouvel article</h1>
                <div id="container-main single-main">
                    <p class="returnLink"><a href="index.php?action=displayAdmin">Retour au panneau d'administration</a></p>
                    <div id="col-lg-6">
                        <form id="post-form" action="index.php?action=newPost" method="post">
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="form-group contact-block1">
                                    <input type="text" name="title" class="form-control" id="title" placeholder="VOTRE TITRE" size="80" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group contact-block1">
                                    <input type="date" name="creation_date" class="form-control" id="creation_date">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group contact-block1">
                                    <textarea name="extract" class="form-control" id="extract" placeholder="EXTRAIT DE L'ARTICLE" style="height: 100px;"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group contact-block1">
                                    <textarea name="content" class="form-control" id="content" placeholder="VOTRE ARTICLE" style="height: 200px;"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <input type="submit" class="btn" value="Poster l'article" style="width: 100%;" />
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $content = ob_get_clean(); ?>

<?php require(__DIR__ . '/../frontend/template.php'); ?>