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

<!-- start section journal -->
<div id="posts">
  <div class="container">
    <!-- Liste des derniers posts -->
    <div class="col-12">
      <div class="journal-txt">
        <?php
        while ($data = $posts->fetch())
        {
        ?>
        <h4><a href="index.php?action=post&amp;id=<?= $data['id'] ?>"><?= htmlspecialchars($data['title']) ?></a></h4>
        <p class="contentPost">
            <em>le <?= $data['creation_date_fr'] ?></em><br>
            <?= nl2br(htmlspecialchars($data['content'])) ?><br />
        </p>
        <?php
        }
        $posts->closeCursor();
        ?>
      </div>
    </div>
  </div>
</div>
<!-- End section journal -->

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>