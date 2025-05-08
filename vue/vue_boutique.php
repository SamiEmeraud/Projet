<?php
// vue_boutique.php

global $produit;
include '../back/back_boutique.php';
include 'navbar.html';
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
        .custom-datalist {
            position: absolute;
            z-index: 1000;
            background: white;
            width: 100%;
            border: 1px solid #dee2e6;
            max-height: 300px;
            overflow-y: auto;
            display: none;
        }
        .custom-datalist div {
            padding: 8px 12px;
            cursor: pointer;
        }
        .custom-datalist div:hover {
            background-color: #f8f9fa;
            .alpha-btn {
                min-width: 32px;
                padding: 5px 10px;
                font-weight: bold;
                border-radius: 6px;
                cursor: pointer;
            }

        }
    </style>
</head>
<body class="bg-light">
<div class="container py-5">



    <!-- Champ de recherche personnalisé -->
    <div class="mb-4 text-center">
        <div class="position-relative" style="width: 100%; max-width: 600px; margin: auto;">
            <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un produit..." autocomplete="off">
            <div id="customDatalist" class="custom-datalist"></div>
        </div>
    </div>
    <!-- Barre alphabétique -->
    <div class="mb-3 text-center">
        <div id="alphabetBar" class="d-flex justify-content-center flex-wrap">
            <?php foreach (range('A', 'Z') as $letter): ?>
                <button class="btn btn-outline-secondary m-1 alpha-btn" data-letter="<?= $letter ?>"><?= $letter ?></button>
            <?php endforeach; ?>
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
                <div class="card shadow-sm h-100" data-name="<?= strtolower(htmlspecialchars($row['name'])) ?>">
                <?php $imagePath = "../Images/img_product/" . $row['product_id'] . ".jpeg"; ?>
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
</div>

<script>
    const searchInput = document.getElementById("searchInput");
    const customDatalist = document.getElementById("customDatalist");

    const produits = [
        <?php foreach ($produit as $row): ?>
        "<?= addslashes($row['name']) ?>",
        <?php endforeach; ?>
    ];

    searchInput.addEventListener("input", () => {
        const value = searchInput.value.toLowerCase();
        customDatalist.innerHTML = "";
        if (value === "") {
            customDatalist.style.display = "none";
            return;
        }
        const filtered = produits.filter(p => p.toLowerCase().includes(value));
        if (filtered.length === 0) {
            customDatalist.style.display = "none";
            return;
        }
        filtered.forEach(name => {
            const item = document.createElement("div");
            item.textContent = name;
            item.onclick = () => {
                searchInput.value = name;
                customDatalist.innerHTML = "";
                customDatalist.style.display = "none";
            };
            customDatalist.appendChild(item);
        });
        customDatalist.style.display = "block";
    });

    document.addEventListener("click", (e) => {
        if (!searchInput.contains(e.target) && !customDatalist.contains(e.target)) {
            customDatalist.style.display = "none";
        }
    });
    const alphaButtons = document.querySelectorAll(".alpha-btn");
    function filterCardsByLetter(letter) {
        const cards = document.querySelectorAll(".card[data-name]");
        cards.forEach(card => {
            const name = card.getAttribute("data-name");
            if (name.startsWith(letter)) {
                card.parentElement.style.display = "block"; // show col
            } else {
                card.parentElement.style.display = "none"; // hide col
            }
        });
    }


    alphaButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            const letter = btn.getAttribute("data-letter").toLowerCase();
            searchInput.value = "";
            customDatalist.innerHTML = "";

            const filtered = produits.filter(p => p.toLowerCase().startsWith(letter));
            if (filtered.length === 0) {
                customDatalist.style.display = "none";
                return;
            }

            filtered.forEach(name => {
                const item = document.createElement("div");
                item.textContent = name;
                item.onclick = () => {
                    searchInput.value = name;
                    customDatalist.innerHTML = "";
                    customDatalist.style.display = "none";
                };
                customDatalist.appendChild(item);
            });
            customDatalist.style.display = "block";
        });
    });

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>