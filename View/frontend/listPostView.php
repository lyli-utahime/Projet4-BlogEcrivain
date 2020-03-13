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
            <li><a href="listPostView.php" class="smoothScroll">Billets</a></li>
            <li><a href="contact.php" class="smoothScroll">Contact</a></li>
        </ul>

      </div>
    </div>
</nav>
<!-- End section navbar -->

<!-- start section journal -->
<section id="journal" class="text-left paddsection">

  <div class="container">
    <div class="section-title text-center">
      <h2>journal</h2>
    </div>
  </div>
  <div class="container">
    <div class="journal-block">
        <div class="row">
        <!-- Images avant liste des posts -->
        <div class="col-lg-4 col-md-6">
                <div class="journal-info">
                <a href="blog-single.html"><img src="/BlogEcrivain - Copie/public/images/blog-post-1.jpg" class="img-responsive" alt="img"></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="journal-info">
                <a href="blog-single.html"><img src="/BlogEcrivain - Copie/public/images/blog-post-2.jpg" class="img-responsive" alt="img"></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="journal-info">
                <a href="blog-single.html"><img src="/BlogEcrivain - Copie/public/images/blog-post-3.jpg" class="img-responsive" alt="img"></a>
                </div>
            </div>
        </div>
    </div>
  </div>
</section>
<section id="posts">
    <div class="container">
    <!-- Liste des posts -->
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

                if ($nbPage >= 2) {
                  ?>
                  <div id="pageFrame">
                  <?php
                      for ($i = 1; $i <= $nbPage; $i++) {
                      if ((!isset($_GET['page']) && $i == 1) || (isset($_GET['page']) && $_GET['page'] == $i)) {
                          echo $i;
                      } else {
                          echo "<a href=\"index.php?page=$i\">$i</a>";
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

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>