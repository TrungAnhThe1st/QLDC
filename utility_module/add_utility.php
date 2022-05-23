<?php 
include('../header.php');
include(ROOT_PATH.'language/'.$lang_code_global.'/lang_add_unit.php');
if(!isset($_SESSION['objLogin'])){
	header("Location: " . WEB_URL . "logout.php");
	die();
}
$success = "none";

$title = "Thêm mới tiện ích";
$button_text = $_data['save_button_text'];
$name = '';
$area_id = '';
$successful_msg = "Thêm thành công!";
$form_url = WEB_URL . "utility_module/add_utility.php";
$id="";
$hdnid="0";

if(isset($_POST['ddlArea'])){
	if(isset($_POST['hdn']) && $_POST['hdn'] == '0'){
		$sql = "INSERT INTO `tbl_add_utility`(`name`, `area_id`) 
		values('$_POST[txtName]', $_POST[ddlArea])";
		mysqli_query($link,$sql);
		mysqli_close($link);
		$url = WEB_URL . 'utility_module/utility_list.php?m=add';
		header("Location: $url");
	}
	else{
		$sql = "UPDATE `tbl_add_utility` 
		SET `name` = '$_POST[txtName]', area_id = $_POST[ddlArea], updated_at = CURRENT_TIMESTAMP 
		WHERE id='".$_GET['id']."'";
		
		mysqli_query($link,$sql);
		mysqli_close($link);
		$url = WEB_URL . 'utility_module/utility_list.php?m=up';
		header("Location: $url");
	}
	$success = "block";
}

if(isset($_GET['id']) && $_GET['id'] != ''){
	$result = mysqli_query($link,"SELECT * FROM tbl_add_utility where id = '" . $_GET['id'] . "'");
	while($row = mysqli_fetch_array($result)){
		$name = $row["name"];
        $area_id = $row["area_id"];
		$hdnid = $_GET['id'];
		$title = "Cập nhật tiện ích";
		$button_text = $_data['update_button_text'];
		$successful_msg = "Cập nhật thành công";
		$form_url = WEB_URL . "utility_module/add_utility.php?id=".$_GET['id'];
	}
}
if(isset($_GET['mode']) && $_GET['mode'] == 'view'){
	$title = 'Xem chi tiết';
}	
?>
<!-- Content Header (Page header) -->

<section class="content-header">
  <h1><?php echo $title;?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo WEB_URL?>dashboard.php"><i class="fa fa-dashboard"></i><?php echo $_data['home_breadcam'];?></a></li>
    <li class="active"><?php echo "Thông tin tiện ích";?></li>
    <li class="active"><?php echo $title;?></li>
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
        <h3 class="box-title"><?php echo "";?></h3>
      </div>
      <form onSubmit="return validateMe();" action="<?php echo $form_url; ?>" method="post" enctype="multipart/form-data">
        <div class="box-body">
          <div class="form-group">
            <label for="ddlArea"><span class="errorStar">*</span> <?php echo "Khu";?> :</label>
            <select name="ddlArea" id="ddlArea" class="form-control">
              <option value="">--<?php echo "Chọn khu";?>--</option>
              <?php 
				$result = mysqli_query($link,"SELECT * FROM tbl_area");
				while($row = mysqli_fetch_array($result)){?>
              <option <?php if($area_id == $row['id']){echo 'selected';}?> value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
              <?php } mysqli_close($link); ?>
            </select>
          </div>
          <div class="form-group">
            <label for="txtName"><span class="errorStar">*</span> <?php echo "Tên";?> :</label>
            <input type="text" name="txtName" value="<?php echo $name;?>" id="txtName" class="form-control" />
          </div>
		  
        <div class="box-footer">
          <div class="form-group pull-right">
            <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <?php echo $button_text; ?></button>
            <a class="btn btn-warning" href="<?php echo WEB_URL; ?>utility_module/utility_list.php"><i class="fa fa-reply"></i> <?php echo $_data['back_text'];?></a> </div>
        </div>
        <input type="hidden" value="<?php echo $hdnid; ?>" name="hdn"/>
      </form>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
</div>
</section>
<!-- /.row -->
<script type="text/javascript">
function validateMe(){
	if($("#ddlArea").val() == ''){
		alert("<?php echo "Yêu cầu chọn khu"; ?>");
		$("#ddlArea").focus();
		return false;
	}
	
	else{
		return true;
	}
}
</script>
<?php include('../footer.php'); ?>
