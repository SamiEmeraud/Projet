<?php
session_start();

// Connexion à la base de données
try {
    $conn = new PDO("mysql:host=localhost;dbname=e_commerce", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

// Test de réception du formulaire
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Formulaire non soumis correctement.");
}

// Vérification des champs obligatoires
if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'], $_POST['confirmPassword'], $_POST['captcha'])) {

    $firstname = htmlspecialchars(trim($_POST['firstname']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);
    $captchaInput = trim($_POST['captcha']);

    // Vérification du captcha
    if ($captchaInput !== $_SESSION['captcha']) {
        $_SESSION['register_error'] = "Captcha incorrect. Veuillez réessayer.";
        header('Location: ../vue/vue_register.php');
        exit();
    }

    // Vérification de correspondance des mots de passe
    if ($password !== $confirmPassword) {
        $_SESSION['register_error'] = "Les mots de passe ne correspondent pas.";
        header('Location: ../vue/vue_register.php');
        exit();
    }

    // Hachage du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $username = $firstname . ' ' . $lastname;

    // Insertion dans la base de données
    try {
        $stmt = $conn->prepare("INSERT INTO users (username, password, email, statue) VALUES (?, ?, ?, 'en ligne')");
        $stmt->execute([$username, $hashedPassword, $email]);

        if ($stmt->rowCount()) {
            require_once '../mailer.php'; // adapte le chemin selon où est back_register.php

            $result = sendWelcomeEmail($email, $username);

            if ($result === true) {
                $_SESSION['login_message'] = "Inscription réussie. Un email de bienvenue vous a été envoyé.";
            } else {
                $_SESSION['login_message'] = "Inscription réussie, mais l'email n'a pas pu être envoyé : $result";
            }

            header("Location: ../vue/vue_login.php");
            exit();

            $_SESSION['login_message'] = "Bonjour, nous sommes ravis de vous voir connecté.";
            header("Location: ../vue/vue_login.php");
            exit();
        } else {
            $_SESSION['register_error'] = "Erreur lors de l'inscription.";
            header('Location: ../vue/vue_register.php');
            exit();
        }
    } catch (PDOException $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
} else {
    $_SESSION['register_error'] = "Veuillez remplir tous les champs obligatoires.";
    header('Location: ../vue/vue_register.php');
    exit();
}
?>
