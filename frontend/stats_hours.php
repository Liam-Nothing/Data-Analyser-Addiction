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

$hourlyData = [];
for ($h = 0; $h <= 23; $h++) {
    for ($m = 0; $m <= 45; $m += 15) {
        $hourlyData[sprintf('%02d:%02d', $h, $m)] = [];
    }
}

if ($data) {
    foreach ($data as $log) {
        $hourPart = intval(date('H', strtotime($log['date'])));
        $minutePart = intval(date('i', strtotime($log['date'])));
        $roundedMinute = floor($minutePart / 15) * 15;

        $timeSlot = sprintf('%02d:%02d', $hourPart, $roundedMinute);
        $function = 'Fonction: ' . $log['function'];

        if (!isset($hourlyData[$timeSlot][$function])) {
            $hourlyData[$timeSlot][$function] = 0;
        }

        $hourlyData[$timeSlot][$function]++;
    }
}

$functions = ['Fonction: 1', 'Fonction: 2', 'Fonction: 3', 'Fonction: 4', 'Fonction: 5', 'Fonction: 6', 'Fonction: 7', 'Fonction: 8', 'Fonction: 9'];
$colors = ['#FF5733', '#3182CE', '#38A169', '#ECC94B', '#667EEA', '#ED64A6', '#A0AEC0', '#9F7AEA', '#4C51BF']; // Adapted colors
$datasets = [];

foreach ($functions as $index => $function) {
    $dataForFunction = [];
    foreach ($hourlyData as $timeSlot => $logs) {
        $dataForFunction[] = isset($logs[$function]) ? $logs[$function] : 0;
    }

    $datasets[] = [
        'label' => $function,
        'data' => $dataForFunction,
        'backgroundColor' => $colors[$index]
    ];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Statistiques par heure</title>
</head>
<body class="bg-gray-200 p-6">

<h1 class="text-2xl mb-6">Statistiques par heure</h1>
<?php if ($data): ?>
<canvas id="hourlyChart"></canvas>
<script>
const labels = <?php echo json_encode(array_keys($hourlyData)); ?>;
const datasets = <?php echo json_encode($datasets); ?>;

const ctx = document.getElementById('hourlyChart').getContext('2d');
const hourlyChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: datasets
    },
    options: {
        scales: {
            x: {stacked: true},
            y: {stacked: true}
        }
    }
});
</script>
<?php else: ?>
<p>Le fichier de logs n'a pas été trouvé ou est vide.</p>
<?php endif; ?>

</body>
</html>
