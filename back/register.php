
<?php
function conndb(){
// Connexion à la base de données
    $server_name = "localhost";
    $user = "root";
    $password = "";
    $db_name = "e_commerce";
    try {
        $conn = new PDO("mysql:host=$server_name;dbname=$db_name", $user, $password);
        echo "Connexion à la base de données '$db_name' réussie.";
    }
    catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}
