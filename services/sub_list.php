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
    $sqlx = "DELETE FROM `tbl_add_subscription` WHERE rent_id = " . $_GET['id'];
    mysqli_query($link, $sqlx);
    $delinfo = 'block';
}
// if (isset($_GET['m']) && $_GET['m'] == 'add') {
//     $addinfo = 'block';
//     $msg = "Thêm dịch vụ thành công!";
// }
if (isset($_GET['m']) && $_GET['m'] == 'up') {
    $addinfo = 'block';
    $msg = "Cập nhật đăng ký thành công";
}
?>
<!-- Content Header (Page header) -->
<style>
    .input-form {
        margin-bottom: 5px;
    }
</style>
<section class="content-header">
    <h1><?php echo "Danh sách đăng ký dịch vụ"; ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo WEB_URL ?>dashboard.php"><i class="fa fa-dashboard"></i><?php echo $_data['home_breadcam']; ?></a></li>
        <li class="active"><?php echo "Thông tin dịch vụ"; ?></li>
        <li class="active"><?php echo "Danh sách đăng ký"; ?></li>
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
                    <h3 class="box-title"><?php echo "Danh sách đăng ký dịch vụ"; ?></h3>
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
                                <th>Tên cư dân</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Căn hộ</th>
                                <th>Số dịch vụ đã đăng ký</th>
                                <th>Số dịch vụ đang có hiệu lực</th>
                                <th><?php echo $_data['action_text']; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "select r.rid, r.r_name, r.r_email, r.r_contact, sub_count, active_count, u.unit_no from tbl_add_rent r 
                            inner join tbl_add_unit u on u.uid = r.r_unit_id 
                            inner join (select rent_id, count(*) as sub_count from tbl_add_subscription GROUP by rent_id) sc on sc.rent_id = r.rid 
                            left join (select rent_id, count(*) as active_count from tbl_add_subscription where status = 1 GROUP by rent_id) ac on ac.rent_id = r.rid 
                            inner join tblbranch br on br.branch_id = r.branch_id 
                            where br.branch_id = " . (int)$_SESSION['objLogin']['branch_id'];

                            $result = mysqli_query($link, $sql);
                            while ($row = mysqli_fetch_array($result)) { ?>
                                <tr>
                                    <td><?php echo $row['r_name'] ?></td>
                                    <td><?php echo $row['r_email'] ?></td>
                                    <td><?php echo $row['r_contact'] ?></td>
                                    <td><?php echo $row['unit_no'] ?></td>
                                    <td><?php echo $row['sub_count'] ?></td>
                                    <td><?php echo $row['active_count'] == null ? '0' : $row['active_count'] ?></td>
                                    <td>
                                        <a class="btn btn-success ams_btn_special" data-toggle="tooltip" href="<?php echo WEB_URL; ?>services/sub_details.php?id=<?php echo $row['rid']; ?>&mode=view&name=<?php echo $row['r_name'] ?>" data-original-title="Xem các dịch vụ đã đăng ký"><i class="fa fa-eye"></i></a>
                                        <a class="btn btn-danger ams_btn_special" data-toggle="tooltip" onclick="deleteService(<?php echo $row['rid']; ?>);" href="javascript:;" data-original-title="<?php echo $_data['delete_text']; ?>"><i class="fa fa-trash-o"></i></a>
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
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<script type="text/javascript">
    function deleteService(Id) {
        var iAnswer = confirm("<?php echo "Bạn có chắc không?"; ?>");
        if (iAnswer) {
            window.location = '<?php echo WEB_URL; ?>services/sub_list.php?id=' + Id;
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