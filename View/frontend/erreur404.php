<?php

$title = "Billet simple pour l'Alaska";

ob_start(); ?>

<title>Erreur</title>

<!-- start section erreur404 -->
<section id="paddsection">
    <div class="container text-center">
        <div class="section-title text-center">
            <div class="row">
                <div class="offset-md-2 col-md-8">
                    <div class="notfound">
                        <div class="notfound-404">
                            <h1>4<span>0</span>4</h1>
                        </div>
                        <h2>Cette page n'éxiste pas</h2>
                        <p class="returnLink"><a href="index.php?listPosts">Retour sur le blog</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end section erreur404 -->

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>