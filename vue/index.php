<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Mon E-commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<!-- Inclusion de la barre de navigation -->
<?php include 'navbar.html'; ?>


<!-- Récupération des données des catégories -->
<?php

global $category_product;

include '../back/back_category.php'; // Fichier qui charge les catégories depuis la BDD
?>

<!-- Titre principal -->
<h1>Bienvenue</h1>

<?php if (isset($_SESSION['username'])): ?>
    <h5 class="card-title"><?= htmlspecialchars($_SESSION['username']) ?></h5>
<?php else: ?>
    <h5 class="card-title"></h5>
<?php endif; ?>


<!-- Bannière d'accueil -->
<div class="banner__media">
</div>
<div id="carouselAccueil" class="carousel slide mb-4" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="../Images/Accueil/1.jpeg" class="d-block w-100" alt="Slide 1" style="height: 747px; object-fit: cover;">
        </div>
        <div class="carousel-item">
            <img src="../Images/Accueil/2.jpeg" class="d-block w-100" alt="Slide 2" style="height: 747px; object-fit: cover;">
        </div>
        <div class="carousel-item">
            <img src="../Images/Accueil/3.jpeg" class="d-block w-100" alt="Slide 3" style="height:  747px; object-fit: cover;">
        </div>
        <div class="carousel-item">
            <img src="../Images/Accueil/4.jpeg" class="d-block w-100" alt="Slide 1" style="height:  747px; object-fit: cover;">
        </div>
        <div class="carousel-item">
            <img src="../Images/Accueil/5.jpeg" class="d-block w-100" alt="Slide 1" style="height:  747px; object-fit: cover;">
        </div>
    </div>

    <!-- Contrôles gauche/droite -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselAccueil" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Précédent</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselAccueil" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Suivant</span>
    </button>
</div>
<style>
<!-- SECTION : Trois bannières de catégories avec texte superposé -->
<!-- Trois bannières sans espace -->
/* Réinitialisation globale */
* {
margin: 0;
padding: 0;
box-sizing: border-box;
}

html, body {
width: 100%;
height: 100%;
margin: 0 !important;
padding: 0 !important;
overflow-x: hidden;
background-color: #fff;
}

/* Carrousel */
#carouselAccueil {
margin: 0 !important;
padding: 0 !important;
}

.carousel-inner {
width: 100%;
}

.carousel-item img {
width: 100%;
height: 747px;
object-fit: cover;
display: block;
border: none;
}

/* Bannières collées (trois blocs) */
.three-banner-row {
display: flex;
flex-wrap: nowrap;
width: 100%;
margin: 0 !important;
padding: 0 !important;
gap: 0;
}

.three-banner-col {
flex: 1;
height: 400px;
position: relative;
overflow: hidden;
}

.three-banner-col a {
display: block;
width: 100%;
height: 100%;
text-decoration: none;
}

.three-banner-col img {
width: 100%;
height: 100%;
object-fit: cover;
display: block;
border: none;
}

/* Texte superposé au centre */
.three-banner-caption {
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
text-align: center;
color: white;
font-size: 2rem;
font-weight: bold;
text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.9);
z-index: 2;
line-height: 1.2;
}

/* Titre d'anime spécifique */
.anime-title {
font-size: 2.5rem;
color: #FFD700;
}

/* Responsive */
@media screen and (max-width: 768px) {
.three-banner-row {
flex-direction: column;
}

.three-banner-col {
height: 300px;
}

.three-banner-caption {
font-size: 1.5rem;
}

.anime-title {
font-size: 2rem;
}
}
</style>

<div class="three-banner-row"><div class="three-banner-col"><a href="#"><img src="../Images/img_category/9.jpeg" alt="One Piece"><div class="three-banner-caption"></div></a></div><div class="three-banner-col"><a href="#"><img src="../Images/img_category/10.jpeg" alt="Dragon Ball"><div class="three-banner-caption"></div></a></div><div class="three-banner-col"><a href="#"><img src="../Images/img_category/11.jpeg" alt="Demon Slayer"><div class="three-banner-caption"></div></a></div></div>


<!-- Grille Bootstrap pour l'affichage des catégories -->
<div class="row g-4">
    <?php foreach ($category_product as $row): ?>
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm h-100">
                <?php
                // Chemin vers les images
                $imagePath = "../Images/Accueil/" . $row['category_id'] . ".jpeg"
                ?>

                <img src="<?= htmlspecialchars($imagePath) ?>"
                     class="card-img-top"
                     alt="<?= htmlspecialchars($row['nom_category']) ?>"
                     style="height: 200px; object-fit: cover;">

                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($row['nom_category']) ?></h5>
                    <p class="card-text text-muted small"><?= substr(htmlspecialchars($row['description']), 0, 50) ?>...</p>
                    <div class="d-flex justify-content-between">

                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<!-- Intégration de Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>