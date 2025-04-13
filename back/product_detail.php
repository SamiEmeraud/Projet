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

if (!isset($_GET['product_id'])) {
    die("Produit non spécifié.");
}

$product_id = $_GET['product_id'];

$sql = "SELECT * FROM product WHERE id = :product_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
$stmt->execute();
$produit = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produit) {
    die("Produit introuvable.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($produit['name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo htmlspecialchars($produit['image_url']); ?>" class="img-fluid" alt="Produit">
        </div>
        <div class="col-md-6">
            <h1><?php echo htmlspecialchars($produit['name']); ?></h1>
            <p class="lead"><?php echo htmlspecialchars($produit['description']); ?></p>
            <h3 class="text-success"><?php echo number_format($produit['price'], 2); ?> €</h3>
            <a href="product.php?category_id=<?php echo $produit['category_id']; ?>" class="btn btn-secondary mt-3">Retour</a>
        </div>
    </div>
</div>
</body>
</html>
