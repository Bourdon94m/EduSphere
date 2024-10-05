<?php

// Définition du chemin de base
define('BASE_PATH', dirname(__DIR__, 2));
const BASE_URL = '/EduSphere';
require_once BASE_PATH . '/src/config.php';
require_once BASE_PATH . '/src/utilities.php';


function isRegisterFormEmpty(): array {
    $name = $_POST["name"] ?? '';
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';
    $confirmPassword = $_POST["confirm_password"] ?? '';

    $errors = [];

    if (empty($name)) $errors[] = "Le nom est requis";
    if (empty($email)) $errors[] = "L'email est requis";
    if (empty($password)) $errors[] = "Le password est requis";
    if (empty($confirmPassword)) $errors[] = "La confirmartion du mdp est requise";

    return $errors;

}

function isRegisterConfirmPasswordSameAsPassword(): bool {
    if (!isset($_POST["password"]) || !isset($_POST["confirm_password"])) {
        return false;
    }

    return $_POST["confirm_password"] === $_POST["password"];

}

function isValidFormatEmail() : bool {
    $email = $_POST["email"];
    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";

    if (preg_match($pattern, $email)) {
        return true;
    }
    else {
        var_dump("Veuillez entre un mail valide ! ");
        return false;
    }

}

function createUser() : void {

    $conn = getDbConnection();
    $fullName = $_POST["name"] ;
    $email = $_POST["email"];
    $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (email, password, fullname) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query); // stmt est l'objet "statement"
    $stmt->bind_param('sss', $email, $hashed_password, $fullName);
    $stmt->execute();
    redirect("login.php");


}

function validateRegistration(): void {
    $errors = isRegisterFormEmpty();

    if (empty($errors) && !isRegisterConfirmPasswordSameAsPassword()) {
        $errors[] = "Les mots de passe ne correspondent pas";
    }

    if (empty($errors) && isValidFormatEmail()) {
        // Inscription réussi
        createUser();
        echo json_encode(["success" => true, "message" => "Inscription réussi"]);
    }
    else {
      // Erreurs de validation
        echo json_encode(["success" => false, "errors" => $errors]);

    }
}

// Point entrée
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    validateRegistration();
}

