<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Mon E-commerce</title>

    <style>
        body {
            transition: background-image 0.5s ease-in-out;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-color: #ffffff;
            margin: 0; /* Enlever toute marge du corps */
        }

        #carouselAccueil .carousel-item img {
            width: 100%;
            height: 100vh; /* Pour occuper toute la hauteur de l'écran */
            object-fit: cover;
            display: block;
        }

        .carousel-inner {
            margin: 0; /* Supprimer toute marge */
            padding: 0; /* Supprimer tout padding */
        }
    </style>



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

<div>

    <div>
        <br>
        <br>

    </div>
</div>

<?php if (isset($_SESSION['username'])): ?>
    <h5 class="card-title"><?= htmlspecialchars($_SESSION['username']) ?></h5>
<?php else: ?>
    <h5 class="card-title"></h5>
<?php endif; ?>


<!-- Bannière d'accueil -->
<div id="carouselAccueil" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" data-bg="../Images/Background_web/bg1.jpeg">
            <img src="../Images/Accueil/9.jpeg" class="d-block w-100" alt="Image 1" style="object-fit: cover;">
        </div>
        <div class="carousel-item" data-bg="../Images/Background_web/bg2.jpeg">
            <img src="../Images/Accueil/2.jpeg" class="d-block w-100" alt="Image 2" style="object-fit: cover;">
        </div>
        <div class="carousel-item" data-bg="../Images/Background_web/bg3.jpeg">
            <img src="../Images/Accueil/3.jpeg" class="d-block w-100" alt="Image 3" style="object-fit: cover;">
        </div>
        <div class="carousel-item" data-bg="../Images/Background_web/bg4.jpeg">
            <img src="../Images/Accueil/10.jpeg" class="d-block w-100" alt="Image 4" style="object-fit: cover;">
        </div>
        <div class="carousel-item" data-bg="../Images/Background_web/bg5.jpeg">
            <img src="../Images/Accueil/5.jpeg" class="d-block w-100" alt="Image 5" style="object-fit: cover;">
        </div>
        <div class="carousel-item" data-bg="../Images/Background_web/bg6.jpeg">
            <img src="../Images/Accueil/6.jpeg" class="d-block w-100" alt="Image 6" style="object-fit: cover;">
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselAccueil" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Précédent</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselAccueil" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Suivant</span>
    </button>
</div>

<?php foreach ($category_product as $row): ?>
    <div class="col-md-6 col-lg-3">
        <div class="card shadow-sm h-100">
            <?php
            $imagePath = "../Images/Accueil/" . $row['category_id'] . ".jpeg"
            ?>
            <img src="<?= htmlspecialchars($imagePath) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['nom_category']) ?>" style="height: 200px; object-fit: cover;">

            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($row['nom_category']) ?></h5>
                <p class="card-text text-muted small"><?= substr(htmlspecialchars($row['description']), 0, 50) ?>...</p>



            </div>
        </div>
    </div>
<?php endforeach; ?>

</div>


<!-- Grille Bootstrap pour l'affichage des catégories -->
<div class="row g-4">

</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const carousel = document.getElementById('carouselAccueil');
        const body = document.body;

        function updateBackground() {
            const activeItem = carousel.querySelector('.carousel-item.active');
            if (activeItem) {
                const bg = activeItem.getAttribute('data-bg');
                body.style.backgroundImage = `url('${bg}')`;
                body.style.backgroundColor = ''; // on désactive toute couleur
            }
        }

        updateBackground(); // Au chargement initial
        carousel.addEventListener('slid.bs.carousel', updateBackground); // À chaque changement de slide
    });
</script>


<!-- Intégration de Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>