<?php
    define('BASE_PATH', dirname(__DIR__, 2));
    require_once BASE_PATH . '/src/config.php';

    // Connexion à la base de données
    $conn = getDbConnection();

    $message = '';

    // Vérification du token
    if (!isset($_GET['token'])) {
        die('Token manquant. Veuillez utiliser le lien fourni dans l\'email.');
    }

    $token = $conn->real_escape_string($_GET['token']);

    // Vérification de la validité du token
    $stmt = $conn->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_token_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die('Ce lien de réinitialisation est invalide ou a expiré.');
    }

    // Traitement du formulaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newPassword = $_POST['new-password'];
        $confirmPassword = $_POST['confirm-password'];

        if ($newPassword === $confirmPassword) {
            $user = $result->fetch_assoc();
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE id = ?");
            $stmt->bind_param("si", $hashedPassword, $user['id']);
            $stmt->execute();

            $message = "Votre mot de passe a été réinitialisé avec succès.";
        } else {
            $message = "Les mots de passe ne correspondent pas.";
        }
    }

    $conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
<div class="bg-white p-8 rounded-lg shadow-md w-96">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Réinitialisation du mot de passe</h2>
    <?php if ($message): ?>
        <p class="mb-4 text-center <?php echo strpos($message, 'succès') !== false ? 'text-green-600' : 'text-red-600'; ?>"><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="POST">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <div class="mb-4">
            <label for="new-password" class="block text-sm font-medium text-gray-700 mb-2">Nouveau mot de passe</label>
            <input type="password" id="new-password" name="new-password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-6">
            <label for="confirm-password" class="block text-sm font-medium text-gray-700 mb-2">Confirmez le mot de passe</label>
            <input type="password" id="confirm-password" name="confirm-password" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Réinitialiser le mot de passe
        </button>
    </form>
</div>
</body>
</html>