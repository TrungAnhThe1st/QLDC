<?php include('../header.php');
if (!isset($_SESSION['objLogin'])) {
    header("Location: " . WEB_URL . "logout.php");
    die();
}
?>
<?php
include(ROOT_PATH . 'language/' . $lang_code_global . '/lang_unit_list.php');
$delinfo = 'none';
$addinfo = 'none';
$msg = "";
if (isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0) {
    $sqlx = "DELETE FROM `tbl_add_service` WHERE id = " . $_GET['id'];
    mysqli_query($link, $sqlx);
    $delinfo = 'block';
}
if (isset($_GET['m']) && $_GET['m'] == 'add') {
    $addinfo = 'block';
    $msg = "Thêm dịch vụ thành công!";
}
if (isset($_GET['m']) && $_GET['m'] == 'up') {
    $addinfo = 'block';
    $msg = "Cập nhật dịch vụ thành công";
}
?>
<!-- Content Header (Page header) -->
<style>
    .input-form {
        margin-bottom: 5px;
    }
</style>
<section class="content-header">
    <h1><?php echo "Danh sách dịch vụ"; ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo WEB_URL ?>dashboard.php"><i class="fa fa-dashboard"></i><?php echo $_data['home_breadcam']; ?></a></li>
        <li class="active"><?php echo "Thông tin dịch vụ"; ?></li>
        <li class="active"><?php echo "Danh sách dịch vụ"; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Full Width boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div id="me" class="alert alert-danger alert-dismissable" style="display:<?php echo $delinfo; ?>">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i class="fa fa-close"></i></button>
                <h4><i class="icon fa fa-ban"></i> <?php echo $_data['delete_text']; ?>!</h4>
                <?php echo "Xóa dịch vụ thành công!"; ?>
            </div>
            <div id="you" class="alert alert-success alert-dismissable" style="display:<?php echo $addinfo; ?>">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i class="fa fa-close"></i></button>
                <h4><i class="icon fa fa-check"></i><?php echo $_data['success']; ?> !</h4>
                <?php echo $msg; ?>
            </div>
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title"><?php echo "Danh sách dịch vụ"; ?></h3>
                    <!-- <form id="filter" action="" method="get" style="margin-top: 10px;">
            <div class="form-group">
              <select name="active" id="active" class="form-control input-form" onchange="">
                <option value="-1" <?php echo isset($_GET['active']) && $_GET['active'] == -1 ? "selected" : "" ?>>--Tất cả--</option>
                <option value="1" <?php echo isset($_GET['active']) && $_GET['active'] == 1 ? "selected" : "" ?>>--Đang thuê--</option>
                <option value="0" <?php echo isset($_GET['active']) && $_GET['active'] == 0 ? "selected" : "" ?>>--Chưa thuê--</option>
              </select>
              <button type="submit" class="btn btn-primary">Lọc</button>
            </div>
          </form> -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table sakotable table-bordered table-striped dt-responsive">
                        <thead>
                            <tr>
                                <th>Tên dịch vụ</th>
                                <th>Loại</th>
                                <th>Thuộc tiện ích</th>
                                <th>Miễn phí tháng đầu</th>
                                <th>Số lần sử dụng</th>
                                <th>Giá tiền</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "select s.*, u.name as utility_name from tbl_add_service s 
              inner join tbl_add_utility u on u.id = s.utility_id 
              inner join tbl_area a on a.id = u.area_id 
              inner join tblbranch br on br.area_id = a.id 
              where br.branch_id = " . (int)$_SESSION['objLogin']['branch_id'];

                            $result = mysqli_query($link, $sql);
                            while ($row = mysqli_fetch_array($result)) { ?>
                                <tr>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['sub_type'] == 1 ? "Gói tháng" : "Gói lẻ"; ?></td>
                                    <td><?php echo $row['utility_name']; ?></td>
                                    <td><?php echo $row['first_month_free'] == 0 ? "Không" : "Có"; ?></td>
                                    <td><?php echo $row['count'] == -1 ? "Không giới hạn" : $row['count']; ?></td>
                                    <td><?php echo $ams_helper->currency($localization, $row['price']); ?></td>
                                    <td><?php echo $row['created_at']; ?></td>
                                    <td><?php echo $row['updated_at']; ?></td>
                                    
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
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<script type="text/javascript">
    function deleteService(Id) {
        var iAnswer = confirm("<?php echo "Bạn có chắc không?"; ?>");
        if (iAnswer) {
            window.location = '<?php echo WEB_URL; ?>services/service_list.php?id=' + Id;
        }
    }

    $(document).ready(function() {
        setTimeout(function() {
            $("#me").hide(300);
            $("#you").hide(300);
        }, 3000);
    });
</script>

<?php include('../footer.php'); ?>