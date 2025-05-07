<?php
include 'navbar.html';
session_start();
$captcha = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 5);
$_SESSION['captcha'] = $captcha;
?>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Inscription</title>
</head>
<body class="container mt-5">
<h2 class="mb-4">Inscription</h2>

<form action="../back/back_register.php" method="post" class="col-md-6">
    <div class="mb-3">
        <label for="firstname" class="form-label">Prénom :</label>
        <input type="text" name="firstname" id="firstname" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="lastname" class="form-label">Nom :</label>
        <input type="text" name="lastname" id="lastname" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="birthdate" class="form-label">Date de naissance :</label>
        <input type="date" name="birthdate" id="birthdate" class="form-control">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email :</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe :</label>
        <input type="password" name="password" id="password" class="form-control" required minlength="8">
    </div>

    <div class="mb-3">
        <label for="confirmPassword" class="form-label">Confirmer mot de passe :</label>
        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="captcha" class="form-label">Recopie ce code : <strong><?= $captcha ?></strong></label>
        <input type="text" name="captcha" id="captcha" class="form-control" required>
    </div>
    <?php
    if (isset($_SESSION['capcha_message'])){
       echo $_SESSION['capcha_message'];
    }
    ?>
    <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>
</body>
