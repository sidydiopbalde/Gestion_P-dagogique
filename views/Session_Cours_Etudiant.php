<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier des Sessions</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .event-yellow {
            background-color: #fef08a; /* Jaune clair */
            color: black;
            padding: 5px;
            margin: 2px 0;
            cursor: pointer;
        }
        .event-red {
            background-color: #f87171; /* Rouge clair */
            color: white;
            padding: 5px;
            margin: 2px 0;
        }
        .event-green {
            background-color: #86efac; /* Vert clair */
            color: black;
            padding: 5px;
            margin: 2px 0;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-4">
            <button class="bg-blue-500 text-white px-4 py-2 rounded"><a href="listeCoursEtudiant">Retour à la liste</a></button>
            <div class="text-center">
                <button class="bg-blue-500 text-white px-4 py-2 rounded mr-2" onclick="prevMonth()">Mois Précédent</button>
                <span id="monthYear" class="text-2xl font-bold">Juillet 2024</span>
                <button class="bg-blue-500 text-white px-4 py-2 rounded ml-2" onclick="nextMonth()">Mois Suivant</button>
            </div>
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
            function displayCalendar($sessions, $month, $year) {
                $firstDayOfMonth = strtotime("$year-$month-01");
                $lastDayOfMonth = strtotime(date("Y-m-t", $firstDayOfMonth));

                for ($day = $firstDayOfMonth; $day <= $lastDayOfMonth; $day = strtotime("+1 day", $day)) {
                    $weekDay = date("N", $day); 
                    $dayOfMonth = date("j", $day);
                    $formattedDate = date("Y-m-d", $day);
                    
                    echo '<div class="border p-2">';
                    echo "<div class='font-bold'>$dayOfMonth</div>";

                    foreach ($sessions as $session) {
                        if ($session->date == $formattedDate) {
                            $eventClass = '';
                            if ($session->statut == 'non effectue') {
                                $eventClass = 'event-yellow';
                            } elseif ($session->statut == 'annulle') {
                                $eventClass = 'event-red';
                            } elseif ($session->statut == 'termine') {
                                $eventClass = 'event-green';
                            }
                            $sessionStartTime = "{$session->date} {$session->heureDebut}";
                           
                            echo "<div class='$eventClass' onclick='openPopup({$session->id}, \"$sessionStartTime\", \"{$session->statut}\")'>($session->module )<br>{$session->mode} <br>({$session->heureDebut} - {$session->heureFin})</div>";
                        }
                    }
                    
                    echo '</div>';
                }
            }

            displayCalendar($sessions, 7, 2024);
            ?>
        </div>
    </div>

    <!-- Popup Modal -->
    <div id="popup" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded">
            <h2 class="text-xl font-bold mb-4">Confirmer votre présence</h2>
            <p id="popupMessage" class="mb-4">Voulez-vous vraiment confirmer votre présence à cette session ?</p>
            <form id="confirmPresence" method="POST" action="SessionEtudiant">
                <input type="hidden" name="Id_Confirm_Presence" id="idSession">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mr-2">Confirmer</button>
                <button type="button" onclick="closePopup()" class="bg-gray-500 text-white px-4 py-2 rounded">Annuler</button>
            </form>
        </div>
    </div>

    <!-- Include moment.js for date manipulation -->
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>

    <script>
        function openPopup(sessionId, sessionTime, statut) {
            if (statut === 'non effectue') {
              
                const sessionStartTime = moment(sessionTime);
                const currentTime = moment();
                if (currentTime.diff(sessionStartTime, 'minutes') >= 30) {
                    document.getElementById('idSession').value = sessionId;
                    document.getElementById('popup').classList.remove('hidden');
                } else {
                    alert("Vous ne pouvez confirmer votre présence qu'après 30 minutes de début de la session.");
                }
            }
        }

        function closePopup() {
            document.getElementById('popup').classList.add('hidden');
        }

        const monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
        let currentMonth = 6;
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
