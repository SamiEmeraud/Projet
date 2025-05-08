<?php
session_start();
include 'navbar.html';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container { max-width: 450px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); }
    </style>
    <script>
        function togglePassword(id) {
            var input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</head>
<body class="container mt-5">
<h2 class="text-center">Connexion</h2>

<div class="form-container">
    <form action="../back/back_login.php" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Adresse email :</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe :</label>
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control" required>
                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password')">👁️</button>
            </div>
        </div>

        <?php
        if (isset($_SESSION['login_message'])){
            echo "<div class='alert alert-info'>" . $_SESSION['login_message'] . "</div>";
            unset($_SESSION['login_message']);
        }
        ?>

        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
        <div class="mt-3 text-center">
            <p>Pas encore de compte ? <a href="../vue/vue_register.php">Inscrivez-vous ici</a>.</p>
        </div>
    </form>
</div>

</body>
</html>
