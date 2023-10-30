<?php
if (!isset($_COOKIE["user_session"]) || $_COOKIE["user_session"] !== "c88f4b1d-fa3a-49ea-a7aa-3f99e44cd487") {
    header("Location: login.php");
    exit;
}

// Log function click and return JSON response
if (isset($_GET['function']) && is_numeric($_GET['function']) && $_GET['function'] > 0 && $_GET['function'] < 10) {
    $functionNumber = intval($_GET['function']);

    $file_path = 'logs.json';
    $logs = [];

    if (file_exists($file_path)) {
        $logs = json_decode(file_get_contents($file_path), true);
    }

    $logs[] = [
        'date' => date('Y-m-d H:i:s'),
        'function' => $functionNumber
    ];

    file_put_contents($file_path, json_encode($logs));

    // Return a JSON response indicating success
    echo json_encode(['status' => 'success']);
} else {
    // Return a JSON response indicating failure
    echo json_encode(['status' => 'failure']);
}
?>
