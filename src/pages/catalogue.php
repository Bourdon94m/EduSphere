<?php

// Définir le chemin de base
define('BASE_PATH', dirname(__DIR__, 2));
require_once BASE_PATH . '/src/config.php';
require_once BASE_PATH . '/src/includes/header.php';


// Simulons une liste de formations
$all_products = getAllProducts(getDbConnection())

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue des formations en programmation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">



<header class="bg-blue-600 text-white p-4">
    <h1 class="text-3xl font-bold text-center">Nos formations en programmation</h1>
</header>


<main class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($all_products as $formation): ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="<?= htmlspecialchars($formation['image_url']) ?>"
                     alt="<?= htmlspecialchars($formation['name']) ?>"
                     class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2"><?= htmlspecialchars($formation['name']) ?></h2>
                    <p class="text-gray-600 mb-4">

                        <?= htmlspecialchars(truncateContent($formation['description'])) ?>
                    </p>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-blue-600"><?= number_format($formation['price'], 2) ?> €</span>
                        <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Acheter</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php require_once BASE_PATH . '/src/includes/footer.php'; ?>



</body>
</html>