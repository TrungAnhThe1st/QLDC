<?php
header("Content-type: text/html; charset=utf-8");
define('_AMSCODESECURITY', '16343942');
define('CURRENCY', 'đ');
define('WEB_URL', 'http://localhost:8081/Private/ams/');
define('ROOT_PATH', 'C:\xampp\htdocs\Private\ams/');


define('DB_HOSTNAME', 'localhost:3308');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'ams');

$link = new mysqli(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
mysqli_set_charset($link, 'UTF8');

function getYearId($year) {
    $link1 = new mysqli(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    $sql = "select * from tbl_add_year_setup where xyear = '$year'";
    $result = mysqli_query($link1, $sql);
    $row = mysqli_fetch_array($result);
    mysqli_close($link1);

    return $row['y_id'];
};

