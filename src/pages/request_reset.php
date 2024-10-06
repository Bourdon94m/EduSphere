<?php
    define('BASE_PATH', dirname(__DIR__, 2));
    require_once BASE_PATH . '/src/config.php';
    // Connexion a la DB
    $conn = getDbConnection();

    $message = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = $conn->real_escape_string($_POST['email']);

        //Vérifie si l'email existe dans la base de données
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Génere un token
            $token = bin2hex(random_bytes(32));
            $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

            //Mettre a jour la table users avec le nouveau token
            $stmt = $conn->prepare("UPDATE users set reset_token = ?, reset_token_expiry = ? WHERE email = ?");
            $stmt->bind_param("sss", $token, $expiry, $email);
            $stmt->execute();

            // Préparer l'email
            $resetLink = "http://127.0.0.1/EduSphere/src/pages/reset_password.php?token=" .$token;
            $to = $email;
            $subject = "Réinitialisation de votre mot de passe";
            $message_body = "Bonjour,\n\nVous avez demandé à réinitialiser votre mot de passe. Veuillez cliquer sur le lien suivant pour procéder :\n\n$resetLink\n\nCe lien expirera dans 1 heure.\n\nSi vous n'avez pas demandé cette réinitialisation, veuillez ignorer cet email.\n\nCordialement,\nL'équipe de votre site";


            // Envoie de l'email
            if (sendEmail($to, $subject, $message_body, $resetLink)) {
                $message = "Si un compte existe avec cet addresse email, un lien de réinitialisation a été envoyé.";
            } else {
                $message = "Une erreur s'est produite lors de l'envoie de l'email. Veuillez réesayer plus tard.";
            }

        } else {
            // Meme message que si l'email a été envoyé pour des raisons de sécurité
            $message = "Si un compte existe avec cet addresse email, un lien de réinitialisation a été envoyé.";
        }
    }

    $conn->close()
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de réinitialisation du mot de passe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
<div class="bg-white p-8 rounded-lg shadow-md w-96">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Réinitialisation du mot de passe</h2>
    <?php if ($message): ?>
        <p class="mb-4 text-center text-green-600"><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Adresse email</label>
            <input type="email" id="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            Envoyer le lien de réinitialisation
        </button>
    </form>
</div>
</body>
</html>