<?php
include('../header.php');
include(ROOT_PATH . 'language/' . $lang_code_global . '/lang_add_unit.php');
if (!isset($_SESSION['objLogin'])) {
    header("Location: " . WEB_URL . "logout.php");
    die();
}
$success = "none";
$title = "Thêm mới dịch vụ";
$button_text = $_data['save_button_text'];
$form_url = WEB_URL . "services/sub_details.php";

// if (isset($_POST['ddlUtility'])) {
// 	if (isset($_POST['hdn']) && $_POST['hdn'] == '0') {
// 		$sql = "INSERT INTO `tbl_add_service`(`name`, `utility_id`, `sub_type`, `first_month_free`, `price`) 
// 		values('$_POST[txtName]', $_POST[ddlUtility], $_POST[ddlSubType], $_POST[ddlFMF], $_POST[txtPrice])";
// 		mysqli_query($link, $sql);
// 		mysqli_close($link);
// 		$url = WEB_URL . 'services/sub_list.php?m=up';
// 		header("Location: $url");
// 	} 
// 	$success = "block";
// }
if (isset($_POST['submit'])) {
    $sql = '';
    $services_id = $_POST['services'];
    foreach ($services_id as $service_id) {
        if (isset($_POST['status']["$service_id"])) {
            $sql .= "Update tbl_add_subscription set status = 1 where rent_id = " . $_GET['id'] . ";\n";
        } else {
            $sql .= "Update tbl_add_subscription set status = 0 where rent_id = " . $_GET['id'] . ";\n";
        }
    }

    if ($sql != '') {
        mysqli_query($link, $sql);
        mysqli_close($link);
        $url = WEB_URL . 'services/sub_list.php?m=up';
        header("Location: $url");
    }
}

if (isset($_GET['id']) && $_GET['id'] != '') {
    $result = mysqli_query($link, "SELECT count(*) FROM tbl_add_service where id = '" . $_GET['id'] . "'");
    if ($row = mysqli_fetch_array($result)) {
        $form_url = WEB_URL . "services/sub_details.php?id=" . $_GET['id'];
    }
}

if (isset($_GET['mode']) && $_GET['mode'] == 'view') {
    $title = 'Xem chi tiết đăng ký dịch vụ của ' . $_GET['name'];
}
?>
<!-- Content Header (Page header) -->

<section class="content-header">
    <h1><?php echo $title; ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo WEB_URL ?>dashboard.php"><i class="fa fa-dashboard"></i><?php echo $_data['home_breadcam']; ?></a></li>
        <li class="active"><a href="<?php echo WEB_URL ?>services/sub_list.php"><?php echo "Thông tin đăng ký dịch vụ"; ?></a></li>
        <li class="active"><?php echo $title; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Full Width boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div align="right" style="margin-bottom:1%;"> </div>
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title"><?php echo ""; ?></h3>
                </div>
                <form onSubmit="return validateMe();" action="<?php echo $form_url; ?>" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <table class="table sakotable table-bordered table-striped dt-responsive">
                            <thead>
                                <tr>
                                    <th>Tên gói dịch vụ</th>
                                    <th>Loại</th>
                                    <th>Giá</th>
                                    <th>Số lần sử dụng</th>
                                    <th>Ngày tham gia</th>
                                    <th>Ngày hủy</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "Select s.*, sub.joined_at, sub.unsubscribed_at, sub.status, sub.usage_count from tbl_add_service s 
                            inner join tbl_add_subscription sub on sub.service_id = s.id 
                            where sub.rent_id = " . (int)$_GET['id'];

                                $result = mysqli_query($link, $sql);
                                while ($row = mysqli_fetch_array($result)) { ?>
                                    <tr>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['sub_type'] == 1 ? "Gói tháng" : "Gói lẻ"; ?></td>
                                        <td><?php echo $ams_helper->currency($localization, $row['price']);  ?></td>
                                        <td><?php echo $row['usage_count'] == -1 ? "Không giới hạn" : $row['usage_count']; ?></td>
                                        <td><?php echo $row['joined_at'] ?></td>
                                        <td><?php echo $row['unsubscribed_at'] == null ? "" : $row['unsubscribed_at'] ?></td>
                                        <td><input type="checkbox" name="status[<?php echo $row['id'] ?>]" value="<?php echo $row['status'] ?>" <?php echo $row['status'] == 1 ? "checked" : ""; ?> />
                                            <input type="hidden" name="services[]" value="<?php echo $row['id'] ?>" />
                                        </td>

                                    </tr>
                                <?php }
                                mysqli_close($link);
                                $link = NULL; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <div class="form-group pull-right">
                            <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <?php echo $button_text; ?></button>
                            <a class="btn btn-warning" href="<?php echo WEB_URL; ?>services/sub_list.php"><i class="fa fa-reply"></i> <?php echo $_data['back_text']; ?></a>
                        </div>
                    </div>
                </form>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
    <script type="text/javascript">

    </script>
    <?php include('../footer.php'); ?>