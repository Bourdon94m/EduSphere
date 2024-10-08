<?php
// formation.php
define('BASE_PATH', dirname(__DIR__, 2));
require_once BASE_PATH . '/src/config.php';
require_once BASE_PATH . '/src/includes/header.php';

// Formation récupérée par son id
$formation_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$formation = getFormationById(getDbConnection(), $formation_id);

// Vérifier si la formation existe
if ($formation === null) {
    echo "Formation non trouvée !";
    exit(); // Arrêter l'exécution du script
}

$actual_price = intval($formation['price']);
$old_price = $actual_price + 20.99;

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($formation['name']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<main class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row">
        <!-- Colonne de gauche - Détails de la formation -->
        <div class="md:w-2/3 pr-8">
            <h1 class="text-3xl font-bold mb-4"><?= htmlspecialchars($formation['name']) ?></h1>
            <p class="text-gray-600 mb-6">Maîtrisez les technologies web modernes et devenez un développeur full-stack accompli</p>

            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Ce que vous apprendrez</h2>
                <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <li class="flex items-start">
                        <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                        <span>Maîtriser HTML5, CSS3 et JavaScript ES6+</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                        <span>Développer des applications React et Node.js</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                        <span>Utiliser des bases de données SQL et NoSQL</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
                        <span>Déployer des applications sur le cloud</span>
                    </li>
                </ul>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Description complète de la formation</h2>
                <div class="space-y-4 text-gray-700">
                    <?= htmlspecialchars($formation['description']) ?>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Contenu du cours</h2>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="font-medium">Section 1: Introduction au développement web</span>
                        <span class="text-gray-500">3 heures</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-medium">Section 2: HTML5 et CSS3 avancés</span>
                        <span class="text-gray-500">5 heures</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-medium">Section 3: JavaScript moderne et ES6+</span>
                        <span class="text-gray-500">8 heures</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-medium">Section 4: React.js et Redux</span>
                        <span class="text-gray-500">10 heures</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-medium">Section 5: Node.js et Express</span>
                        <span class="text-gray-500">8 heures</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Colonne de droite - Carte d'achat -->
        <div class="md:w-1/3">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-6">
                <img src="<?= htmlspecialchars($formation['image_url']) ?>" alt="Aperçu de la formation" class="w-full rounded-lg mb-4">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-3xl font-bold"><?= htmlspecialchars($formation['price'])?>€</span>
                    <span class="text-lg text-gray-500 line-through"><?= $old_price?>€</span>
                </div>
                <?php if (isLoggedIn()): ?>
                    <button class="w-full bg-purple-600 text-white py-3 rounded-lg font-semibold mb-3 hover:bg-purple-700 transition">Acheter maintenant</button>
                    <form method="POST" action="/EduSphere/src/pages/panier.php">
                        <input type="hidden" name="action" value="ajouter">
                        <input type="hidden" name="id" value="<?= $formation['id'] ?>">
                        <input type="hidden" name="nom" value="<?= htmlspecialchars($formation['name']) ?>">
                        <input type="hidden" name="prix" value="<?= $formation['price'] ?>">
                        <input type="hidden" name="quantite" value="1">
                        <button type="submit" class="w-full bg-blue-700 text-white py-3 rounded-lg font-semibold mb-3 transition">Ajouter au panier</button>
                    </form>
                <?php else: ?>
                    <a href="login.php" class="bg-[#d42e91] text-white px-4 p-2 rounded hover:bg-[#deb062] transition">Me connecter</a>
                <?php endif; ?>
                <br><br>
                <ul class="space-y-2 text-sm ">
                    <li class="flex items-center">
                        <i class="fas fa-infinity mr-2 text-gray-600"></i>
                        <span>Accès à vie</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-mobile-alt mr-2 text-gray-600"></i>
                        <span>Accès sur mobile et TV</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-certificate mr-2 text-gray-600"></i>
                        <span>Certificat d'achèvement</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <?php require_once BASE_PATH . '/src/includes/footer.php'; ?>

</main>
</body>
</html>