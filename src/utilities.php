<?php
// Inclure l'autoloader de Composer
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Importation de PHP MAILER
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function redirect($url): void {
    header("Location: $url");
    exit();
}

function sendEmail($to, $subject, $body, $resetLink) {
    // Création de l'instance de PHP MAILER
    $mail = new PHPMailer(true);
    $host = $_ENV['SMTP_HOST'];
    $username = $_ENV['SMTP_USERNAME'];
    $password = $_ENV['SMTP_PASSWORD'];
    $port = $_ENV['SMTP_PORT'];
    $from = $_ENV['SMTP_FROM']; // Ajoutez cette ligne dans votre fichier .env

    try {
        // Paramétrage du serveur
        $mail->isSMTP();
        $mail->Host     = $host;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port     = $port;

        // Expéditeur et destinataires
        $mail->setFrom($from); // Utilisez l'adresse de l'expéditeur définie dans .env
        $mail->addAddress($to); // Ajoutez le destinataire

        // Contenu
        $mail->isHTML(true);
        $mail->Subject = $subject;

        // Charger le template HTML
        $body = file_get_contents(BASE_PATH . '\src\mail_template\reset_password_email.html');

        // Remplacer les variables dans le template
        $body = str_replace('{{RESET_LINK}}', $resetLink, $body);

        $mail->Body = $body;
        $mail->send();
        return true;
    }
    catch (Exception $e) {
        error_log("Erreur d'envoi d'email : " . $mail->ErrorInfo);
        error_log("Destinataire : " . $to);
        error_log("Sujet : " . $subject);
        error_log("Exception complète : " . $e->getMessage());
        return false;
    }
}

function truncateContent($content, $max_length = 150, $ending = '...') {
    if (is_array($content)) {
        // Si c'est un tableau, on le joint d'abord
        $content = implode('', $content);
    }

    // Maintenant on traite $content comme une chaine
    if (strlen($content) > $max_length) {
        $content = substr($content, 0, $max_length - strlen($ending)) . $ending;
    }

    return $content;
}