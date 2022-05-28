<?php include('../header.php');
if (!isset($_SESSION['objLogin'])) {
  header("Location: " . WEB_URL . "logout.php");
  die();
}
?>
<?php
include(ROOT_PATH . 'language/' . $lang_code_global . '/lang_unit_list.php');
require('../utility/PhpExcel/SimpleXLSX.php');

use Shuchkin\SimpleXLSX;

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

if (isset($_POST['import_submit'])) {
  if (isset($_FILES['importFile'])) {
    if ($xlsx = SimpleXLSX::parse($_FILES['importFile']['tmp_name'])) {
      $arr = $xlsx->rows();
      $sql = '';
      for ($i = 1; $i < count($arr); $i++) {
        $floor_id = $arr[$i][0];
        $unit_name = $arr[$i][1];
        $rpm = $arr[$i][2];

        $sql .= "Insert into tbl_add_unit (floor_no, unit_no, branch_id, rent_pm, status) 
        SELECT $floor_id, '$unit_name', " . $_SESSION['objLogin']['branch_id'] . ", $rpm, 0 
        WHERE NOT EXISTS (SELECT * FROM tbl_add_unit WHERE unit_no = '$unit_name' AND floor_no = $floor_id);";
      }

      if ($sql != '') {
        if($result = mysqli_multi_query($link, $sql)){
          mysqli_close($link);
          $url = WEB_URL . 'unit/unitlist.php?m=add';
          header("Location: $url");
        }
      }
    }
  }
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
          <div style="margin:10px">
            <button id="btnExport" class="btn btn-success" onclick="">Xuất file excel</button>
            <form action="" style="float: right;" method="post" enctype="multipart/form-data">
              <div>
                <a class="btn btn-info" href="../assets/examples/UnitExample.xlsx">File excel mẫu</a>
                <span class="btn btn-file btn btn-default">Tải file lên
                  <input type="file" name="importFile" value="" id="importFile" />
                </span>
                <button class="btn btn-success" type="submit" name="import_submit">Nhập file excel</button>
              </div>
            </form>
            <div style="text-align: right;" style="margin:10px">
            <p style=" color:red;">*Lưu ý lấy file excel danh sách tầng để có được mã các tầng trước khi tiến hành tạo file excel nhập vào</p>
            </div>

          </div>
          <table id="testExportId" class="table sakotable table-bordered table-striped dt-responsive">
            <thead>
              <tr>
                <th><?php echo $_data['floor_no']; ?></th>
                <th><?php echo $_data['unit_no']; ?></th>
                <th><?php echo $_data['rent_pm']; ?></th>
                <th class="excludeExport"><?php echo $_data['action_text']; ?></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "Select f.fid, f.floor_no,u.unit_no,u.uid, u.rent_pm, u.branch_id, br.branch_name from tbl_add_unit u 
              inner join tbl_add_floor f on f.fid = u.floor_no 
              inner join tblbranch br on br.branch_id = u.branch_id 
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
                  <td class="excludeExport">
                    <a class="btn btn-success ams_btn_special" data-toggle="tooltip" href="javascript:;" onClick="$('#nurse_view_<?php echo $row['uid']; ?>').modal('show');" data-original-title="QR code"><i class="fa fa-qrcode"></i></a>
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
                            <p>(Mã căn hộ|Mã tầng|Mã tòa nhà|Tên căn hộ|Tầng|Tòa nhà)</p>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                    </div>
                  </td>
                </tr>
                <!--Qr code generating -->
                <script>
                  var qrcode = new QRCode(document.getElementById("id-qrcode-<?php echo $row['uid']; ?>"), {
                    text: "<?php echo $row['uid'] . '|' . $row['fid'] . '|' . $row['branch_id'] . '|' . $row['unit_no'] . '|' . $row['floor_no'] . '|' . $row['branch_name']; ?>",
                    width: 200,
                    height: 200,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.M
                  });

                  $("#id-qrcode-<?php echo $row['uid']; ?> img").css("margin", "0 auto");
                </script>
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

  <script>
    function getIEVersion()
    // Returns the version of Windows Internet Explorer or a -1
    // (indicating the use of another browser).
    {
      var rv = -1; // Return value assumes failure.
      if (navigator.appName == 'Microsoft Internet Explorer') {
        var ua = navigator.userAgent;
        var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
        if (re.exec(ua) != null)
          rv = parseFloat(RegExp.$1);
      }
      return rv;
    }

    function tableToExcel(table, sheetName, fileName) {

      var ua = window.navigator.userAgent;
      var msie = ua.indexOf("MSIE ");
      if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) // If Internet Explorer
      {
        return fnExcelReport(table, fileName);
      }

      var uri = 'data:application/vnd.ms-excel;base64,',
        templateData = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>',
        base64Conversion = function(s) {
          return window.btoa(unescape(encodeURIComponent(s)))
        },
        formatExcelData = function(s, c) {
          return s.replace(/{(\w+)}/g, function(m, p) {
            return c[p];
          })
        }

      $("tbody > tr[data-level='0']").show();

      if (!table.nodeType)
        table = document.getElementById(table)

      var ctx = {
        worksheet: sheetName || 'Worksheet',
        table: table.innerHTML
      }

      var element = document.createElement('a');
      element.setAttribute('href', 'data:application/vnd.ms-excel;base64,' +
        base64Conversion(formatExcelData(templateData, ctx)));
      element.setAttribute('download', fileName);
      element.style.display = 'none';
      document.body.appendChild(element);
      element.click();
      document.body.removeChild(element);

      $("tbody > tr[data-level='0']").hide();
    }

    function fnExcelReport(table, fileName) {

      var tab_text = "<table border='2px'>";
      var textRange;

      if (!table.nodeType)
        table = document.getElementById(table)

      $("tbody > tr[data-level='0']").show();
      tab_text = tab_text + table.innerHTML;

      tab_text = tab_text + "</table>";
      tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
      tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
      tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

      txtArea1.document.open("txt/html", "replace");
      txtArea1.document.write(tab_text);
      txtArea1.document.close();
      txtArea1.focus();
      sa = txtArea1.document.execCommand("SaveAs", false, fileName + ".xlsx");
      $("tbody > tr[data-level='0']").hide();
      return (sa);
    }

    $(document).ready(function() {
      $("#btnExport").click(function() {
        var tempTable = $("#testExportId").html();

        $("#testExportId .excludeExport").remove();

        tableToExcel("testExportId", "test", "Danh sách căn hộ");

        $("#testExportId").html(tempTable);
      });
    });
  </script>