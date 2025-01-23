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
    <div class="container mx-auto px-4 py-6">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <a href="/EduSphereV2/src/index.php" class="text-primary text-3xl font-bold flex-shrink-0">EduSphère</a>

            <!-- Barre de recherche -->
            <div class="flex-1 max-w-2xl mx-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="search"
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-primary focus:border-transparent text-sm"
                           placeholder="Rechercher des cours, formations...">
                </div>
            </div>

            <!-- Menu Navigation -->
            <nav class="flex-shrink-0">
                <ul class="flex items-center space-x-6">
                    <li>
                        <a href="/EduSphereV2/src/pages/panier.php" class="text-text hover:text-primary transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </a>
                    </li>

                    <?php if (isLoggedIn()): ?>
                        <li>
                            <a href="pages/mon-compte.php" class="bg-primary text-background px-4 py-2 rounded-full hover:bg-opacity-90 transition duration-300">
                                Mon Compte
                            </a>
                        </li>
                        <li>
                            <a href="/EduSphereV2/src/Validators/Logout.php" class="text-primary hover:text-secondary transition duration-300">
                                Déconnexion
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="pages/login.php" class="bg-primary text-background px-4 py-2 rounded-full hover:bg-opacity-90 transition duration-300">
                                Connexion
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</header>

</body>
</html>