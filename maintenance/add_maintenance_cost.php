<?php
include('../header.php');
include(ROOT_PATH . 'language/' . $lang_code_global . '/lang_add_maintenance_cost.php');
if (!isset($_SESSION['objLogin'])) {
	header("Location: " . WEB_URL . "logout.php");
	die();
}
$success = "none";
$m_title = '';
$m_date = '';
$m_amount = '0.00';
$m_details = '';
$m_month = 0;
$m_year = 0;
$branch_id = '';
$title = $_data['add_title_text'];
$button_text = $_data['save_button_text'];
$successful_msg = $_data['add_msg'];
$form_url = WEB_URL . "maintenance/add_maintenance_cost.php";
$id = "";
$hdnid = "0";

if (isset($_POST['txtMTitle'])) {
	$year_id = getYearId(date('Y', strtotime(str_replace('/', '-', $_POST['txtMDate']))));
	$month_id = date('n', strtotime(str_replace('/', '-', $_POST['txtMDate'])));

	if (isset($_POST['hdn']) && $_POST['hdn'] == '0') {
		$sql = "INSERT INTO tbl_add_maintenance_cost(m_title, m_date, xmonth, xyear, m_amount, m_details,branch_id) 
		values('$_POST[txtMTitle]','$_POST[txtMDate]','$month_id','$year_id','$_POST[txtMAmount]','$_POST[txtMDetails]','" . $_SESSION['objLogin']['branch_id'] . "')";
		mysqli_query($link, $sql);
		mysqli_close($link);
		$url = WEB_URL . 'maintenance/maintenance_cost_list.php?m=add';
		header("Location: $url");
	} else {
		$sql = "UPDATE `tbl_add_maintenance_cost` 
		SET `m_title`='" . $_POST['txtMTitle'] . "',`m_date`='" . $_POST['txtMDate'] . "',`xmonth`='" . $month_id . "',`xyear`='" . $year_id . "',`m_amount`='" . $_POST['txtMAmount'] . "',`m_details`='" . $_POST['txtMDetails'] . "' 
		WHERE mcid='" . $_GET['id'] . "'";
		mysqli_query($link, $sql);
		$url = WEB_URL . 'maintenance/maintenance_cost_list.php?m=up';
		header("Location: $url");
	}
	$success = "block";
}

if (isset($_GET['id']) && $_GET['id'] != '') {
	$result = mysqli_query($link, "SELECT * FROM tbl_add_maintenance_cost where mcid = '" . $_GET['id'] . "'");
	if ($row = mysqli_fetch_array($result)) {
		$m_title = $row['m_title'];
		$m_date = $row['m_date'];
		$m_amount = $row['m_amount'];
		$m_details = $row['m_details'];
		$m_month = $row['xmonth'];
		$m_year = $row['xyear'];
		$hdnid = $_GET['id'];
		$title = $_data['update_title_text'];
		$button_text = $_data['update_button_text'];
		$successful_msg = $_data['update_msg'];
		$form_url = WEB_URL . "maintenance/add_maintenance_cost.php?id=" . $_GET['id'];
	}
}

?>
<!-- Content Header (Page header) -->

