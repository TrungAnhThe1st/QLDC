<?php
include('../header_emp.php');
include(ROOT_PATH . 'language/' . $lang_code_global . '/lang_add_unit.php');
if (!isset($_SESSION['objLogin'])) {
    header("Location: " . WEB_URL . "logout.php");
    die();
}
$success = "none";
$title = "Thêm mới dịch vụ";
$button_text = $_data['save_button_text'];

if (isset($_GET['id']) && $_GET['id'] != '') {
    $result = mysqli_query($link, "SELECT count(*) FROM tbl_add_service where id = '" . $_GET['id'] . "'");
    if ($row = mysqli_fetch_array($result)) {
        $form_url = WEB_URL . "t_dashboard/sub_details.php?id=" . $_GET['id'];
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
        <li class="active"><a href="<?php echo WEB_URL ?>e_dashboard/service_list2.php"><?php echo "Thông tin đăng ký dịch vụ"; ?></a></li>
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
                <div class="box-body">
                    <table class="table sakotable table-bordered table-striped dt-responsive">
                        <thead>
                            <tr>
                                <th>Tên gói dịch vụ</th>
                                <th>Loại</th>
                                <th>Thuộc tiện ích</th>
                                <th>Thuộc khu</th>
                                <th>Giá</th>
                                <th>Số lần sử dụng</th>
                                <th>Ngày tham gia</th>
                                <th>Ngày hủy</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "Select a.name as area_name, util.name as utility_name,s.*, sub.joined_at, sub.unsubscribed_at, sub.status, sub.usage_count from tbl_add_service s 
                            inner join tbl_add_subscription sub on sub.service_id = s.id 
                            inner join tbl_add_utility util on util.id = s.utility_id 
                            inner join tbl_area a on a.id = util.area_id 
                            where sub.rent_id = " . (int)$_GET['id'];

                            $result = mysqli_query($link, $sql);
                            while ($row = mysqli_fetch_array($result)) { ?>
                                <tr>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['sub_type'] == 1 ? "Gói tháng" : "Gói lẻ"; ?></td>
                                    <td><?php echo $row['utility_name'] ?></td>
                                    <td><?php echo $row['area_name'] ?></td>
                                    <td><?php echo $ams_helper->currency($localization, $row['price']);  ?></td>
                                    <td><?php echo $row['usage_count'] == -1 ? "Không giới hạn" : $row['usage_count']; ?></td>
                                    <td><?php echo $row['joined_at'] ?></td>
                                    <td><?php echo $row['unsubscribed_at'] == null ? "" : $row['unsubscribed_at'] ?></td>
                                    <td>
                                    <?php echo $row['status'] == 1 ? "Đang sử dụng" : "Đã bị hủy" ?>
                                    </td>

                                </tr>
                            <?php }
                            mysqli_close($link);
                            $link = NULL; ?>
                        </tbody>
                    </table>
                </div>

                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
    <script type="text/javascript">

    </script>
    <?php include('../footer.php'); ?>