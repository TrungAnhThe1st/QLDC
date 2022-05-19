<?php
include('../header.php');
if (!isset($_SESSION['objLogin'])) {
    header("Location: " . WEB_URL . "logout.php");
    die();
}
if (isset($_SESSION['login_type']) && ((int)$_SESSION['login_type'] != 5)) {
    header("Location: " . WEB_URL . "logout.php");
    die();
}
$success = "none";
$title = "Tạo khu mới";
$button_text = $_data['save_button_text'];
$successful_msg = "Thành công!";
$image_building = WEB_URL . 'img/no_image.jpg';
$form_url = WEB_URL . "area/add_area.php";
$area_name = '';
$id = "";
$hdnid = "0";

if (isset($_POST['txtAreaName'])) {
    // $image_url = uploadImage();
    if (isset($_POST['hdn']) && $_POST['hdn'] == '0') {
        $sql = "INSERT INTO `tbl_area`(`name`) 
        VALUES ('$_POST[txtAreaName]')";
        mysqli_query($link, $sql);
        mysqli_close($link);
        $url = WEB_URL . 'area/area_list.php?m=add';
        header("Location: $url");
    } else {
        $sql = "UPDATE `tbl_area` SET `name`='" . $_POST['txtAreaName'] . "', `updated_at` = CURRENT_TIMESTAMP WHERE id = '" . $_GET['id'] . "'";
        mysqli_query($link, $sql);
        mysqli_close($link);
        $url = WEB_URL . 'area/area_list.php?m=up';
        header("Location: $url");
    }
    $success = "block";
}

if (isset($_GET['id']) && $_GET['id'] != '') {
    $result = mysqli_query($link, "SELECT * FROM tbl_area where id = '" . $_GET['id'] . "'");
    while ($row = mysqli_fetch_array($result)) {
        $area_name = $row['name'];
        $hdnid = $_GET['id'];
        $title = "Cập nhật khu";
        $button_text = $_data['update_button_text'];
        $successful_msg = "";
        $form_url = WEB_URL . "area/add_area.php?id=" . $_GET['id'];
    }

    //mysqli_close($link);

}

//for image upload
// function uploadImage(){
// 	if((!empty($_FILES["uploaded_file"])) && ($_FILES['uploaded_file']['error'] == 0)) {
// 	  $filename = basename($_FILES['uploaded_file']['name']);
// 	  $ext = substr($filename, strrpos($filename, '.') + 1);
// 	  if(($ext == "jpg" && $_FILES["uploaded_file"]["type"] == 'image/jpeg') || ($ext == "png" && $_FILES["uploaded_file"]["type"] == 'image/png') || ($ext == "gif" && $_FILES["uploaded_file"]["type"] == 'image/gif')){   
// 	  	$temp = explode(".",$_FILES["uploaded_file"]["name"]);
// 	  	$newfilename = NewGuid() . '.' .end($temp);
// 		move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], ROOT_PATH . '/img/upload/' . $newfilename);
// 		return $newfilename;
// 	  }
// 	  else{
// 	  	return '';
// 	  }
// 	}
// 	return $_POST['img_exist'];
// }

function NewGuid()
{
    $s = strtoupper(md5(uniqid(rand(), true)));
    $guidText =
        substr($s, 0, 8) . '-' .
        substr($s, 8, 4) . '-' .
        substr($s, 12, 4) . '-' .
        substr($s, 16, 4) . '-' .
        substr($s, 20);
    return $guidText;
}


if (isset($_GET['mode']) && $_GET['mode'] == 'view') {
    $title = 'Xem chi tiết về khu';
}

?>
<!-- Content Header (Page header) -->

<section class="content-header">
    <h1> <?php echo $title; ?> </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo WEB_URL ?>dashboard.php"><i class="fa fa-dashboard"></i> <?php echo $_data['home_breadcam']; ?></a></li>
        <li class="active"><a href="<?php echo WEB_URL ?>area/area_list.php"><?php echo "Khu"; ?></a></li>
        <li class="active"><?php echo $_data['text_1']; ?></li>
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
                </div>
                <form onSubmit="return validateMe();" action="<?php echo $form_url; ?>" method="post">
                    <div class="box-body row">
                        <div class="form-group col-md-12">
                            <label for="txtAreaName"><span style="color:red;">*</span> <?php echo "Tên khu"; ?> :</label>
                            <input type="text" name="txtAreaName" value="<?php echo $area_name; ?>" id="txtAreaName" class="form-control" />
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="form-group pull-right">
                            <button type="submit" name="button" class="btn btn-success"><i class="fa fa-floppy-o"></i> <?php echo $button_text; ?></button>
                            <a class="btn btn-warning" href="<?php echo WEB_URL; ?>area/area_list.php"><i class="fa fa-reply"></i> <?php echo $_data['back_text']; ?></a>
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
            // if ($("#txtBrName").val() == '') {
            //     alert("<?php echo $_data['r1']; ?>");
            //     $("#txtBrName").focus();
            //     return false;
            // } else if ($("#txtBrEmail").val() == '') {
            //     alert("<?php echo $_data['r2']; ?>");
            //     $("#txtBrEmail").focus();
            //     return false;
            // } else if ($("#txtBrConNo").val() == '') {
            //     alert("<?php echo $_data['r3']; ?>");
            //     $("#txtBrConNo").focus();
            //     return false;
            // } else if ($("#txtareaAddress").val() == '') {
            //     alert("<?php echo $_data['r4']; ?>");
            //     $("#txtareaAddress").focus();
            //     return false;
            // } else {
            //     return true;
            // }
        }
        // CKEDITOR.replace('building_rule', {
        //     height: 700
        // });
    </script>
    <?php include('../footer.php'); ?>