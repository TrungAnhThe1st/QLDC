<?php
include('../config.php');
include(ROOT_PATH . "library/encryption.php");
$converter = new Encryption;

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Sample array
    $qrCitizenData = $_POST['qrCitizenData'];
    $qrUnitData = $_POST['qrUnitData'];
    $additional = $_POST["additional"];
    /*
    0 - new cid, 1 - old cid, 2 - name, 
    3 - dob (ddMMyyyy), 4 - gender, 5 - address, 
    6 - cid provided date
    */
    $decoded_datas = explode("|", $qrCitizenData);
    $dob = substr($decoded_datas[3], 0, 2) . "/" . substr($decoded_datas[3], 2, 2) . "/" . substr($decoded_datas[3], 4, 4);

    /* 0 - Phone, 1 - Email */
    $additionalData = explode("|", $additional);
    $phone = $additionalData[0];
    $email = $additionalData[1];

    /*0 - uid, 1 - fid, 2 - branch_id */
    $unit_decode_datas = explode("|", $qrUnitData);

    $message = '';
    $signal = 0;

    /* 
    Get year id from tbl_add_year_setup, if not exist then create a new record 
    based on the current year and get its id right after
    */
    $sql = "Select y_id from tbl_add_year_setup where xyear = '" . date('Y') . "'";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) == 0) {
        $sql = "insert into tbl_add_year_setup(xyear) values('" . date('Y') . "')";
        mysqli_query($link, $sql);
        $year_id = mysqli_insert_id($link);
    } else {
        $row = mysqli_fetch_array($result);
        $year_id = $row['y_id'];
    }


    $sql = "Select * from tbl_add_rent 
    where r_nid = '$decoded_datas[0]' or r_email = '$email' or (r_unit_id = $unit_decode_datas[0] and r_floor_id = $unit_decode_datas[1] and branch_id = $unit_decode_datas[2])";
    $result = mysqli_query($link, $sql);

    if ($row = mysqli_fetch_array($result)) {
        // $sql = "UPDATE `tbl_add_rent` 
        // SET `r_name`='" . $decoded_datas[2] . "',
        // `r_email`='" . $email . "',
        // `r_address`='" . $decoded_datas['5'] . "',
        // `r_nid`='" . $decoded_datas['0'] . "',
        // `r_rent_pm`='" . (isset($decoded_datas['txtRentPerMonth']) ? $decoded_datas['txtRentPerMonth'] : 0.00) . "',
        // `r_date`='" . date('d/m/Y') . "',
        // `r_month`='" . date('n') . "',
        // `r_year`='" . date('Y') . "'";

        // mysqli_query($link, $sql);
        $signal = 1;
    } else {
        $r_date = date('d/m/Y');
        $r_month = date('n');
        $r_password = $converter->encode('123456');

        $r_unit_id = intval($unit_decode_datas[0]);
        $r_floor_id = intval($unit_decode_datas[1]);
        $branch_id = intval($unit_decode_datas[2]);

        $sql1 = "INSERT INTO tbl_add_rent (r_name,r_contact,r_dob,r_email,r_address,r_nid,r_advance,r_rent_pm,r_date,r_month,r_year, r_password, r_unit_id, r_floor_id, branch_id) 
        VALUES('$decoded_datas[2]', '$phone', '$dob', '$email','$decoded_datas[5]','$decoded_datas[0]',0.00,0.00,'$r_date',$r_month,$year_id,'$r_password', $r_unit_id, $r_floor_id, $branch_id);";
        $sql1 .= "UPDATE tbl_add_unit SET `status` = 1 WHERE `uid` = $unit_decode_datas[0];";
        if($result = mysqli_multi_query($link, $sql1)){
            $signal = 2;
        }
        else $signal = 3;
        
        mysqli_close($link);
    }

    if ($signal === 2) {
        http_response_code(200);
        $status = 200;
        $message = "Thành công!";
    } else if ($signal === 1) {
        http_response_code(409);
        $status = 409;
        $message = "Người dùng đã tồn tại hoặc căn hộ đã được thuê!";
    }
    else if($signal === 3){
        $status = 409;
        $message = "Lỗi!";
    }

    echo json_encode([
        "status" => $status,
        'message' => $message
    ]);
} else {
    http_response_code(405);
    echo json_encode([
        'status' => 405,
        'message' => 'Wrong method!'

    ]);
}

// echo json_encode([
//     "qrCitizenData" => $_POST['qrCitizenData'],
// ]);

exit();
