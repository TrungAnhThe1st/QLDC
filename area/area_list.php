<?php
include('../header.php');
include(ROOT_PATH . 'language/' . $lang_code_global . '/lang_branch_list.php');
if (!isset($_SESSION['objLogin'])) {
    header("Location: " . WEB_URL . "logout.php");
    die();
}
if (isset($_SESSION['login_type']) && ((int)$_SESSION['login_type'] != 5)) {
    header("Location: " . WEB_URL . "logout.php");
    die();
}
?>
<?php
$delinfo = 'none';
$addinfo = 'none';
$msg = "";
if (isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0) {

    $sqlx = "DELETE FROM `tbl_area` WHERE id = " . $_GET['id'];
    mysqli_query($link, $sqlx);
    $delinfo = 'block';
}
if (isset($_GET['m']) && $_GET['m'] == 'add') {
    $addinfo = 'block';
    $msg = "Thêm mới khu thành công";
}
if (isset($_GET['m']) && $_GET['m'] == 'up') {
    $addinfo = 'block';
    $msg = "Cập nhật khu thành công";
}

// function branchCount($link)
// {
//     $sql = mysqli_query($link, "SELECT count(*) as total_rows from tblbranch");
//     if ($row = mysqli_fetch_assoc($sql)) {
//         if ($row['total_rows'] > 1) {
//             return true;
//         } else {
//             return false;
//         }
//     }
//     return false;
// }
?>
<!-- Content Header (Page header) -->

<section class="content-header">
    <h1> <?php echo "Danh sách các khu"; ?> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo WEB_URL ?>/dashboard.php"><i class="fa fa-dashboard"></i> <?php echo $_data['text_19']; ?></a></li>
        <li class="active"><?php echo "Cài đặt"; ?></li>
        <li class="active"><?php echo "Danh sách khu"; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Full Width boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-danger alert-dismissable" style="display:<?php echo $delinfo; ?>">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i class="fa fa-close"></i></button>
                <h4><i class="icon fa fa-ban"></i> <?php echo $_data['delete_text']; ?>!</h4>
                <?php echo $_data['text_13']; ?>
            </div>
            <div class="alert alert-success alert-dismissable" style="display:<?php echo $addinfo; ?>">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i class="fa fa-close"></i></button>
                <h4><i class="icon fa fa-check"></i> <?php echo $_data['success']; ?>!</h4>
                <?php echo $msg; ?>
            </div>
            <div align="right" style="margin-bottom:1%;"> <a class="btn btn-success" data-toggle="tooltip" href="<?php echo WEB_URL; ?>area/add_area.php" data-original-title="<?php echo $_data['text_1']; ?>"><i class="fa fa-plus"></i></a> <a class="btn btn-success" data-toggle="tooltip" href="<?php echo WEB_URL; ?>dashboard.php" data-original-title="<?php echo $_data['text_17']; ?>"><i class="fa fa-dashboard"></i></a> </div>
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title"><?php echo "Danh sách các khu"; ?></h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table sakotable table-bordered table-striped dt-responsive">
                        <thead>
                            <tr>
                                <th><?php echo "Tên khu"; ?></th>
                                <th><?php echo "Ngày tạo"; ?></th>
                                <th><?php echo "Ngày cập nhật"; ?></th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = mysqli_query($link, "Select * from tbl_area order by id desc");
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['created_at']; ?></td>
                                    <td><?php echo $row['updated_at']; ?></td>

                                    <td>
                                        <a class="btn btn-warning ams_btn_special" data-toggle="tooltip" href="<?php echo WEB_URL; ?>area/add_area.php?id=<?php echo $row['id']; ?>" data-original-title="<?php echo "Sửa thông tin"; ?>"><i class="fa fa-pencil"></i></a>
                                        <!-- <a class="btn btn-danger ams_btn_special" data-toggle="tooltip" onclick="deleteArea(<?php echo $row['id']; ?>);" href="javascript:;" data-original-title="<?php echo "Xóa"; ?>"><i class="fa fa-trash-o"></i></a> -->

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
    <script type="text/javascript">
        // function deleteArea(Id) {
        //     var iAnswer = confirm("Bạn có chắc muốn xóa ?");
        //     if (iAnswer) {
        //         window.location = 'branchlist.php?id=' + Id;
        //     }
        // }
    </script>
    <?php include('../footer.php'); ?>