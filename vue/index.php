<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Mon E-commerce</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600&display=swap" rel="stylesheet">
    <style>
        .carousel-item img {
            width: 100%;
            height: 500px; /* Ajuste selon tes besoins */
            object-fit: cover;
        }
    </style>

</head>

<body>

<!-- Navbar principale -->
<?php include 'navbar.html'; ?>

<!-- Ajoute ce div pour compenser la hauteur de la navbar -->
<div style="margin-top: 80px;"></div>

<!-- Contenu principal ici -->
<section class="mon-contenu">
    <h1>Bienvenue dans notre boutique !</h1>
</section>


<!-- Barre secondaire sous la navbar -->
<div class="secondary-bar d-flex align-items-center justify-content-between px-4 py-2 border-bottom bg-light flex-wrap">
    <div class="d-flex align-items-center mb-2 mb-md-0">
        <a href="vue_boutique.php" class="btn btn-primary me-3">
            <i class="bi bi-list"></i> BOUTIQUE
        </a>
        <form class="d-flex" role="search">
            <input class="form-control" type="search" placeholder="Rechercher" aria-label="Rechercher">
            <button class="btn btn-outline-primary ms-2" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>

    <nav class="d-flex flex-wrap gap-3">
        <a class="nav-link text-primary fw-bold p-0" href="#">Promotions</a>
        <a class="nav-link p-0" href="#">Shōnen Jump</a>
        <a class="nav-link p-0" href="#">Nouveautés</a>
        <a class="nav-link p-0" href="#">Précommandes</a>
        <a class="nav-link p-0" href="#">Goodies</a>
        <a class="nav-link p-0" href="#">Maquettes</a>
        <a class="nav-link p-0" href="#">Cartes</a>
        <a class="nav-link p-0" href="#">Loterie</a>
        <a class="nav-link p-0" href="#">Cartes Cadeaux</a>
    </nav>
</div>

<!-- Chargement des catégories -->
<?php
global $category_product;
include '../back/back_category.php';
?>

<!-- Nom de l'utilisateur connecté -->
<?php if (isset($_SESSION['username'])): ?>
    <h5 class="card-title"><?= htmlspecialchars($_SESSION['username']) ?></h5>
<?php endif; ?>

<!-- Bannière d'accueil avec carrousel -->
<div id="carouselAccueil" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php
        $imagesCarousel = ['1.jpeg', '2.jpeg', '3.jpeg', '10.jpeg', '5.jpeg', '7.jpeg'];
        foreach ($imagesCarousel as $index => $img): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>" data-bg="../Images/Background_web/.jpeg">
                <img src="../Images/Accueil/<?= $img ?>" class="d-block w-100 carousel-img" alt="Image <?= $index + 1 ?>">

            </div>
        <?php endforeach; ?>
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
<div class="container mt-5">
    <h2 class="tendance-titre animate-pop"><span class="emoji-fire">🔥</span> Tendance</h2>


</div>
<?php
// Connexion à la base de données
try {
    $conn = new PDO("mysql:host=localhost;dbname=e_commerce", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour récupérer les produits tendance
    $stmt = $conn->query("SELECT * FROM produits ORDER BY id DESC LIMIT 6"); // dernier ajoutés
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<div class="container">
    <div class="row">

        <?php foreach ($produits as $produit): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <?php $imagePath = "../Images/img_product/" . $produit['id'] . ".jpeg"; ?>
                    <img src="<?= htmlspecialchars($imagePath) ?>" class="card-img-top" alt="<?= htmlspecialchars($produit['nom']) ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($produit['nom']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($produit['description']); ?></p>
                        <p class="card-text"><strong><?php echo number_format($produit['prix'], 2); ?> €</strong></p>
                        <a href="vue_detail_produit.php?id=<?php echo $produit['id']; ?>" class="btn btn-primary">Voir le produit</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Section nouveautés -->
<section class="nouveautes">
    <div class="nouveautes-content"></div>
</section>

<!-- Images de catégories -->
<div class="container mt-4">
    <?php
    $images = glob("../Images/img_category/*.jpeg");
    foreach ($images as $image): ?>
        <div class="mb-3">
            <img src="<?= htmlspecialchars($image) ?>" class="img-fluid" alt="Image">
        </div>
    <?php endforeach; ?>
</div>

<!-- Cartes de catégories -->
<div class="container">
    <div class="row g-4">
        <?php foreach ($category_product as $row): ?>
            <div class="col-md-6 col-lg-3">
                <div class="card shadow-sm h-100">
                    <?php $imagePath = "../Images/Accueil/" . $row['category_id'] . ".jpeg"; ?>
                    <img src="<?= htmlspecialchars($imagePath) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['nom_category']) ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['nom_category']) ?></h5>
                        <p class="card-text text-muted small"><?= substr(htmlspecialchars($row['description']), 0, 50) ?>...</p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Background dynamique selon le carrousel -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const carousel = document.getElementById('carouselAccueil');
        const body = document.body;

        function updateBackground() {
            const activeItem = carousel.querySelector('.carousel-item.active');
            if (activeItem) {
                const bg = activeItem.getAttribute('data-bg');
                body.style.backgroundImage = `url('${bg}')`;
                body.style.backgroundColor = '';
            }
        }

        updateBackground();
        carousel.addEventListener('slid.bs.carousel', updateBackground);
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
