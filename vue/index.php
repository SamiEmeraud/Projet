<?php session_start();

global $produit;
include '../back/back_boutique.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Mon E-commerce</title>
    <link rel="stylesheet" href="index.css">
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



<?php if (isset($_SESSION['username'])): ?>
    <h5 class="card-title"><?= htmlspecialchars($_SESSION['username']) ?></h5>
<?php else: ?>
    <h5 class="card-title"></h5>
<?php endif; ?>




</div>

<!-- Boutique + cliquable!-->
<div style="display: flex; flex-direction: column; align-items: flex-start; padding: 30px 0 0 30px;">
    <img src="../Images/Accueil/logo1.jpeg" alt="Logo" style="width: 150px; height: auto; margin-bottom: 15px;">
    <div style="display: flex; align-items: center; gap: 20px;">
        <a href="../vue/vue_boutique.php" class="home-title hidden-md-down">BOUTIQUE</a>

            <button type="submit" style="background: transparent; border: none; cursor: pointer; padding-left: 5px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#0066cc" viewBox="0 0 24 24">
                    <path d="M10 2a8 8 0 105.293 14.293l5.707 5.707 1.414-1.414-5.707-5.707A8 8 0 0010 2zm0 2a6 6 0 110 12 6 6 0 010-12z"/>

            </button>
        </form>
    </div>
</div>


<!-- Bannière d'accueil -->
<div id="carouselAccueil" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" data-bg="../Images/Background_web/.jpeg">
            <img src="../Images/Accueil/1.jpeg" class="d-block w-100" alt="Image 1" style="object-fit: cover;">
        </div>
        <div class="carousel-item" data-bg="../Images/Background_web/.jpeg">
            <img src="../Images/Accueil/2.jpeg" class="d-block w-100" alt="Image 2" style="object-fit: cover;">
        </div>
        <div class="carousel-item" data-bg="../Images/Background_web/.jpeg">
            <img src="../Images/Accueil/3.jpeg" class="d-block w-100" alt="Image 3" style="object-fit: cover;">
        </div>
        <div class="carousel-item" data-bg="../Images/Background_web/.jpeg">
            <img src="../Images/Accueil/10.jpeg" class="d-block w-100" alt="Image 4" style="object-fit: cover;">
        </div>
        <div class="carousel-item" data-bg="../Images/Background_web/.jpeg">
            <img src="../Images/Accueil/5.jpeg" class="d-block w-100" alt="Image 5" style="object-fit: cover;">
        </div>
        <div class="carousel-item" data-bg="../Images/Background_web/.jpeg">
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

<!-- Section avec l'image de fond et l'animation du texte "Nouveautés" -->
<section class="nouveautes">
    <div class="nouveautes-content">
    </div>
</section>
<div class="container mt-4">

    <?php
    $images = glob("../Images/img_category/*.jpeg");
    foreach ($images as $image): ?>
        <div class="mb-3">
            <img src="<?= htmlspecialchars($image) ?>" class="img-fluid" alt="Image">
        </div>
    <?php endforeach; ?>
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