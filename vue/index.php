<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Mon E-commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
<!--    <style>-->
<!--        :root {-->
<!--            /* Variables de couleur */-->
<!--            --color-background: 255, 255, 255;-->
<!--            --color-foreground: 18, 18, 18;-->
<!--            --color-button: 228, 152, 24;-->
<!--            --color-button-text: 255, 255, 255;-->
<!--            --color-link: 228, 152, 24;-->
<!---->
<!--            /* Variables de typographie */-->
<!--            --font-body-family: 'Assistant', sans-serif;-->
<!--            --font-heading-family: 'Assistant', sans-serif;-->
<!--            --font-body-weight: 600;-->
<!--            --font-heading-weight: 700;-->
<!--            --font-body-scale: 1.0;-->
<!--            --font-heading-scale: 1.15;-->
<!---->
<!--            /* Variables d'ombre et effets */-->
<!--            --media-border-opacity: 0.05;-->
<!--            --media-border-width: 1px;-->
<!--            --media-radius: 0px;-->
<!--            --media-shadow-opacity: 0.0;-->
<!--            --duration-default: 0.2s;-->
<!--        }-->
<!---->
<!--        body {-->
<!--            font-family: var(--font-body-family);-->
<!--            font-weight: var(--font-body-weight);-->
<!--            color: rgba(var(--color-foreground), 0.75);-->
<!--            background-color: rgb(var(--color-background));-->
<!--            margin: 0;-->
<!--            padding: 0;-->
<!--            display: grid;-->
<!--            grid-template-rows: auto auto 1fr auto;-->
<!--            grid-template-columns: 100%;-->
<!--            min-height: 100vh;-->
<!--        }-->
<!---->
<!--        /* Style pour le conteneur d'images avec effet de superposition */-->
<!--        .banner__media {-->
<!--            position: relative;-->
<!--            width: 100%;-->
<!--            overflow: hidden;-->
<!--            border-radius: var(--media-radius);-->
<!--            border: var(--media-border-width) solid rgba(var(--color-foreground), var(--media-border-opacity));-->
<!--        }-->
<!---->
<!--        .banner__media::after {-->
<!--            content: "";-->
<!--            position: absolute;-->
<!--            top: 0;-->
<!--            left: 0;-->
<!--            right: 0;-->
<!--            bottom: 0;-->
<!--            background: #000;-->
<!--            opacity: 0;-->
<!--            z-index: 1;-->
<!--            transition: opacity var(--duration-default) ease;-->
<!--        }-->
<!---->
<!--        .banner__media:hover::after {-->
<!--            opacity: 0.1;-->
<!--        }-->
<!---->
<!--        .banner__image {-->
<!--            width: 100%;-->
<!--            height: 100%;-->
<!--            object-fit: cover;-->
<!--            display: block;-->
<!--            transition: transform var(--duration-default) ease;-->
<!--        }-->
<!---->
<!--        .banner__media:hover .banner__image {-->
<!--            transform: scale(1.03);-->
<!--        }-->
<!---->
<!--        /* Style pour la grille de produits */-->
<!--        .product-grid {-->
<!--            display: grid;-->
<!--            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));-->
<!--            gap: 2rem;-->
<!--            padding: 2rem;-->
<!--        }-->
<!---->
<!--        .product-card {-->
<!--            position: relative;-->
<!--            overflow: hidden;-->
<!--            box-shadow: 0 4px 8px rgba(var(--color-shadow), 0.1);-->
<!--            transition: all var(--duration-default) ease;-->
<!--        }-->
<!---->
<!--        .product-card:hover {-->
<!--            box-shadow: 0 6px 12px rgba(var(--color-shadow), 0.15);-->
<!--            transform: translateY(-5px);-->
<!--        }-->
<!---->
<!--        .product-card__info {-->
<!--            padding: 1.5rem;-->
<!--            background: rgb(var(--color-background));-->
<!--        }-->
<!---->
<!--        .product-card__title {-->
<!--            font-family: var(--font-heading-family);-->
<!--            font-weight: var(--font-heading-weight);-->
<!--            color: rgb(var(--color-foreground));-->
<!--            margin: 0 0 0.5rem 0;-->
<!--            font-size: 1.6rem;-->
<!--        }-->
<!---->
<!--        .product-card__description {-->
<!--            color: rgba(var(--color-foreground), 0.75);-->
<!--            font-size: 1.4rem;-->
<!--            margin: 0;-->
<!--        }-->
<!---->
<!--        @media screen and (min-width: 750px) {-->
<!--            body {-->
<!--                font-size: 1.6rem;-->
<!--            }-->
<!---->
<!--            .product-grid {-->
<!--                grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));-->
<!--            }-->
<!--        }-->
<!--    </style>-->
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

<h5 class="card-title"><?=($_SESSION['username']) ?></h5>

<!-- Grille Bootstrap pour l'affichage des catégories -->
<div class="row g-4">
    <?php foreach ($category_product as $row): ?>
        <div class="col-md-6 col-lg-3">
            <div class="card shadow-sm h-100">
                <?php
                // Chemin vers les images
                $imagePath = "../Images/img_category/" . $row['category_id'] . ".jpeg"
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