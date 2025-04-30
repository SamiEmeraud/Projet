<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Définition des métadonnées et titre de la page -->
    <meta charset="UTF-8">
    <title>Accueil - Mon E-commerce</title>

    <!-- Intégration de Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .promo-banner {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 5px solid #ffc107;
        }
        .price-highlight {
            color: #dc3545;
            font-weight: bold;
        }
        .card {
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
    </style>

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

<!-- Grille Bootstrap pour l'affichage des catégories -->
<div class="row g-4">
    <!-- Boucle sur chaque catégorie -->
    <?php foreach ($category_product as $row): ?>
        <div class="col-md-6 col-lg-3"> <!-- Colonne responsive -->
            <div class="card shadow-sm h-100"> <!-- Carte Bootstrap -->
                <div class="card-body">
                    <!-- Nom de la catégorie -->
                    <h5 class="card-title"><?= htmlspecialchars($row['nom_category']) ?></h5>

                    <!-- Description tronquée -->
                    <p class="card-text text-muted small">
                        <?= substr(htmlspecialchars($row['description']), 0, 50) ?>...
                    </p>

                    <!-- Bouton "Voir détails" -->
                    <div class="d-flex justify-content-between">
                        <a href="category_detail.php?id=<?= $row['category_id'] ?>"
                           class="btn btn-sm btn-outline-primary">
                            Voir détails
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php
    // Chemin vers les images
    $imagePath = "../Images/img_category" . $row['category_id'] . ".jpeg"
    ?>

    <img src="<?= htmlspecialchars($imagePath) ?>"
         class="card-img-top"
         alt="<?= htmlspecialchars($row['nom_category']) ?>"
         style="height: 200px; object-fit: cover;">
<!-- Intégration de Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>