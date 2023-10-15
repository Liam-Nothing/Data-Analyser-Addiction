<?php
$file_path = 'logs.json';
$data = [];

if (file_exists($file_path)) {
    $data = json_decode(file_get_contents($file_path), true);
}

$dailyData = [];

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
<body class="bg-gray-200 p-6">

<h1 class="text-2xl mb-6">Statistiques quotidiennes</h1>

<?php if ($data): ?>
<canvas id="dailyChart"></canvas>

<script>
const dailyData = <?php echo json_encode($dailyData); ?>;
const labels = <?php echo json_encode(array_keys($dailyData)); ?>;
const datasets = [];
const functions = ['Fonction: 1', 'Fonction: 2', 'Fonction: 3', 'Fonction: 4', 'Fonction: 5', 'Fonction: 6', 'Fonction: 7', 'Fonction: 8', 'Fonction: 9'];
const colors = ['#FF5733', '#3182CE', '#38A169', '#ECC94B', '#667EEA', '#ED64A6', '#A0AEC0', '#9F7AEA', '#4C51BF'];

functions.forEach((fn, index) => {
    const data = labels.map(label => dailyData[label][fn] || 0);
    datasets.push({
        label: fn,
        data: data,
        fill: false,
        borderColor: colors[index],
        tension: 0.1
    });
});

const ctx = document.getElementById('dailyChart').getContext('2d');
const dailyChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: datasets
    }
});
</script>
<?php else: ?>
<p>Le fichier de logs n'a pas été trouvé ou est vide.</p>
<?php endif; ?>

</body>
</html>
