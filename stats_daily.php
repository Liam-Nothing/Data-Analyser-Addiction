<?php
if (!isset($_COOKIE["user_session"]) || $_COOKIE["user_session"] !== "c88f4b1d-fa3a-49ea-a7aa-3f99e44cd487") {
    header("Location: login.php");
    exit;
}
?>
<?php
$file_path = 'logs.json';
$data = [];

if (file_exists($file_path)) {
    $data = json_decode(file_get_contents($file_path), true);
}

$dailyData = [];

if (is_array($data) && !empty($data)) {  // Ajoutez cette vérification ici
    foreach ($data as $log) {
        $date = date('Y-m-d', strtotime($log['date']));
        $function = 'Fonction: ' . $log['function'];

        if (!isset($dailyData[$date])) {
            $dailyData[$date] = [];
        }

        if (!isset($dailyData[$date][$function])) {
            $dailyData[$date][$function] = 0;
        }

        $dailyData[$date][$function]++;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Statistiques quotidiennes</title>
</head>

<body class="bg-pastelWhite p-4 md:p-6 lg:p-12">

    <h1 class="text-xl md:text-2xl mb-4 md:mb-6 text-pastelGray">Statistiques quotidiennes</h1>

    <?php if ($data): ?>
    <div class="w-full overflow-x-auto">
        <canvas id="dailyChart"></canvas>
    </div>

    <h1 class="text-2xl mb-6">Statistiques quotidiennes</h1>
<div class="mb-4">
    <button class="btn-filter bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-filter="semaine">Semaine</button>
    <button class="btn-filter bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-filter="mois">Mois</button>
    <button class="btn-filter bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-filter="annee">Année</button>
    <button class="btn-filter bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-filter="total">Total</button>
</div>


    <script>
document.addEventListener('DOMContentLoaded', function() {
    let dailyChart;
    const initialData = <?php echo json_encode($dailyData); ?>;

    function filterDataByPeriod(period) {
        const result = {};
        const now = new Date();

        for (const date in initialData) {
            const logDate = new Date(date);

            switch (period) {
                case 'semaine':
                    const oneWeekAgo = new Date();
                    oneWeekAgo.setDate(now.getDate() - 7);
                    if (logDate >= oneWeekAgo) {
                        result[date] = initialData[date];
                    }
                    break;
                case 'mois':
                    const oneMonthAgo = new Date();
                    oneMonthAgo.setMonth(now.getMonth() - 1);
                    if (logDate >= oneMonthAgo) {
                        result[date] = initialData[date];
                    }
                    break;
                case 'annee':
                    const oneYearAgo = new Date();
                    oneYearAgo.setFullYear(now.getFullYear() - 1);
                    if (logDate >= oneYearAgo) {
                        result[date] = initialData[date];
                    }
                    break;
                case 'total':
                    result[date] = initialData[date];
                    break;
            }
        }

        return result;
    }

    document.querySelectorAll('.btn-filter').forEach(button => {
        button.addEventListener('click', function() {
            const filterType = this.getAttribute('data-filter');
            const filteredData = filterDataByPeriod(filterType);

            // Mettre à jour le graphique avec les données filtrées
            updateChartWithData(filteredData);
        });
    });

    function updateChartWithData(data) {
        // Détruire le graphique existant si nécessaire
        if (dailyChart) {
            dailyChart.destroy();
        }

        const labels = Object.keys(data);
        const datasets = [];
        
        const functions = ['Fonction: 1', 'Fonction: 2', 'Fonction: 3', 'Fonction: 4', 'Fonction: 5', 'Fonction: 6', 'Fonction: 7', 'Fonction: 8', 'Fonction: 9'];
        const colors = ['#FF5733', '#3182CE', '#38A169', '#ECC94B', '#667EEA', '#ED64A6', '#A0AEC0', '#9F7AEA', '#4C51BF'];

        functions.forEach((fn, index) => {
            const fnData = labels.map(label => data[label][fn] || 0);
            if (Math.max(...fnData) > 0) { // Avoid adding datasets with all zeros
                datasets.push({
                    label: fn,
                    data: fnData,
                    fill: false,
                    borderColor: colors[index],
                    tension: 0.1
                });
            }
        });

        const ctx = document.getElementById('dailyChart').getContext('2d');
        dailyChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: datasets
            }
        });
    }

    // Initialiser le graphique au chargement de la page
    updateChartWithData(initialData);
});

    </script>
    <?php else: ?>
    <p class="text-md text-pastelGray">Le fichier de logs n'a pas été trouvé ou est vide.</p>
    <?php endif; ?>

</body>

</html>