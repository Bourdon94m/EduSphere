<?php
// panier.php
session_start();
function addToCart($id, $name, $price, $quantity = 1): void
{
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }

    if (isset($_SESSION['panier'][$id])) {
        $_SESSION['panier'][$id]['quantite'] += $quantity;
    } else {
        $_SESSION['panier'][$id] = array(
            'nom' => $name,
            'prix' => $price,
            'quantite' => $quantity
        );
    }
}

// Traitement de l'ajout au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'ajouter') {
    addToCart($_POST['id'], $_POST['nom'], $_POST['prix'], $_POST['quantite']);
    // Rediriger vers la page du panier après l'ajout
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Calculer le total du panier
$total = 0;
if (isset($_SESSION['panier'])) {
    foreach ($_SESSION['panier'] as $item) {
        $total += $item['prix'] * $item['quantite'];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Panier</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-100 py-8">
<div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="px-4 py-5 sm:px-6">
        <h1 class="text-2xl font-semibold text-gray-900">Votre Panier</h1>
    </div>
    <div class="border-t border-gray-200">
        <ul class="divide-y divide-gray-200">
            <?php if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])): ?>
                <?php foreach ($_SESSION['panier'] as $id => $item): ?>
                    <li class="flex py-6 px-4">
                        <div class="flex flex-col flex-grow">
                            <h2 class="text-lg font-medium text-gray-900"><?= htmlspecialchars($item['nom']) ?></h2>
                            <p class="mt-1 text-sm text-gray-500"><?= number_format($item['prix'], 2) ?> €</p>
                            <div class="mt-2 flex items-center">
                                <span class="mx-2 text-gray-700">Quantité: <?= $item['quantite'] ?></span>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <p class="text-lg font-medium text-gray-900"><?= number_format($item['prix'] * $item['quantite'], 2) ?> €</p>
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="py-6 px-4 text-center text-gray-500">Votre panier est vide</li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="px-4 py-5 sm:px-6">
        <div class="flex justify-between text-lg font-medium text-gray-900">
            <p>Total</p>
            <p><?= number_format($total, 2) ?> €</p>
        </div>
        <?php if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])): ?>
            <button class="mt-4 w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Passer à la caisse
            </button>
        <?php endif; ?>
    </div>
</div>
</body>
</html>