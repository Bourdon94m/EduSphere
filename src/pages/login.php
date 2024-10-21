<?php
define('BASE_PATH', dirname(__DIR__, 2));
define('BASE_URL', '/EduSphere');

$page_title = "Connexion - EduSphère";

require_once BASE_PATH . '/src/includes/header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>

    <script src="https://cdn.tailwindcss.com"></script>

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
                    <h2 class="text-2xl font-bold">Connexion</h2>
                </div>
                <form id="loginForm" class="py-4 px-6">
                    <div class="mb-4">
                        <label for="email" class="block mb-2 font-bold">Adresse email</label>
                        <input type="email" id="email" name="email" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-primary">
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block mb-2 font-bold">Mot de passe</label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-primary">
                    </div>
                    <div id="errorMessage" class="mb-4 text-red-500 hidden"></div>
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox text-primary">
                            <span class="ml-2">Se souvenir de moi</span>
                        </label>
                        <a href="/EduSphere/src/pages/request_reset.php" class="text-primary hover:underline">Mot de passe oublié?</a>
                    </div>
                    <button type="submit"
                            class="w-full bg-primary text-background font-bold py-2 px-4 rounded-md hover:bg-opacity-90 transition duration-300">
                        Se connecter
                    </button>
                </form>
                <div class="bg-gray-100 py-4 px-6 text-center">
                    <p>Pas encore de compte? <a href="register.php" class="text-primary hover:underline">S'inscrire</a></p>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginForm = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const errorMessage = document.getElementById('errorMessage');

        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(loginForm);

            fetch('<?php echo BASE_URL ?>/src/Validators/LoginValidator.php', {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Identifiants Incorrect !');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        window.location.href = '<?php echo BASE_URL ?>/src/index.php';
                    } else {
                        throw new Error(data.message);
                    }
                })
                .catch(error => {
                    errorMessage.textContent = error.message || 'Une erreur est survenue lors de la connexion.';
                    errorMessage.classList.remove('hidden');
                    emailInput.style.borderColor = 'red';
                    passwordInput.style.borderColor = 'red';
                });
        });
    });
</script>

</body>
</html>