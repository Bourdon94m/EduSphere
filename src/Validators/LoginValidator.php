<?php
session_start();
define('BASE_PATH', dirname(__DIR__, 2));
require_once BASE_PATH . '/src/config.php';
require_once BASE_PATH . '/src/utilities.php';

function loginUser($email, $password): bool
{
    $conn = getDbConnection();
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            return true;
        }
    }
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    header('Content-Type: application/json');

    if (loginUser($email, $password)) {
        echo json_encode(['success' => true, 'message' => 'Connexion réussie !']);
    } else {
        http_response_code(401); // Unauthorized
        echo json_encode(['success' => false, 'message' => 'Identifiants incorrects']);
    }
    exit;
}