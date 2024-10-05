<?php
// Définition du chemin de base
define('BASE_PATH', dirname(__DIR__, 2));
const BASE_URL = '/EduSphere';

$page_title = "Inscription - EduSphere";

// Inclusion du header
require_once BASE_PATH . '/src/includes/header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Configuration des couleurs personnalisées -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'text': '#1f0717',
                        'background': '#fdf6fb',
                        'primary': '#d42e91',
                        'secondary': '#e6aa88',
                        'accent': '#deb062',
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-background text-text">
<header class="bg-background shadow-md">
    <!-- Contenu du header -->
</header>

<main class="bg-background text-text">
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-primary text-background py-4 px-6">
                    <h2 class="text-2xl font-bold">Inscription</h2>
                </div>
                <form method="post" action="<?php echo BASE_URL ?> /src/Validators/RegistrationValidator.php" class="py-4 px-6">
                    <div class="mb-4">
                        <label for="name" class="block mb-2 font-bold">Nom complet</label>
                        <input type="text" id="name" name="name" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-primary">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block mb-2 font-bold">Adresse email</label>
                        <input type="email" id="email" name="email" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-primary">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block mb-2 font-bold">Mot de passe</label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-primary">
                    </div>
                    <div class="mb-6">
                        <label for="confirm_password" class="block mb-2 font-bold">Confirmer le mot de passe</label>
                        <input type="password" id="confirm_password" name="confirm_password" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-primary">
                    </div>
                    <div class="flex items-center mb-6">
                        <input type="checkbox" id="terms" name="terms" required class="form-checkbox text-primary">
                        <label for="terms" class="ml-2">J'accepte les <a href="#" class="text-primary hover:underline">conditions d'utilisation</a></label>
                    </div>
                    <button type="submit"
                            class="w-full bg-primary text-background font-bold py-2 px-4 rounded-md hover:bg-opacity-90 transition duration-300">
                        S'inscrire
                    </button>
                </form>
                <div class="bg-gray-100 py-4 px-6 text-center">
                    <p>Déjà un compte? <a href="login.php" class="text-primary hover:underline">Se connecter</a></p>
                </div>

            </div>
        </div>
    </section>
</main>

</body>
</html>