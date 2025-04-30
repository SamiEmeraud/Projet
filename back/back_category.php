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

// Récupération des utilisateurs
$sqlUsers = "SELECT * FROM users";
$stmtUsers = $conn->query($sqlUsers);
$users = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);
global $users;
//Récupérer le nom de l'utilisateur connecté//
$username = "Invité"; // Valeur par défaut
if (isset($_SESSION['user_id'])) {
    $stmt = $users->prepare("SELECT username FROM users WHERE user_id = user_id");
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $username = $user['username'];
    }
}

?>
