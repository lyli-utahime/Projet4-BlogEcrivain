<?php $title = "Inscription"; ?>
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
            <li><a href="index.php?action=displayLogin" class="smoothScroll">Se connecter</a></li>
        </ul>

      </div>
    </div>
</nav>
<!-- End section navbar -->

<?php ob_start(); ?>


<section class="paddsection">
    <div class="container">
        <div class="section-title text-center">
        <?php 
        if (isset($_GET['error']) && $_GET['error'] == 'invalidUsername') {
            echo '<p id="error">Pseudo déjà utilisé</p>';
        }

        if (isset($_GET['error']) && $_GET['error'] == 'invalidMail') {
            echo '<P id="error">Adresse email déjà utilisée</p>';
        }

        if (isset($_GET['error']) && $_GET['error'] == 'google-recaptcha') {
            echo '<P id="error">Vous devez cocher la case de vérification.</p>';
        }

        ?>
            <h1>Inscription</h1>
        </div>
    </div>
    <div class="container">
        <div class="contact-block1">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form">
                        <form action="index.php?action=addMember" method="post">
                        <div class="col-lg-6">
                            <div class="form-group contact-block1">
                                <label for="pseudo">PSEUDO</label><br/>
                                <input type="text" name="pseudo" id="pseudo" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="pass">MOT DE PASSE</label><br />
                                <input type="password" name="pass" id="pass" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="pass">CONFIRMER VOTRE MOT DE PASSE</label><br />
                                <input type="password" name="ass_confirm" id="ass_confirm" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">VOTRE EMAIL</label><br />
                                <input type="email" name="email" id="email" required />
                            </div>
                        </div>
                        <div class="col-lg-12">
                                    <input type="submit" value="INSCRIPTION" />
                        </div>
                        </form>
                        <h6>déjà inscrit ? <a href="index.php?action=displayLogin">Se connecter ici.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>