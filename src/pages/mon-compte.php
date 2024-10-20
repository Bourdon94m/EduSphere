<?php
    session_start();
    // Définir le chemin de base
    define('BASE_PATH', dirname(__DIR__, 2));
    require_once BASE_PATH . '/src/config.php';
    require_once BASE_PATH . '/src/includes/header.php';

    // Connexion a la db
    $conn = getDbConnection();

    // Prépare la requete
    $stmt = $conn->prepare("SELECT fullname,email FROM users WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();

    // Récupere le résultat
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();



?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte - E-commerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
<main class="container mx-auto px-4 py-8 space-y-8">
    <!-- Informations personnelles -->
    <section class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold mb-4">Informations personnelles</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="font-medium">Nom</p>
                <p> <?php echo htmlspecialchars($user['fullname'])?>  </p>
            </div>
            <div>
                <p class="font-medium">Email</p>
                <p><?php echo htmlspecialchars($user['email'])?> </p>
            </div>

        </div>
        <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Modifier</button>
    </section>

    <!-- Adresses -->
    <section class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold mb-4">Adresses</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="font-medium text-lg mb-2">Adresse de livraison</h3>
                <p>123 Rue de la Paix</p>
                <p>75000 Paris</p>
                <p>France</p>
            </div>
            <div>
                <h3 class="font-medium text-lg mb-2">Adresse de facturation</h3>
                <p>456 Avenue des Champs-Élysées</p>
                <p>75008 Paris</p>
                <p>France</p>
            </div>
        </div>
        <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Gérer les adresses</button>
    </section>

    <!-- Commandes récentes -->
    <section class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold mb-4">Commandes récentes</h2>
        <div class="space-y-4">
            <div class="border-b pb-4">
                <p class="font-medium">Commande #12345</p>
                <p class="text-sm text-gray-600">Date : 15/10/2024</p>
                <p class="text-sm text-green-600">Statut : Livré</p>
            </div>
            <div class="border-b pb-4">
                <p class="font-medium">Commande #12344</p>
                <p class="text-sm text-gray-600">Date : 02/10/2024</p>
                <p class="text-sm text-orange-600">Statut : En cours</p>
            </div>
        </div>
        <a href="#" class="mt-4 inline-block text-blue-500 hover:underline">Voir toutes les commandes</a>
    </section>

    <?php require_once BASE_PATH . '/src/includes/footer.php'; ?>



</main>

</body>
</html>