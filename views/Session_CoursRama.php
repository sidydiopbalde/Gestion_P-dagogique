<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des Sessions</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .event {
            background-color: #f87171; /* Light red */
            color: white;
            padding: 5px;
            margin: 2px 0;
        }
        .event-blue {
            background-color: #60a5fa; /* Light blue */
            color: white;
            padding: 5px;
            margin: 2px 0;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-4">
            <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="prevYear()">Année Précédente</button>
            <div class="text-center">
                <button class="bg-blue-500 text-white px-4 py-2 rounded mr-2" onclick="prevMonth()">Mois Précédent</button>
                <span id="monthYear" class="text-2xl font-bold">Juillet 2024</span>
                <button class="bg-blue-500 text-white px-4 py-2 rounded ml-2" onclick="nextMonth()">Mois Suivant</button>
            </div>
            <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="nextYear()">Année Suivante</button>
        </div>
        <div class="grid grid-cols-7 gap-4">
            <div class="text-center font-bold">Lundi</div>
            <div class="text-center font-bold">Mardi</div>
            <div class="text-center font-bold">Mercredi</div>
            <div class="text-center font-bold">Jeudi</div>
            <div class="text-center font-bold">Vendredi</div>
            <div class="text-center font-bold">Samedi</div>
            <div class="text-center font-bold">Dimanche</div>

            <?php
            // Simuler des sessions récupérées depuis la base de données
            $sessions = [
                (object)[
                    'id' => 1,
                    'date' => '2024-07-22',
                    'heureDebut' => '08:00:00',
                    'heureFin' => '10:30:00',
                    'statut' => 'non effectue',
                    'mode' => 'en presentiel',
                    'titre' => 'Algebre'
                ],
                (object)[
                    'id' => 2,
                    'date' => '2024-07-23',
                    'heureDebut' => '10:00:00',
                    'heureFin' => '12:30:00',
                    'statut' => 'non effectue',
                    'mode' => 'en presentiel',
                    'titre' => 'Algorithme'
                ]
            ];

            // Générer le calendrier avec les sessions
            for ($i = 1; $i <= 7; $i++) {
                for ($j = 0; $j < 3; $j++) {
                    $startHour = $j * 2 + 8;
                    $endHour = $startHour + 2;
                    $session = null;

                    foreach ($sessions as $s) {
                        if (date('N', strtotime($s->date)) == $i && date('H', strtotime($s->heureDebut)) == $startHour) {
                            $session = $s;
                            break;
                        }
                    }

                    echo '<div class="border p-2">';
                    if ($session) {
                        $eventClass = $session->statut == 'non effectue' ? 'event' : 'event-blue';
                        echo "<div class='$eventClass'>{$session->titre}</div>";
                    } else {
                        echo "$startHour H00 - $endHour H00";
                    }
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>

    <script>
        const monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
        let currentMonth = 6; // Juillet est le 6ème index
        let currentYear = 2024;

        function updateMonthYear() {
            document.getElementById('monthYear').textContent = `${monthNames[currentMonth]} ${currentYear}`;
        }

        function prevMonth() {
            if (currentMonth === 0) {
                currentMonth = 11;
                currentYear--;
            } else {
                currentMonth--;
            }
            updateMonthYear();
        }

        function nextMonth() {
            if (currentMonth === 11) {
                currentMonth = 0;
                currentYear++;
            } else {
                currentMonth++;
            }
            updateMonthYear();
        }

        function prevYear() {
            currentYear--;
            updateMonthYear();
        }

        function nextYear() {
            currentYear++;
            updateMonthYear();
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateMonthYear();
        });
    </script>
</body>
</html>
