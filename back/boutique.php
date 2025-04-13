<?php
// Connexion à la base de données
$server_name = "localhost";
$user = "root";
$password = "";
$db_name = "e_commerce";

try {
    // Création d'une instance PDO pour se connecter à la base de données
    $conn = new PDO("mysql:host=localhost;dbname=$db_name", $user, $password);
    // Configuration pour afficher les erreurs de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En cas d’erreur de connexion, on arrête l’exécution avec un message
    die("Erreur : " . $e->getMessage());
}

// Requête pour récupérer toutes les catégories de produits
$sql = "SELECT * FROM category_product";
$stmt = $conn->query($sql);
// Récupération des résultats sous forme de tableau associatif
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Boutique</title>
    <!-- Intégration de Bootstrap pour le style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <!-- Titre de la page -->
    <h1 class="text-center mb-4">Nos Catégories</h1>

    <!-- Grille responsive pour afficher les cartes -->
    <div class="row g-4">

        <!-- Boucle sur chaque catégorie pour afficher une carte -->
        <?php foreach ($categories as $row): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <!-- Titre de la catégorie -->
                        <h5 class="card-title"><?php echo htmlspecialchars($row['nom_category']); ?></h5>
                        <!-- Description de la catégorie -->
                        <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                        <!-- Bouton pour "voir les produits" (fonctionnalité à ajouter) -->

                        <a href="product.php?id_category=<?php echo $row['category_id']; ?>" class="btn btn-primary">Voir les produits</a>



                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>
</body>
</html>
