
<?php

$title = "Billet simple pour l'Alaska";

ob_start(); ?>

<?php
if (isset($_GET['account-status']) && $_GET['account-status'] == 'account-successfully-created') {
    echo '<p id="success">Votre compte a bien été créé. <a href="index.php?action=login">Se connecter</a></p>';
}

if (isset($_GET['logout']) && $_GET['logout'] == 'success') {
    echo '<p id="success">Vous êtes bien deconnecté.</p>';
}
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
                <li><a href="#header" class="smoothScroll">Accueil</a></li>
                <li><a href="#about" class="smoothScroll">A propos</a></li>
                <li><a href="#journal" class="smoothScroll">Journal</a></li>
                <li><a href="#contact" class="smoothScroll">Contact</a></li>
                <li><a href="index.php?action=displayLoginAdmin" class="smoothScroll">Administration</a></li>
            </ul>

        </div>
    </div>
</nav>
<!-- End section navbar -->


<!-- start section header -->
<header id="header" class="home">
    <div class="container">
        <div class="header-content">
            <h1>Billet simple pour l'Alaska</h1>
            <h2 class="title">Je suis <span class="typed"></span></h2>
            <p>Acteur, Ecrivain</p>
        </div>
    </div>
</header>
<!-- End section header -->


<!-- start section about us -->
<section id="about" class="paddsection">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-4 ">
                <div class="div-img-bg">
                    <div class="about-img">
                        <img src="../public/images/me.jpg" class="img-responsive" alt="me">
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="about-descr">
                    <p class="p-heading">Vivre et travailler en Alberta et en Colombie-Britannique pendant plus de deux décennies, avec les montagnes et la mer à proximité, m’a presqu’enlevé toute envie de faire une croisière en Alaska. Je ne pouvais juste pas imaginer que ce serait très différent de ce que je voyais tous les jours. </p>
                    <p class="separator">Mais ma perspective a totalement changé lorsque j’ai dû aller en croisière en Alaska pour mon nouveau roman… J’étais complètement émerveillé par les voies navigables parfaites, l’abondante faune et les magnifiques teintes de bleu des géants glaciers. À date, l’Alaska reste l’une de mes destinations de croisière préférées.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end section about us -->

<!-- start section journal -->
<section id="journal" class="text-left paddsection">
    <div class="container">
        <div class="section-title text-center">
            <h2>journal</h2>
        </div>
        <div class="container">
            <div class="journal-block">
                <div class="row">
                    <!-- Images avant liste des derniers posts -->
                    <div class="col-lg-4 col-md-6">
                        <div class="journal-info">
                        <a href="blog-single.html"><img src="../public/images/blog-post-1.jpg" class="img-responsive" alt="img"></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="journal-info">
                        <a href="blog-single.html"><img src="../public/images/blog-post-2.jpg" class="img-responsive" alt="img"></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="journal-info">
                        <a href="blog-single.html"><img src="../public/images/blog-post-3.jpg" class="img-responsive" alt="img"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="posts">
    <div class="container">
        <!-- Liste des derniers posts -->
        <div class="col-12">
            <div class="journal-txt">
                <?php foreach($posts as $post) { ?>
                <h3><a href="index.php?action=post&amp;id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h3>
                <em style="color:#000000;">le <?= $post['creation_date_fr'] ?></em></br>
                <p class="contentPost">
                    <?= nl2br(htmlspecialchars($post['extract'])) ?><br />
                </p>
                <?php } 
                if ($nbPage >= 2) {
                    ?>
                <div class="dialing">
                    <?php
                        for ($i = 1; $i <= $nbPage; $i++) {
                            if ((!isset($_GET['page']) && $i == 1) || (isset($_GET['page']) && $_GET['page'] == $i)) {
                                echo "<a class='cPage'>$i</a>";
                            } else {
                                echo "<a href='index.php?page=$i'>$i</a>";
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End section journal -->

<?php require_once('contact.php'); ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>