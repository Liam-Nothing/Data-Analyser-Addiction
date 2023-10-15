<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["password"] == "pass") {
    setcookie("user_session", "c88f4b1d-fa3a-49ea-a7aa-3f99e44cd487", [
        'expires' => 2147483647,
        'path' => '/',
        'httponly' => true,
    ]);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<body class="bg-gray-200 h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-lg shadow-md w-96">
    <h1 class="text-2xl mb-4 text-center">Connectez-vous</h1>
    <form method="post" action="">
        <div class="mb-4">
            <label for="password" class="block text-sm mb-2">Mot de passe :</label>
            <input type="password" name="password" id="password" placeholder="Entrer votre mot de passe" class="w-full px-3 py-2 border rounded-md">
        </div>
        <div>
            <input type="submit" value="Login" class="w-full bg-blue-500 hover:bg-blue-600 text-white rounded-md py-2 cursor-pointer">
        </div>
    </form>
</div>

</body>
</html>
