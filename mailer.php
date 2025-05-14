<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';

function sendWelcomeEmail($destEmail, $destName)
{
    $mail = new PHPMailer(true);

    try {
        // Config serveur SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'samimtimet08@gmail.com'; // Ton adresse Gmail
        $mail->Password = 'eajcovddrfvqcnnk'; // Ton mot de passe d'application généré par Google

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Expéditeur et destinataire
        $mail->setFrom('samimtimet08@gmail.com', 'E-commerce');
        $mail->addAddress($destEmail, $destName);

        // Contenu de l’email
        $mail->isHTML(true);
        $mail->Subject = 'Bienvenue sur notre site web !';
        $mail->Body = "
            <h2>Bienvenue $destName !</h2>
            <p>Merci de vous être inscrit sur notre site e-commerce.</p>
            <p><a href='http://localhost/ton-projet/vue/vue_login.php'>Connectez-vous ici</a></p>
        ";

        $mail->send();
        return true;

    } catch (Exception $e) {
        return "Erreur mailer : {$mail->ErrorInfo}";
    }
}

