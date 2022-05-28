<?php
include('../header.php');
if (!isset($_SESSION['objLogin'])) {
  header("Location: " . WEB_URL . "logout.php");
  die();
}
?>
<?php
include(ROOT_PATH . 'language/' . $lang_code_global . '/lang_floor_list.php');
$delinfo = 'none';
$addinfo = 'none';
$msg = "";
if (isset($_GET['id']) && $_GET['id'] != '' && $_GET['id'] > 0) {
  $sqlx = "DELETE FROM `tbl_add_floor` WHERE fid = " . $_GET['id'];
  mysqli_query($link, $sqlx);
  $delinfo = 'block';
}
if (isset($_GET['m']) && $_GET['m'] == 'add') {
  $addinfo = 'block';
  $msg = $_data['add_msg'];
}
if (isset($_GET['m']) && $_GET['m'] == 'up') {
  $addinfo = 'block';
  $msg = $_data['update_msg'];
}
?>
<!-- Content Header (Page header) -->

<section class="content-header">
  <h1> <?php echo $_data['floor_list_title']; ?> </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo WEB_URL ?>dashboard.php"><i class="fa fa-dashboard"></i><?php echo $_data['home_breadcam']; ?></a></li>
    <li class="active"><?php echo $_data['add_new_floor_information_breadcam']; ?></li>
    <li class="active"><?php echo $_data['floor_list_title']; ?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Full Width boxes (Stat box) -->
  <div class="row">
    <div class="col-xs-12">
      <div id="me" class="alert alert-danger alert-dismissable" style="display:<?php echo $delinfo; ?>">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i class="fa fa-close"></i></button>
        <h4><i class="icon fa fa-ban"></i><?php echo $_data['delete_text']; ?> !</h4>
        <?php echo $_data['delete_floor_information']; ?>
      </div>
      <div id="you" class="alert alert-success alert-dismissable" style="display:<?php echo $addinfo; ?>">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i class="fa fa-close"></i></button>
        <h4><i class="icon fa fa-check"></i> <?php echo $_data['success']; ?> !</h4>
        <?php echo $msg; ?>
      </div>
      <div align="right" style="margin-bottom:1%;"> <a class="btn btn-success" data-toggle="tooltip" href="<?php echo WEB_URL; ?>floor/addfloor.php" data-original-title="<?php echo $_data['add_floor']; ?>"><i class="fa fa-plus"></i></a> <a class="btn btn-success" data-toggle="tooltip" href="<?php echo WEB_URL; ?>dashboard.php" data-original-title="<?php echo $_data['home_breadcam']; ?>"><i class="fa fa-dashboard"></i></a> </div>
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title"><?php echo $_data['floor_list_title']; ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div style="margin:10px">
            <button id="btnExport" class="btn btn-success" onclick="">Xuất file excel</button>

          </div>
          <table id="testExportId" class="table sakotable table-bordered table-striped dt-responsive">
            <thead>
              <tr>
                <th style="display: none;"><?php echo "Mã tầng"; ?></th>
                <th><?php echo $_data['floor_no']; ?></th>
                <th class="excludeExport"><?php echo $_data['action_text']; ?></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $result = mysqli_query($link, "Select * from tbl_add_floor where branch_id = " . (int)$_SESSION['objLogin']['branch_id'] . " order by fid DESC");
              while ($row = mysqli_fetch_array($result)) { ?>
                <tr>
                  <td style="display: none;"><?php echo $row['fid']; ?></td>
                  <td><?php echo $row['floor_no']; ?></td>
                  <td class="excludeExport"><a class="btn btn-warning ams_btn_special" data-toggle="tooltip" href="<?php echo WEB_URL; ?>floor/addfloor.php?id=<?php echo $row['fid']; ?>" data-original-title="<?php echo $_data['edit_text']; ?>"><i class="fa fa-pencil"></i></a> <a class="btn btn-danger ams_btn_special" data-toggle="tooltip" onclick="deleteFloor(<?php echo $row['fid']; ?>);" href="javascript:;" data-original-title="<?php echo $_data['delete_text']; ?>"><i class="fa fa-trash-o"></i></a></td>
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
    function deleteFloor(Id) {
      var iAnswer = confirm("<?php echo $_data['confirm']; ?>");
      if (iAnswer) {
        window.location = '<?php echo WEB_URL; ?>floor/floorlist.php?id=' + Id;
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

        tableToExcel("testExportId", "test", "Danh sách tầng");

        $("#testExportId").html(tempTable);
      });
    });
  </script>