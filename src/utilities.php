<?php
// Inclure l'autoloader de Composer
require 'vendor/autoload.php';

// Importation de PHP MAILER
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function redirect($url): void {
    header("Location: $url");
    exit();
}

function sendEmail($to, $subject, $body) {
    // Création de l'instance de PHP MAILER
    $mail = new PHPMailer(true);

    try {
        // Paramétrage du serveur
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com'; // Spécifiez le serveur SMTP
        $mail->SMTPAuth = true;
        $mail->Username = ''; // SMTP username
        $mail->Password = ''; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Activer le chiffrement TLS
        $mail->Port       = 587; // Port TCP pour ce connecter

        // Destinataires
        $mail->setFrom($to, 'Expéditeur');


        // Contenu
        $mail->isHTML(true); // Défini le format de l'email en HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $body;

        $mail->send();
        echo "Le message a été envoyé";
    }
    catch (Exception $e) {
        echo "Le message na pas pu etre envoyé. Erreur : {$mail->ErrorInfo}";
    }
}