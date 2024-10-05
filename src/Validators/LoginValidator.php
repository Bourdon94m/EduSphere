<?php

// Définition du chemin de base
define('BASE_PATH', dirname(__DIR__, 2));
const BASE_URL = '/EduSphere';
require_once BASE_PATH . '/src/config.php';
require_once BASE_PATH . '/src/utilities.php';



function loginUser($email, $password): bool
{

    $conn = getDbConnection();

    // Préparer la requête SQL
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Vérifier le mot de passe
        if (password_verify($password, $user['password'])) {
            // Démarrer la session
            session_start();
            // Stocker l'ID de l'utilisateur dans la session
            $_SESSION['user_id'] = $user['id'];
            return true; // Connexion réussie
        }
    }

    return false; // Échec de la connexion
}

// Utilisation de la fonction
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (loginUser($email, $password)) {
        echo "Connexion réussie !";
        // Rediriger vers la page d'accueil ou le tableau de bord
        redirect("index.php");
    } else {
        echo "Échec de la connexion. Vérifiez vos identifiants.";
    }
}