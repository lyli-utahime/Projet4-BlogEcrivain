<?php

$title = "Billet simple pour l'Alaska";

ob_start(); ?>

<title>404 HTML Template by Colorlib</title>

<!-- start section erreur404 -->
<section id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>4<span>0</span>4</h1>
        </div>
        <h2>Cette page n'éxiste pas</h2>
        <p class="returnLink"><a href="index.php?listPosts">Retour sur le blog</a></p>
    </div>
</section>
<!-- end section erreur404 -->

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>