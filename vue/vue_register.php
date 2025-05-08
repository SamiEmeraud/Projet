<?php
session_start();
// Générer un captcha aléatoire à chaque chargement de la page
$_SESSION['captcha'] = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 5);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Inscription</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .form-container { max-width: 450px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); }
        .form-title { text-align: center; font-size: 24px; margin-bottom: 20px; }
        .form-label { font-weight: bold; }
        .btn-primary { width: 100%; }
        .login-link { text-align: center; margin-top: 15px; }
    </style>
    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</head>
<body class="container mt-5">

<h2 class="form-title">CRÉEZ VOTRE COMPTE</h2>

<div class="form-container">
    <form action="../back/back_register.php" method="post">
        <?php if(isset($_SESSION['register_error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['register_error']; unset($_SESSION['register_error']); ?>
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <label for="firstname" class="form-label">Prénom :</label>
            <input type="text" name="firstname" id="firstname" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="lastname" class="form-label">Nom :</label>
            <input type="text" name="lastname" id="lastname" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe :</label>
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control" required minlength="8">
                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password')">👁️</button>
            </div>
        </div>

        <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirmer mot de passe :</label>
            <div class="input-group">
                <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" required>
                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('confirmPassword')">👁️</button>
            </div>
        </div>

        <div class="mb-3">
            <label for="captcha" class="form-label">Recopie ce code : <strong><?= $_SESSION['captcha'] ?></strong></label>
            <input type="text" name="captcha" id="captcha" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">S'inscrire</button>

        <div class="login-link">
            <p>Vous avez déjà un compte ? <a href="../vue/vue_login.php">Connectez-vous ici</a>.</p>
        </div>
    </form>
</div>

</body>
</html>
