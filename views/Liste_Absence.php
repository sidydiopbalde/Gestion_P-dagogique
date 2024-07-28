<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Pédagogique</title>
    <link rel="stylesheet" href="css/fontawesome-all.min.css"> <!-- Lien local vers Font Awesome -->
    <link rel="stylesheet" href="css/tailwind.min.css"> <!-- Lien local vers Tailwind CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM5UtaG9QLC4rAoVrYjzvMT6i8lBgtLcuJkzIC6" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Ajoutez des styles personnalisés ici si nécessaire */
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="flex flex-col h-screen">
        <header class="bg-gray-900 text-white p-4 flex justify-between shadow-md">
            <div>
                <h1 class="text-lg font-bold">Gestion Pédagogique</h1>
                <p>Etudiant: Sidy Diop Balde | Prof: Sidy Diop | Niveau: Licence 2 Info</p>
            </div>
            <nav class="flex space-x-4">
                <a href="#" class="hover:text-gray-400 transition duration-300">Accueil</a>
                <a href="listeCoursEtudiant" class="hover:text-gray-400 transition duration-300">Cours</a>
                <a href="SessionEtudiant" class="hover:text-gray-400 transition duration-300">Sessions</a>
                <a href="#" class="hover:text-gray-400 transition duration-300">Modules</a>
                <a href="#" class="hover:text-gray-400 transition duration-300">Logout</a>
            </nav>
        </header>

        <div class="flex flex-grow">
            <aside class="w-1/5 bg-gray-200 p-4 shadow-md">
                <ul class="space-y-2">
                    <li><a href="#" class="block p-2 bg-gray-300 rounded hover:bg-gray-400 transition duration-300 shadow-sm hover:shadow-md">Tableau de bord</a></li>
                    <li><a href="ListeCoursEtudiant" class="block p-2 bg-gray-300 rounded hover:bg-gray-400 transition duration-300 shadow-sm hover:shadow-md">Cours</a></li>
                    <li><a href="SessionEtudiant" class="block p-2 bg-gray-300 rounded hover:bg-gray-400 transition duration-300 shadow-sm hover:shadow-md">Mes sessions</a></li>
                    <li><a href="#" class="block p-2 bg-gray-300 rounded hover:bg-gray-400 transition duration-300 shadow-sm hover:shadow-md">Semestres</a></li>
                    <li><a href="#" class="block p-2 bg-gray-300 rounded hover:bg-gray-400 transition duration-300 shadow-sm hover:shadow-md">Classes</a></li>
                </ul>
            </aside>

            <main class="flex-grow p-6">
                <h2 class="text-2xl font-bold mb-4">Liste de mes ABSENCES</h2>
                <table class="w-full bg-white rounded-lg shadow-md overflow-hidden">
                    <thead class="bg-gray-700 text-white">
                        <tr>
                            <th class="py-2 px-4">Date</th>
                            <th class="py-2 px-4">Session</th>
                            <th class="py-2 px-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($absences)): ?>
                            <?php foreach ($absences as $abs): ?>
                            <tr class="bg-gray-100 transition duration-300 hover:bg-gray-200">
                                <td class="py-2 px-4"><?= htmlspecialchars($abs->getDate() ?? '') ?></td>
                                <td class="py-2 px-4"><?= htmlspecialchars($abs->getModule() ?? '') ?></td>
                                <td class="py-2 px-4">
                                    <button value="<?= htmlspecialchars($abs->getId() ?? '') ?>" class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-700 transition duration-300 shadow-sm hover:shadow-md" onclick="openPopup(<?= htmlspecialchars($abs->getId() ?? '') ?>)">
                                        <i class="fas fa-check"></i> Justifier
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="3" class="py-2 px-4 text-center">Aucune absence.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="flex justify-between mt-4">
                    <button class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-1 px-4 rounded transition duration-300 shadow-sm hover:shadow-md">
                        <i class="fas fa-chevron-left"></i> Précédent
                    </button>
                    <div class="flex space-x-2">
                        <button class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-1 px-4 rounded transition duration-300 shadow-sm hover:shadow-md">1</button>
                        <button class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-1 px-4 rounded transition duration-300 shadow-sm hover:shadow-md">2</button>
                    </div>
                    <button class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-1 px-4 rounded transition duration-300 shadow-sm hover:shadow-md">
                        <i class="fas fa-chevron-right"></i> Suivant
                    </button>
                </div>
            </main>
        </div>
    </div>

    <!-- Popup Modal -->
    <div id="popup" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden fade-in">
        <div class="bg-white p-6 rounded shadow-lg w-1/3">
            <h3 class="text-xl font-bold mb-4">Justifier l'absence</h3>
            <form id="cancelForm" method="POST" action="AbsenceEtudiant">
                <label for="motif" class="block mb-2">Motif</label>
                <textarea name="motif" class="w-full p-2 border rounded mb-4" rows="4" placeholder="Entrez votre justification ici..."></textarea>
                <label for="piece" class="block mb-2">Pièce justificative</label>
                <input type="text" name="piece" id="piece" class="w-full p-2 border rounded mb-4">
                <input type="hidden" name="idSession" id="idSession">
                <div class="flex justify-end space-x-2">
                    <button type="button" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700 transition duration-300 shadow-sm hover:shadow-md" onclick="closePopup()">Annuler</button>
                    <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700 transition duration-300 shadow-sm hover:shadow-md">Envoyer</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openPopup(id) {
            document.getElementById('idSession').value = id;
            document.getElementById('popup').classList.remove('hidden');
        }

        function closePopup() {
            document.getElementById('popup').classList.add('hidden');
        }
    </script>

</body>
</html>
