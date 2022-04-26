<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){
    // Sample array
    $qrData = $_POST['qrData'];

    /*0 - new cid, 1 - old cid, 2 - name, 
    3 - dob (ddMMyyyy), 4 - gender, 5 - address, 
    6 - cid provided date
    */
    $decoded_datas = implode("|", $qrData);

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
