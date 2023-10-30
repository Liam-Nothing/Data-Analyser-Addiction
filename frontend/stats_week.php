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

$weekData = [];

// Initialisation des données pour chaque jour de la semaine
$daysOfWeek = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];
foreach ($daysOfWeek as $day) {
    $weekData[$day] = [];
    for ($i = 1; $i <= 9; $i++) {
        $weekData[$day]['Fonction: ' . $i] = 0;
    }
}

foreach ($data as $log) {
    $dayOfWeek = date('N', strtotime($log['date']));
    $function = 'Fonction: ' . $log['function'];
    $weekData[$daysOfWeek[$dayOfWeek - 1]][$function]++;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Statistiques hebdomadaires</title>
</head>
<body class="bg-gray-200 p-6">

<h1 class="text-2xl mb-6">Statistiques hebdomadaires</h1>

<canvas id="weekChart"></canvas>

<script>
const weekData = <?php echo json_encode($weekData); ?>;
const labels = <?php echo json_encode($daysOfWeek); ?>;
const datasets = [];
const functions = ['Fonction: 1', 'Fonction: 2', 'Fonction: 3', 'Fonction: 4', 'Fonction: 5', 'Fonction: 6', 'Fonction: 7', 'Fonction: 8', 'Fonction: 9'];
const colors = ['#FF5733', '#3182CE', '#38A169', '#ECC94B', '#667EEA', '#ED64A6', '#A0AEC0', '#9F7AEA', '#4C51BF'];

functions.forEach((fn, index) => {
    const data = labels.map(label => weekData[label][fn]);
    datasets.push({
        label: fn,
        data: data,
        backgroundColor: colors[index],
        borderWidth: 1
    });
});

const ctx = document.getElementById('weekChart').getContext('2d');
const weekChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: datasets
    },
    options: {
        scales: {
            x: {
                beginAtZero: true
            },
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                labels: {
                    boxWidth: 10,
                    boxHeight: 10,
                }
            }
        }
    }
});
</script>

</body>
</html>
