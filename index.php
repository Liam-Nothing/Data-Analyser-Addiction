<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Tableau de bord des fonctions</title>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex flex-col items-center justify-center p-4">
        <!-- Titre -->
        <h1 class="text-4xl md:text-5xl font-bold mb-10 text-gray-700">Tableau de bord</h1>

        <!-- Les boutons pour les fonctions -->
        <div class="grid grid-cols-3 gap-6 mb-10 w-full shadow-lg p-6 rounded bg-white">
            <a href="log.php?function=1" class="w-full h-24 bg-red-500 rounded transition-transform transform hover:scale-105"></a>
            <a href="log.php?function=2" class="w-full h-24 bg-blue-500 rounded transition-transform transform hover:scale-105"></a>
            <a href="log.php?function=3" class="w-full h-24 bg-green-500 rounded transition-transform transform hover:scale-105"></a>
            <a href="log.php?function=4" class="w-full h-24 bg-yellow-500 rounded transition-transform transform hover:scale-105"></a>
            <a href="log.php?function=5" class="w-full h-24 bg-indigo-500 rounded transition-transform transform hover:scale-105"></a>
            <a href="log.php?function=6" class="w-full h-24 bg-pink-500 rounded transition-transform transform hover:scale-105"></a>
            <a href="log.php?function=7" class="w-full h-24 bg-gray-500 rounded transition-transform transform hover:scale-105"></a>
            <a href="log.php?function=8" class="w-full h-24 bg-purple-500 rounded transition-transform transform hover:scale-105"></a>
            <a href="log.php?function=9" class="w-full h-24 bg-indigo-600 rounded transition-transform transform hover:scale-105"></a>
        </div>

        <!-- Les boutons pour accéder aux statistiques -->
        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 mb-4 shadow-md p-4 rounded bg-white">
            <a href="stats_hours.php" class="px-6 py-3 w-full text-center bg-blue-700 text-white rounded hover:bg-blue-800 transition-shadow shadow-md hover:shadow-lg">Heure</a>
            <a href="stats_daily.php" class="px-6 py-3 w-full text-center bg-green-700 text-white rounded hover:bg-green-800 transition-shadow shadow-md hover:shadow-lg">Jour</a>
            <a href="stats_week.php" class="px-6 py-3 w-full text-center bg-yellow-600 text-white rounded hover:bg-yellow-700 transition-shadow shadow-md hover:shadow-lg">Semaine</a>
        </div>
    </div>

</body>

</html>
