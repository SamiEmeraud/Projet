<?php
// Connexion
try {
    $conn = new PDO("mysql:host=localhost;dbname=e_commerce", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

// Traitement
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name'] ?? '');
    $description = htmlspecialchars($_POST['description'] ?? '');
    $price = floatval($_POST['price'] ?? 0);
    $image_url = htmlspecialchars($_POST['image_url'] ?? '');

    try {
        $stmt = $conn->prepare("INSERT INTO products (name, description, price, image_url) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $description, $price, $image_url]);

        echo "Produit ajouté avec succès !";
    } catch (PDOException $e) {
        die("Erreur d'ajout : " . $e->getMessage());
    }
}
?>
