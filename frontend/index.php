<?php
if (!isset($_COOKIE["user_session"]) || $_COOKIE["user_session"] !== "c88f4b1d-fa3a-49ea-a7aa-3f99e44cd487") {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/print.css" media="print">

    <title>Tableau de bord des fonctions</title>
</head>

<body x-data="{ leftOpen: false, rightOpen: false }" class="flex flex-col h-full">

    <header>
        <nav class="bg-pastelWhite p-4">
            <div class="container mx-auto">
                <div class="flex justify-between items-center">
                    <button class="p-2" @click="leftOpen = !leftOpen">
                        <i class="fas fa-cog text-2xl text-pastelGray"></i>
                    </button>

                    <!-- <div x-show.transition.left="leftOpen" class="fixed top-0 left-0 h-full w-64 bg-pastelWhite z-50 shadow-lg p-4">
                        <div class="flex justify-between items-center">
                            <h2 class="text-pastelGray text-2xl">Menu de Gauche</h2>
                            <button @click="leftOpen = false" class="p-2">
                                <i class="fas fa-times text-pastelGray"></i>
                            </button>
                        </div>
                        <button class="w-full p-2 mb-2 rounded text-pastelGray">Bouton 1</button>
                        <button class="w-full p-2 mb-2 rounded text-pastelGray">Bouton 2</button>
                        <button class="w-full p-2 mb-2 rounded text-pastelGray">Bouton 3</button>
                    </div> -->

                    <div>
                    </div>

                    <button class="p-2" @click="rightOpen = !rightOpen">
                        <i class="fas fa-chart-column text-2xl text-pastelGray"></i>
                    </button>

                    <div x-show.transition.right="rightOpen" class="fixed top-0 right-0 h-full w-64 bg-pastelWhite z-50 shadow-lg p-4">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-pastelGray text-2xl"><i class="fas fa-chart-column text-2xl text-pastelGray"></i> Statistiques</h2>
                            <button @click="rightOpen = false" class="p-2">
                                <i class="fas fa-times text-pastelGray"></i>
                            </button>
                        </div>
                        <button class="flex w-full p-2 mb-2 rounded text-pastelGray items-center">
                            <a href="stats_hours.php">
                                <i class="fas fa-clock mr-3"></i>
                                <span>Par heure</span>
                            </a>
                        </button>
                        <button class="flex w-full p-2 mb-2 rounded text-pastelGray items-center">
                            <a href="stats_daily.php">
                                <i class="fas fa-calendar-day mr-3"></i>
                                <span>Par jour</span>
                            </a>
                        </button>
                        <button class="flex w-full p-2 mb-2 rounded text-pastelGray items-center">
                            <a href="stats_week.php">
                                <i class="fas fa-calendar-week mr-3"></i>
                                <span>Par semaine</span>
                            </a>
                        </button>
                    </div>

                </div>
            </div>
        </nav>
    </header>
    <main class="flex-1">
        <div class="flex flex-col items-center justify-center p-4 max-w-sm mx-auto">
            <img src="img/logo.png" alt="Logo" class="mb-6"  style="max-width:200px;"/>
            <div class="grid grid-cols-3 gap-6 mb-10 w-full" id="function-buttons">
                <button class="w-full shadow-lg p-6 h-24 bg-pastelOrange rounded transition-transform transform hover:scale-105" onclick="logFunction(1)"></button>
                <button class="w-full shadow-lg p-6 h-24 bg-pastelBlue rounded transition-transform transform hover:scale-105" onclick="logFunction(2)"></button>
                <button class="w-full shadow-lg p-6 h-24 bg-pastelGreen rounded transition-transform transform hover:scale-105" onclick="logFunction(3)"></button>
                <button class="w-full shadow-lg p-6 h-24 bg-pastelYellow rounded transition-transform transform hover:scale-105" onclick="logFunction(4)"></button>
                <button class="w-full shadow-lg p-6 h-24 bg-pastelIndigo rounded transition-transform transform hover:scale-105" onclick="logFunction(5)"></button>
                <button class="w-full shadow-lg p-6 h-24 bg-pastelPink rounded transition-transform transform hover:scale-105" onclick="logFunction(6)"></button>
                <button class="w-full shadow-lg p-6 h-24 bg-pastelGray rounded transition-transform transform hover:scale-105" onclick="logFunction(7)"></button>
                <button class="w-full shadow-lg p-6 h-24 bg-pastelPurple rounded transition-transform transform hover:scale-105" onclick="logFunction(8)"></button>
                <button class="w-full shadow-lg p-6 h-24 bg-pastelBlue darker rounded transition-transform transform hover:scale-105" onclick="logFunction(9)"></button>
            </div>
        </div>
    </main>
    <footer class="py-4">
        <div class="container mx-auto text-center opacity-10">
            NothingElse.fr © 2023
        </div>
    </footer>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</body>
</html>
