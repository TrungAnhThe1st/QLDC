<?php
include('../config.php');
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Sample array
    $qrData = $_POST['qrData'];

    /*0 - new cid, 1 - old cid, 2 - name, 
    3 - dob (ddMMyyyy), 4 - gender, 5 - address, 
    6 - cid provided date
    */
    $decoded_datas = implode("|", $qrData);
    $email = $_POST['email'];

    $message = '';
    $signal = 0;

    $sql = "Select * from tbl_add_rent 
    where r_name = '$decoded_datas[2]' and r_nid = '$decoded_datas[0]'";
    $result = mysqli_query($link, $sql);

    if ($row = mysqli_fetch_array($result)) {
        // $sql = "UPDATE `tbl_add_rent` 
        // SET `r_name`='" . $decoded_datas[2] . "',
        // `r_email`='" . $email . "',
        // `r_password`='" . $converter->encode('123456') . "',
        // `r_address`='" . $decoded_datas['5'] . "',
        // `r_nid`='" . $decoded_datas['0'] . "',
        // `r_rent_pm`='" . (isset($decoded_datas['txtRentPerMonth']) ? $decoded_datas['txtRentPerMonth'] : 0.00) . "',
        // `r_date`='" . date('d/m/Y') . "',
        // `r_month`='" . date('n') . "',
        // `r_year`='" . date('Y') . "'";

        // mysqli_query($link, $sql);
        $signal = 1;
    } else {
        $sql = "INSERT INTO tbl_add_rent(r_name,r_email,r_address,r_nid,r_rent_pm,r_date,r_month,r_year) 
		values('$decoded_datas[2]','$email','$decoded_datas[5]','$decoded_datas[0]','" . (isset($_POST["txtRentPerMonth"]) ? $_POST["txtRentPerMonth"] : 0.00) . "', '" . date('d/m/Y') . "','" . date('n') . "','" . date('Y') . "')";

        mysqli_query($link, $sql);
        $signal = 2;
    }

    header("Content-Type: application/json");

    if ($signal === 2) {
        http_response_code(200);
        $message = "Thành công!";
    } else if ($signal === 1) {
        http_response_code(409);
        $message = "Người dùng đã tồn tại!";
    }

    echo json_encode([
        'message' => $message
        // 'qrData' => $qrData,
        // 'email' => $email
    ]);
} else {
    http_response_code(405);
    echo json_encode([
        'message' => 'Wrong method!'
        // 'qrData' => $qrData,
        // 'email' => $email
    ]);
}

exit();
