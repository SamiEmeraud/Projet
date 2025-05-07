<?php
session_start();
include "navbar.html";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<h2 class="mb-4">Connexion</h2>
<form action="../back/back_login.php" method="post" class="col-md-6">
    <div class="mb-3">
        <label for="email" class="form-label">Adresse email :</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe :</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <?php
    if (isset($_SESSION['login_message'])){
        echo $_SESSION['login_message'];
    }
    ?>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>
</body>
</html>


