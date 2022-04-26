<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){
    // Sample array
    $qrData = $_POST['qrData'];
    $email = $_POST['email'];

    header("Content-Type: application/json");

    http_response_code(200);
    echo json_encode([
        'qrData' => $qrData,
        'email' => $email
    ]);
}
else {
    http_response_code(405);
}
exit();