<section class="content-header">
	<h1><?php echo $title; ?></h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo WEB_URL ?>/dashboard.php"><i class="fa fa-dashboard"></i><?php echo $_data['home_breadcam']; ?></a></li>
		<li class="active"><?php echo $_data['maintenance_cost']; ?></li>
		<li class="active"><?php echo $title; ?></li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<!-- Full Width boxes (Stat box) -->
	<div class="row">
		<div class="col-md-12">
			<div align="right" style="margin-bottom:1%;"></div>
			<div class="box box-success">
				<div class="box-header">
					<h3 class="box-title"><?php echo $_data['m_cost_entry_form']; ?></h3>
				</div>
				<form onSubmit="return validateMe();" action="<?php echo $form_url; ?>" method="post" enctype="multipart/form-data">
					<div class="box-body row">
						<div class="form-group col-md-12">
							<label for="txtMDate"><span class="errorStar">*</span> <?php echo $_data['date']; ?> :</label>
							<input type="text" name="txtMDate" value="<?php echo $m_date; ?>" id="txtMDate" class="form-control datepicker" />
						</div>
						<!-- <div class="form-group col-md-6">
							<label for="ddlMonth"><span class="errorStar">*</span> <?php echo $_data['month']; ?> :</label>
							<select name="ddlMonth" id="ddlMonth" class="form-control">
								<option value="">--<?php echo $_data['select_month']; ?>--</option>
								<?php
								$result_unit = mysqli_query($link, "SELECT * FROM tbl_add_month_setup order by m_id ASC");
								while ($row_unit = mysqli_fetch_array($result_unit)) { ?>
									<option <?php if ($m_month == $row_unit['m_id']) {
												echo 'selected';
											} ?> value="<?php echo $row_unit['m_id']; ?>"><?php echo $row_unit['month_name']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="ddlYear"><span class="errorStar">*</span> <?php echo $_data['year']; ?> :</label>
							<select name="ddlYear" id="ddlYear" class="form-control">
								<option value="">--<?php echo $_data['select_year']; ?>--</option>
								<?php
								$result_unit = mysqli_query($link, "SELECT * FROM tbl_add_year_setup order by y_id ASC");
								while ($row_unit = mysqli_fetch_array($result_unit)) { ?>
									<option <?php if ($m_year == $row_unit['y_id']) {
												echo 'selected';
											} ?> value="<?php echo $row_unit['y_id']; ?>"><?php echo $row_unit['xyear']; ?></option>
								<?php } ?>
							</select>
						</div> -->
						<div class="form-group col-md-6">
							<label for="txtMTitle"><span class="errorStar">*</span> <?php echo $_data['text_1']; ?> :</label>
							<input type="text" name="txtMTitle" value="<?php echo $m_title; ?>" id="txtMTitle" class="form-control" />
						</div>
						<div class="form-group col-md-6">
							<label for="txtMAmount"><span class="errorStar">*</span> <?php echo $_data['text_2']; ?> :</label>
							<div class="input-group">
								<input type="text" name="txtMAmount" value="<?php echo $m_amount; ?>" id="txtMAmount" class="form-control" />
								<div class="input-group-addon"> <?php echo CURRENCY; ?> </div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="txtMDetails"><span class="errorStar">*</span> <?php echo $_data['text_3']; ?> :</label>
							<textarea name="txtMDetails" id="txtMDetails" class="form-control"><?php echo $m_details; ?></textarea>
						</div>
					</div>
					<div class="box-footer">
						<div class="form-group pull-right">
							<button type="submit" name="button" class="btn btn-success"><i class="fa fa-floppy-o"></i> <?php echo $button_text; ?></button>
							<a class="btn btn-warning" href="<?php echo WEB_URL; ?>maintenance/maintenance_cost_list.php"><i class="fa fa-reply"></i> <?php echo $_data['back_text']; ?></a>
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
			if ($("#txtMDate").val() == '') {
				alert("<?php echo $_data['v1']; ?>");
				$("#txtMDate").focus();
				return false;
			} else if ($("#ddlMonth").val() == '') {
				// alert("<?php echo $_data['v2']; ?>");
				// $("#ddlMonth").focus();
				// return false;
			} else if ($("#ddlYear").val() == '') {
				// alert("<?php echo $_data['v3']; ?>");
				// $("#ddlYear").focus();
				// return false;
			} else if ($("#txtMTitle").val() == '') {
				alert("<?php echo $_data['v4']; ?>");
				$("#txtMTitle").focus();
				return false;
			} else if ($("#txtMAmount").val() == '') {
				alert("<?php echo $_data['v5']; ?>");
				$("#txtMAmount").focus();
				return false;
			} else if ($("#txtMDetails").val() == '') {
				alert("<?php echo $_data['v6']; ?>");
				$("#txtMDetails").focus();
				return false;
			} else {
				return true;
			}
		}
	</script>
	<?php include('../footer.php'); ?>