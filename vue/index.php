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



</div>
<style>
.home-title.hidden-md-down {
background-color: #5AC2E6; /* couleur bleu clair comme dans l'image */
color: #FFFFFF;
font-family: 'Poppins', sans-serif;
font-size: 14px;
padding: 15px 15px 15px 45px;
border-radius: 4px;
width: 210px;
height: 46px;
display: flex;
align-items: center;
justify-content: center;
margin: 0;
}
</style>
<!-- Boutique + cliquable!-->
<div style="display: flex; padding: 30px 0 0 30px;">
    <div style="display: flex; align-items: center; gap: 20px;">
        <a href="../vue/vue_boutique.php" class="home-title hidden-md-down">BOUTIQUE</a>
        <form action="search.php" method="get" style="display: flex; align-items: center;">
            <input
                    class="ui-autocomplete-input"
                    type="text"
                    name="query"
                    placeholder="Rechercher"
                    aria-label="Rechercher"
                    role="textbox"
            />
            <button type="submit" style="background: transparent; border: none; cursor: pointer; padding-left: 5px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#0066cc" viewBox="0 0 24 24">
                    <path d="M10 2a8 8 0 105.293 14.293l5.707 5.707 1.414-1.414-5.707-5.707A8 8 0 0010 2zm0 2a6 6 0 110 12 6 6 0 010-12z"/>
                </svg>
            </button>
        </form>
    </div>
</div>

<style>
.ui-autocomplete-input {
width: 200px;
height: 40px;
padding: 5px 10px;
background-color: #F5F5F5;
border: none;
border-radius: 4px;
font-size: 14px;
outline: none;
}

.ui-autocomplete-input:focus {
box-shadow: 0 0 0 2px #cce0ff;
}
.home-title.hidden-md-down {
    background-color: #5AC2E6;
    color: #FFFFFF;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    padding: 15px 15px 15px 45px;
    border-radius: 4px;
    width: 210px;
    height: 46px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0;
    text-decoration: none; /* enlève le soulignement */
}

.home-title.hidden-md-down:hover {
    background-color: #45b0d4; /* effet au survol */
}

</style>

<!-- Bannière d'accueil -->
<div id="carouselAccueil" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" data-bg="../Images/Background_web/bg1.jpeg">
            <img src="../Images/Accueil/1.jpeg" class="d-block w-100" alt="Image 1" style="object-fit: cover;">
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