<?php
// Définition du chemin de base
define('BASE_PATH', dirname(__DIR__, 2));
define('BASE_URL', '/ÉduSphère');

$page_title = "Accueil - EduSphère";

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
    <!-- Hero Section -->
    <section class="bg-primary text-background py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">
                <h1 class="text-4xl font-bold mb-4">Développez vos compétences avec EduSphère</h1>
                <p class="text-xl mb-8">Découvrez nos formations en ligne et boostez votre carrière</p>
                <a href="#" class="bg-accent text-text font-bold py-2 px-6 rounded-full hover:bg-opacity-90 transition duration-300">
                    Voir les formations
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Courses -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8 text-center">Formations populaires</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                $featured_courses = [
                    ['title' => 'Développement Web Full Stack', 'price' => 299, 'image' => 'web-dev.jpg'],
                    ['title' => 'Marketing Digital Avancé', 'price' => 199, 'image' => 'marketing.jpg'],
                    ['title' => 'Data Science et Machine Learning', 'price' => 349, 'image' => 'data-science.jpg'],

                ];

                foreach ($featured_courses as $course) :
                    ?>
                    <div class="bg-background rounded-lg shadow-md overflow-hidden">
                        <img src="<?php echo BASE_URL; ?>/public/images/<?php echo htmlspecialchars($course['image']); ?>" alt="<?php echo htmlspecialchars($course['title']); ?>" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-2"><?php echo htmlspecialchars($course['title']); ?></h3>
                            <p class="text-primary font-bold"><?php echo number_format($course['price'], 2); ?> €</p>
                            <a href="#" class="mt-4 inline-block bg-secondary text-text px-4 py-2 rounded hover:bg-opacity-90 transition duration-300">
                                En savoir plus
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="bg-secondary bg-opacity-20 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-8 text-center">Catégories de formations</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php
                $categories = ['Développement Web', 'Marketing Digital', 'Design', 'Business', 'Data Science', 'Langues', 'Photographie', 'Musique'];
                foreach ($categories as $category) :
                    ?>
                    <a href="#" class="bg-background rounded-lg p-4 text-center hover:shadow-md transition duration-300">
                        <span class="font-semibold"><?php echo htmlspecialchars($category); ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-accent py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4 text-text">Prêt à commencer votre parcours d'apprentissage ?</h2>
            <p class="text-xl mb-8 text-text">Inscrivez-vous dès maintenant et bénéficiez de 20% de réduction sur votre première formation !</p>
            <a href="/ÉduSphère/src/pages/register.php" class="bg-primary text-background font-bold py-3 px-8 rounded-full hover:bg-opacity-90 transition duration-300">
                S'inscrire maintenant
            </a>
        </div>
    </section>
</main>

</body>
</html>