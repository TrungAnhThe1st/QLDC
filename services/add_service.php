<?php
include('../header.php');
include(ROOT_PATH . 'language/' . $lang_code_global . '/lang_add_unit.php');
if (!isset($_SESSION['objLogin'])) {
	header("Location: " . WEB_URL . "logout.php");
	die();
}
$success = "none";
$name = '';
$utility_id = '';
$sub_type = '';
$first_month_free = '';
$price = 0.00;
$title = "Thêm mới dịch vụ";
$button_text = $_data['save_button_text'];
$successful_msg = "Thêm mới dịch vụ thành công";
$form_url = WEB_URL . "services/add_service.php";
$id = "";
$hdnid = "0";

if (isset($_POST['ddlUtility'])) {
	if (isset($_POST['hdn']) && $_POST['hdn'] == '0') {
		$sql = "INSERT INTO `tbl_add_service`(`name`, `utility_id`, `sub_type`, `first_month_free`, `price`) 
		values('$_POST[txtName]', $_POST[ddlUtility], $_POST[ddlSubType], $_POST[ddlFMF], $_POST[txtPrice])";
		mysqli_query($link, $sql);
		mysqli_close($link);
		$url = WEB_URL . 'services/service_list.php?m=add';
		header("Location: $url");
	} else {
		$sql = "UPDATE `tbl_add_service` 
		SET `name` = '$_POST[txtName]', utility_id = $_POST[ddlUtility], sub_type = $_POST[ddlSubType], first_month_free = $_POST[ddlFMF], price = $_POST[txtPrice], 
		updated_at = CURRENT_TIMESTAMP 
		WHERE id='" . $_GET['id'] . "'";

		mysqli_query($link, $sql);
		mysqli_close($link);
		$url = WEB_URL . 'services/service_list.php?m=up';
		header("Location: $url");
	}
	$success = "block";
}

if (isset($_GET['id']) && $_GET['id'] != '') {
	$result = mysqli_query($link, "SELECT * FROM tbl_add_service where id = '" . $_GET['id'] . "'");
	while ($row = mysqli_fetch_array($result)) {
		$name = $row['name'];
		$utility_id = $row['utility_id'];
		$sub_type = $row['sub_type'];
		$first_month_free = $row['first_month_free'];
		$price = $row['price'];
		$hdnid = $_GET['id'];
		$title = "Cập nhật dịch vụ";
		$button_text = $_data['update_button_text'];
		$successful_msg = "Cập nhật dịch vụ thành công";
		$form_url = WEB_URL . "services/add_service.php?id=" . $_GET['id'];
	}
}
if (isset($_GET['mode']) && $_GET['mode'] == 'view') {
	$title = 'Xem chi tiết dịch vụ';
}
?>
<!-- Content Header (Page header) -->

<section class="content-header">
	<h1><?php echo $title; ?></h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo WEB_URL ?>dashboard.php"><i class="fa fa-dashboard"></i><?php echo $_data['home_breadcam']; ?></a></li>
		<li class="active"><?php echo "Thông tin dịch vụ"; ?></li>
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
						<div class="form-group col-md-6">
							<label for="txtName"><span class="errorStar">*</span> <?php echo "Tên dịch vụ"; ?> :</label>
							<input type="text" name="txtName" value="<?php echo $name; ?>" id="txtName" class="form-control" />
						</div>
						<div class="form-group col-md-6">
							<label for="ddlUtility"><span class="errorStar">*</span> <?php echo "Chọn tiện ích"; ?> :</label>
							<select name="ddlUtility" id="ddlUtility" class="form-control">
								<option value="">--<?php echo "Chọn tiện ích"; ?>--</option>
								<?php
								$result = mysqli_query($link, "select u.*, a.name as a_name from tbl_add_utility u 
								inner join tbl_area a on a.id = u.area_id");
								while ($row = mysqli_fetch_array($result)) { ?>
									<option <?php if ($utility_id == $row['id']) {
												echo 'selected';
											} ?> value="<?php echo $row['id']; ?>"><?php echo $row['name'] . ' - ' . $row['a_name']; ?></option>
								<?php }
								mysqli_close($link); ?>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="ddlSubType"><span class="errorStar">*</span> <?php echo "Loại"; ?> :</label>
							<select name="ddlSubType" id="ddlSubType" class="form-control">
								<option value="1" >Gói tháng</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="ddlFMF"><span class="errorStar">*</span> <?php echo "Miễn phí tháng đầu"; ?> :</label>
							<select name="ddlFMF" id="ddlFMF" class="form-control">
								<option value="0" <?php echo $first_month_free == 0 ? "selected" : ""?> >Không</option>
								<option value="1" <?php echo $first_month_free == 1 ? "selected" : ""?> >Có</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="txtPrice"><span class="errorStar">*</span> <?php echo "Giá tiền"; ?> :</label>
							<input type="text" name="txtPrice" value="<?php echo $price; ?>" id="txtPrice" class="form-control" />
						</div>
					</div>
					<div class="box-footer">
						<div class="form-group pull-right">
							<button type="submit" name="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> <?php echo $button_text; ?></button>
							<a class="btn btn-warning" href="<?php echo WEB_URL; ?>services/service_list.php"><i class="fa fa-reply"></i> <?php echo $_data['back_text']; ?></a>
						</div>
					</div>
					<input type="hidden" value="<?php echo $hdnid; ?>" name="hdn" />
				</form>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>
	<!-- /.row -->
	<script type="text/javascript">
		function validateMe() {
			if ($("#ddlUtility").val() == '') {
				alert("<?php echo "Vui lòng chọn tiện ích cho dịch vụ"; ?>");
				$("#ddlUtility").focus();
				return false;
			} else {
				return true;
			}
		}
	</script>
	<?php include('../footer.php'); ?>