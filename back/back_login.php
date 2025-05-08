<?php
session_start();

// Connexion à la base de données
try {
    $conn = new PDO("mysql:host=localhost;dbname=e_commerce", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérification de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Vérification des informations de connexion
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Connexion réussie
        $_SESSION['username'] = $user['username'];
        $_SESSION['login_message'] = "Bienvenue, " . $user['username'] . " !";
        header("Location: ../vue/index.php");
        exit();
    } else {
        // Connexion échouée
        $_SESSION['login_message'] = "Email ou mot de passe incorrect.";
        header("Location: ../vue/vue_login.php");
        exit();
    }
}

?>
