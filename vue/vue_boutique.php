<?php
global $produit;
include '../back/back_boutique.php';
include 'navbar.html'
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Boutique de Figurines</title>
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
<body class="bg-light">
<div class="container py-5">
    <!-- Bannière de promotion -->
    <div class="promo-banner">
        <h4>Livraison gratuite</h4>
        <p class="mb-1"><strong>Maintenant avec chaque commande</strong></p>
        <p class="mb-0"><strong>Promotion : 1x2 pour la première commande, 20€ ensuite. Peut être combiné...</strong></p>
    </div>

    <!-- Section Télécharger l'application -->
    <div class="row mb-4">
        <div class="col-12">
            <h4>Télécharger notre application</h4>
            <p>Comment ? Mise en ligne de mission à réussir...</p>
        </div>
    </div>

    <!-- Filtres -->
    <div class="row mb-4">
        <div class="col-md-3">
            <select class="form-select">
                <option>Février</option>
                <option>Avril</option>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-select">
                <option>Best seller</option>
                <option>Nouveautés</option>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-select">
                <option>5 étoiles</option>
                <option>Toutes notes</option>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-select">
                <option>Catégorie ▼</option>
                <option>Figurines</option>
                <option>Accessoires</option>
            </select>
        </div>
    </div>

    <!-- Résultats de recherche -->
    <h3 class="mb-3">Résultats pour "site de figurine"</h3>

    <div class="row g-4">
        <?php foreach ($produit as $row): ?>
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-sm h-100">
                    <?php
                    // Chemin vers les images
                    $imagePath = "../manga/img_product" . $row['product_id'] . ".jpeg"
                    ?>

                    <img src="<?= htmlspecialchars($imagePath) ?>"
                         class="card-img-top"
                         alt="<?= htmlspecialchars($row['name']) ?>"
                         style="height: 200px; object-fit: cover;">

                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                        <p class="card-text text-muted small"><?= substr(htmlspecialchars($row['description']), 0, 50) ?>...</p>
                        <p class="price-highlight"><?= number_format($row['price'], 2) ?> €</p>
                        <div class="d-flex justify-content-between">
                            <a href="product_detail.php?id=<?= $row['product_id'] ?>" class="btn btn-sm btn-outline-primary">Voir détails</a>
                            <button class="btn btn-sm btn-success">Ajouter</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>