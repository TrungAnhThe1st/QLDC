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
  $sqlx = "DELETE FROM `tbl_add_unit` WHERE uid = " . $_GET['id'];
  mysqli_query($link, $sqlx);
  $delinfo = 'block';
}
if (isset($_GET['m']) && $_GET['m'] == 'add') {
  $addinfo = 'block';
  $msg = $_data['add_unit_successfully'];
}
if (isset($_GET['m']) && $_GET['m'] == 'up') {
  $addinfo = 'block';
  $msg = $_data['update_unit_successfully'];
}
?>
<!-- Content Header (Page header) -->
<style>
  .input-form {
    margin-bottom: 5px;
  }
</style>
<section class="content-header">
  <h1><?php echo $_data['unit_list_title']; ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo WEB_URL ?>dashboard.php"><i class="fa fa-dashboard"></i><?php echo $_data['home_breadcam']; ?></a></li>
    <li class="active"><?php echo $_data['add_new_unit_information_breadcam']; ?></li>
    <li class="active"><?php echo $_data['unit_list_title']; ?></li>
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
        <?php echo $_data['delete_unit_information']; ?>
      </div>
      <div id="you" class="alert alert-success alert-dismissable" style="display:<?php echo $addinfo; ?>">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i class="fa fa-close"></i></button>
        <h4><i class="icon fa fa-check"></i><?php echo $_data['success']; ?> !</h4>
        <?php echo $msg; ?>
      </div>
      <div align="right" style="margin-bottom:1%;"> <a class="btn btn-success" data-toggle="tooltip" href="<?php echo WEB_URL; ?>unit/addunit.php" data-original-title="<?php echo $_data['add_unit']; ?>"><i class="fa fa-plus"></i></a> <a class="btn btn-success" data-toggle="tooltip" href="<?php echo WEB_URL; ?>dashboard.php" data-original-title="<?php echo $_data['home_breadcam']; ?>"><i class="fa fa-dashboard"></i></a> </div>
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title"><?php echo $_data['unit_list_title']; ?></h3>
          <form id="filter" action="" method="get" style="margin-top: 10px;">
            <div class="form-group">
              <select name="active" id="active" class="form-control input-form" onchange="">
                <option value="-1" <?php echo isset($_GET['active']) && $_GET['active'] == -1 ? "selected" : "" ?>>--Tất cả--</option>
                <option value="1" <?php echo isset($_GET['active']) && $_GET['active'] == 1 ? "selected" : "" ?>>--Đang thuê--</option>
                <option value="0" <?php echo isset($_GET['active']) && $_GET['active'] == 0 ? "selected" : "" ?>>--Chưa thuê--</option>
              </select>
              <button type="submit" class="btn btn-primary">Lọc</button>
            </div>
          </form>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table sakotable table-bordered table-striped dt-responsive">
            <thead>
              <tr>
                <th><?php echo $_data['floor_no']; ?></th>
                <th><?php echo $_data['unit_no']; ?></th>
                <th><?php echo $_data['rent_pm']; ?></th>
                <th><?php echo $_data['action_text']; ?></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "Select f.fid, f.floor_no,u.unit_no,u.uid, u.rent_pm, u.branch_id from tbl_add_unit u 
              inner join tbl_add_floor f on f.fid = u.floor_no 
              where u.branch_id = " . (int)$_SESSION['objLogin']['branch_id'];

              if (isset($_GET['active']) && $_GET['active'] != -1) {
                $sql .= " and u.status = $_GET[active]";
              }
              $sql .= " order by u.uid ASC";
              $result = mysqli_query($link, $sql);
              while ($row = mysqli_fetch_array($result)) { ?>
                <tr>
                  <td><?php echo $row['floor_no']; ?></td>
                  <td><?php echo $row['unit_no']; ?></td>
                  <td><?php echo $ams_helper->currency($localization, $row['rent_pm']); ?></td>
                  <td>
                    <a class="btn btn-success ams_btn_special" data-toggle="tooltip" href="javascript:;" onClick="$('#nurse_view_<?php echo $row['uid']; ?>').modal('show');" data-original-title="QR code"><i class="fa fa-eye"></i></a>
                    <a class="btn btn-warning ams_btn_special" data-toggle="tooltip" href="<?php echo WEB_URL; ?>unit/addunit.php?id=<?php echo $row['uid']; ?>" data-original-title="<?php echo $_data['edit_text']; ?>"><i class="fa fa-pencil"></i></a>
                    <a class="btn btn-danger ams_btn_special" data-toggle="tooltip" onclick="deleteUnit(<?php echo $row['uid']; ?>);" href="javascript:;" data-original-title="<?php echo $_data['delete_text']; ?>"><i class="fa fa-trash-o"></i></a>
                    <div id="nurse_view_<?php echo $row['uid']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header green_header">
                            <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true"><i class="fa fa-close"></i></span></button>
                            <h3 class="modal-title">QR code</h3>
                          </div>
                          <div class="modal-body" align="center">
                            <div id="id-qrcode-<?php echo $row['uid']; ?>"></div>
                            <p>(Mã căn hộ|Mã tầng|Mã tòa nhà)</p>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                    </div>
                    <!--Qr code generating -->
                    <script>
                      var qrcode = new QRCode(document.getElementById("id-qrcode-<?php echo $row['uid']; ?>"), {
                        width: 100,
                        height: 100
                      });
                      qrcode.makeCode("<?php echo $row['uid'] . '|' . $row['fid'] . '|' . $row['branch_id']; ?>");

                      $("#id-qrcode-<?php echo $row['uid']; ?> img").css("margin", "0 auto");
                    </script>
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
    function deleteUnit(Id) {
      var iAnswer = confirm("<?php echo $_data['confirm']; ?>");
      if (iAnswer) {
        window.location = '<?php echo WEB_URL; ?>unit/unitlist.php?id=' + Id;
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