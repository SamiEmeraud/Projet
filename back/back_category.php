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
$category_product = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
