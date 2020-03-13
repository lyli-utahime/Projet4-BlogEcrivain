<!-- start section navbar -->
<nav id="main-nav">
    <div class="row">
      <div class="container">

        <div class="logo">
            <a href="/BlogEcrivain - Copie/index.php">Billet simple pour l'alaska</a>
        </div>

        <div class="responsive"><i data-icon="m" class="ion-navicon-round"></i></div>

        <ul class="nav-menu list-unstyled">
            <li><a href="/BlogEcrivain - Copie/index.php" class="smoothScroll">Accueil</a></li>
            <li><a href="/BlogEcrivain - Copie/View/frontend/listPostView.php" class="smoothScroll">Billets</a></li>
            <li><a href="contact.php" class="smoothScroll">Contact</a></li>
        </ul>

      </div>
    </div>
</nav>
<!-- End section navbar -->

<?php $title = "Nouvel article"; ?>

<?php ob_start(); ?>

<section id="createPost">
    <h1>Panneau d'administration</h1>
    <div id="managerBlock">
        <p class="returnLink"><a href="index.php?action=admin">Retour au menu</a></p>
        <div id="col-lg-6">
            <form action="index.php?action=newPost" method="post" class="contactForm">
                <div class="row">

                    <div id="sendmessage">Billet envoyé ! !</div>
                    <div id="errormessage"></div>

                    <div class="col-lg-12">
                        <div class="form-group contact-block1">
                        <label for="title">Titre : </label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Votre titre" size="80" /><br/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group contact-block1">
                        <textarea name="content" rows="40" cols="160" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-defeault btn-send" value="Poster" />
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</section>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>