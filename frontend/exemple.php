<?php

// Définir le chemin d'accès au fichier
$file_path = 'logs.json';

// Obtenir la date d'aujourd'hui
$currentDate = new DateTime();
// Récupérer la date d'il y a 2 ans
$startDate = (clone $currentDate)->modify('-2 years');

$data = [];

while ($startDate <= $currentDate) {
    $functions = ['Fonction: 1', 'Fonction: 2', 'Fonction: 3', 'Fonction: 4', 'Fonction: 5', 'Fonction: 6', 'Fonction: 7', 'Fonction: 8', 'Fonction: 9'];

    foreach ($functions as $function) {
        $count = mt_rand(0, 5); // Générer une valeur aléatoire entre 0 et 5
        for ($i = 0; $i < $count; $i++) {
            $data[] = [
                'date' => $startDate->format('Y-m-d H:i:s'),
                'function' => str_replace('Fonction: ', '', $function)
            ];
        }
    }

    $startDate->modify('+1 day'); // Passer au jour suivant
}

// Écrire les données générées dans le fichier logs.json
file_put_contents($file_path, json_encode($data, JSON_PRETTY_PRINT));

echo "Données générées avec succès dans logs.json.";

?>
