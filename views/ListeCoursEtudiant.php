<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Pédagogique</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM5UtaG9QLC4rAoVrYjzvMT6i8lBgtLcuJkzIC6" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<nav class="bg-gray-800 p-4">
    <div class="container mx-auto">
        <div class="flex items-center justify-between">
            <a href="#" class="text-white text-xl font-semibold">Gestion Pédagogique</a>
            <?php if ($cours) : ?>
            <a href="#" class="text-white text-lg font-medium">Etudiant: <?= $cours[0]->getNom() ?? ""?> <?= $cours[0]->getPrenom() ?? "" ?></a>
            <?php endif;?>
            <div class="flex items-center space-x-4">
                <a href="#" class="text-gray-300 hover:text-white transition duration-200">Accueil</a>
                <a href="#" class="text-gray-300 hover:text-white transition duration-200">Cours</a>
                <a href="#" class="text-gray-300 hover:text-white transition duration-200">Modules</a>
                <a href="login" class="flex items-center text-gray-300 hover:text-white transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#BB271A" class="mr-2"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
                    Logout
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="flex">
    <!-- Sidebar -->
    <div class="w-1/4 bg-white p-4">
        <ul>
            <li class="mb-2"><a href="#" class="text-gray-500">Tableau de Bord</a></li>
            <li class="mb-2"><a href="ListeCoursEtudiant" class="text-gray-500">Cours</a></li>
            <li class="mb-2"><a href="SessionEtudiant" class="text-gray-500">Mes Sessions</a></li>
            <li class="mb-2"><a href="AbsenceEtudiant" class="text-gray-500">Mes Absences</a></li>
            <li class="mb-2"><a href="#" class="text-gray-500">Classes</a></li>
        </ul>
    </div>
    <!-- Main content -->
    <div class="w-3/4 p-4">
        <h2 class="text-2xl font-semibold mb-4">Liste des Cours</h2>

       <!-- Formulaires de filtrage -->
       <form method="POST" action="listeCoursEtudiant" class="mb-4 flex space-x-4">
            <div>
                <input type="text" name="filterModule" value="" placeholder="Filtrer par module" class="p-2 border rounded">
                <!-- <button type="submit"  class="bg-blue-500 text-white px-4 py-2 rounded">Filtrer</button> -->
            </div>
            <div>
                <input type="text" name="filterSemestre" value="" placeholder="Filtrer par semestre" class="p-2 border rounded">
                <button type="submit"  class="bg-gray-800 text-white px-4 py-2 rounded">Filtrer</button>
            </div>
        </form>

        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200">Module</th>
                    <th class="py-2 px-4 border-b border-gray-200">Nombre d'heure</th>
                    <th class="py-2 px-4 border-b border-gray-200">Semestre</th>
                    <th class="py-2 px-4 border-b border-gray-200">Classes</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($cours)):?>
                <?php foreach ($cours as $entity): ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?= $entity->getModule() ?? '' ?></td>
                        <td class="py-2 px-4 border-b"><?= $entity->getNombreHeure() ?? '' ?></td>
                        <td class="py-2 px-4 border-b"><?= $entity->getSemestre() ?? '' ?></td>
                        <td class="py-2 px-4 border-b"><?= $entity->getClasse() ?? '' ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="py-2 px-4 text-center">Aucun cours programmé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination Controls -->
        <div class="mt-4 flex justify-center items-center space-x-2">
            <?php if ($currentPage):?>
            <?php if ($currentPage > 1): ?>
                <a href="?page=<?= $currentPage - 1 ?>" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-200">Précédent</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" class="px-4 py-2 border <?= $i == $currentPage ? 'border-blue-500 text-white bg-gray-500' : 'border-gray-300 text-gray-500 hover:bg-gray-200' ?> rounded-lg"><?= $i ?></a>
            <?php endfor; ?>
            <?php if ($currentPage < $totalPages): ?>
                <a href="?page=<?= $currentPage + 1 ?>" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-200">Suivant</a>
            <?php endif; ?>
            <?php endif;?>
        </div>
    </div>
</div>

</body>
</html>
