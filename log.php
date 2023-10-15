<?php
if (!isset($_COOKIE["user_session"]) || $_COOKIE["user_session"] !== "c88f4b1d-fa3a-49ea-a7aa-3f99e44cd487") {
    header("Location: login.php");
    exit;
}
?>
<?php

$file_path = 'logs.json';

if (isset($_GET['function']) && is_numeric($_GET['function']) && $_GET['function'] > 0 && $_GET['function'] < 10) {
    $function = intval($_GET['function']);

    $logs = [];
    if (file_exists($file_path)) {
        $logs = json_decode(file_get_contents($file_path), true);
    }

    $logs[] = [
        'date' => date('Y-m-d H:i:s'),
        'function' => $function
    ];

    file_put_contents($file_path, json_encode($logs));
    header('Location: index.php');
} else {
    header('Location: index.php');
}

?>
