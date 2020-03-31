<?php

namespace Controller;

// chargement des classes
use Model\PostManager;
use Model\CommentManager;
use Model\Pagination;
use Model\ReportManager;

class contactController {
// envoie du formulaire de contact
    public function sendContactForm() {
        ini_set("SMTP","smtp.gmail.com");
        ini_set("smpt_port", 587);

        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $message = addslashes($message);
        $message = str_replace("\'","'",$message);

        $to = "lili.utahime@gmail.com";
        $subject = "Formulaire de contact";
        $msg = "Vous avez un nouveau message\n
        Nom: $name\n
        Email: $email\n
        Message: $message";
        $head = "From: $name \n 
        Reply-To: $email";

        mail($to, $subject, $msg, $head);

        require(__DIR__ . '/../View/frontend/contact.php');
    }
}