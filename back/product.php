<?php
$server_name = "localhost";
$user = "root";
$password = "";
$db_name = "e_commerce";

try {
    $conn = new PDO("mysql:host=localhost;dbname=$db_name", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    //var_dump($_GET['category_id']);
}
//Vérifie que l'ID de la catégorie est présent dans l'URL
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Récupère les produits correspondant à cette catégorie
    $sql = "SELECT * FROM product WHERE category_id = :category_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    $stmt->execute();
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    die("Catégorie non spécifiée.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h1 class="text-center mb-4">Produits de la Catégorie</h1>
    <div class="row g-4">

        <?php foreach ($produits as $produit): ?>
            <div class="col-md-6 col-lg-4">
                <a href="product_detail.php?id=<?php echo $produit['product_id']; ?>" class="text-decoration-none text-dark">
                    <div class="card shadow-sm h-100">
                        <img src="<?php echo htmlspecialchars($produit['image_url']); ?>" class="card-img-top" alt="Image du produit" style="height: 300px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($produit['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($produit['description']); ?></p>
                            <p class="card-text fw-bold"><?php echo number_format($produit['price'], 2); ?> €</p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>


    </div>
</div>
</body>
</html>