
<!-- start section contact -->
<section id="contact" class="paddsection">
    <div class="container">
        <div class="contact-block1">
            <div class="row">

                <div class="col-lg-6">
                    <div class="contact-contact">

                    <h2 class="mb-30">CONTACTEZ-MOI</h2>

                    <ul class="contact-details">
                        <li><span>23 Main, Street</span></li>
                        <li><span>New York, United States</span></li>
                        <li><span>+88 01912704287</span></li>
                        <li><span>example@example.com</span></li>
                    </ul>

                    </div>
                </div>

                <div class="col-lg-6">
                    <form action="index.php?action=sendContactForm" method="post" class="contactForm">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group contact-block1">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Votre nom" data-rule="minlen:4" data-msg="Veuillez entre au moins 4 caractères" />
                                <div class="validation"></div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Votre Email" data-rule="email" data-msg="Merci d'entrer un mail valide" />
                                <div class="validation"></div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Sujet" data-rule="minlen:4" data-msg="Veuillez entre au moins 8 caractères" />
                                <div class="validation"></div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="12" data-rule="required" data-msg="Ecrivez votre message" style="height: 200px;" placeholder="Message"></textarea>
                                <div class="validation"></div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <input type="submit" class="btn" value="Envoyer le message">
                        </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- start section contact -->


