<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    require_once(__DIR__ . '/../config.php');
?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="/src/images/shortcut_icon.png" />
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
    <title><?=$pageTitle ?? 'EduSphère' ?></title>
</head>
<body class="bg-background text-text">
<header class="bg-background shadow-md">
    <div class="container mx-auto px-4 py-6 flex items-center justify-between">
        <a href="/EduSphere/src/index.php" class="text-primary text-3xl font-bold">EduSphère</a>
        <nav>
            <ul class="flex items-center space-x-6">
                <li>
                    <a href="/panier" class="text-text hover:text-primary transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </a>
                </li>
                <?php
                // Assurez-vous que la fonction isLoggedIn() est définie ailleurs dans votre code
                if (isLoggedIn()) {
                    // L'utilisateur est connecté
                    ?>
                    <li>
                        <a href="pages/dashboard.php" class="bg-primary text-background px-4 py-2 rounded-full hover:bg-opacity-90 transition duration-300">
                            Mon Compte
                        </a>
                    </li>
                    <li>
                        <a href="/EduSphere/src/Validators/Logout.php" class="text-primary hover:text-secondary transition duration-300">
                            Déconnexion
                        </a>
                    </li>
                    <?php
                } else {
                    // L'utilisateur n'est pas connecté
                    ?>
                    <li>
                        <a href="pages/login.php" class="bg-primary text-background px-4 py-2 rounded-full hover:bg-opacity-90 transition duration-300">
                            Connexion
                        </a>
                    </li>
                    <?php
                }
                ?>

            </ul>
        </nav>
    </div>
</header>

</body>
</html>