<?php

// Définition du chemin de base
require_once  'utilities.php';

function getDbConnection() {
    static $conn;
    if ($conn === null) {
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "EduSphereTest";

        $conn = new mysqli($host, $username, $password, $database);

        if ($conn->connect_error) {
            die("La connexion a la base de donnée a échoué :" . $conn->connect_error);
        }

        $conn->set_charset("utf8mb4");
    }
    return $conn;

}

function isLoggedIn(): bool
{
    return isset($_SESSION["user_id"]);
}


function getAllProducts($conn) {
    $stmt = $conn->prepare("SELECT * FROM products");
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    return $products;
}

function getFormationById($connexion, $id): ?array {
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $connexion->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $formation = $result->fetch_assoc();
    return $formation ? $formation : null;
}

// Fonction pour récupérer les cours populaires
function latestCourse($connexion) {
    $query = "SELECT * FROM products ORDER BY created_at DESC LIMIT 3";
    $stmt = $connexion->prepare($query);
    if ($stmt === false) {
        error_log("Erreur de préparation de la requête : " . $connexion->error);
        return [];
    }
    if (!$stmt->execute()) {
        error_log("Erreur d'exécution de la requête : " . $stmt->error);
        return [];
    }
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}