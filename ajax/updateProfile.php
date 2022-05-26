<?php
	include("../config.php");
	include("../library/encryption.php");
	$converter = new Encryption;
	session_start();
	if(isset($_SESSION['objLogin'])){
		if(isset($_POST['txtProfilePassword'])){
			$name = !empty($_POST['txtProfileName']) ? $_POST['txtProfileName'] : '';
			$email = !empty($_POST['txtProfileEmail']) ? $_POST['txtProfileEmail'] : '';
			$contact = !empty($_POST['txtProfileContact']) ? $_POST['txtProfileContact'] : '';
			$password = $converter->encode($_POST['txtProfilePassword']);
			$sql = '';
			if($_SESSION['login_type'] == '1'){
				$sql = "UPDATE `tbl_add_admin` set name = '$name', email = '$email', contact = '$contact', password = '$password' where aid = '$_POST[user_id]'";
				$_SESSION['objLogin']['name'] = $name;
				$_SESSION['objLogin']['email'] = $email;
				$_SESSION['objLogin']['contact'] = $contact;
				$_SESSION['objLogin']['password'] = $password;
			}
			else if($_SESSION['login_type'] == '2'){
				$sql = "UPDATE `tbl_add_owner` set o_name = '$name', o_email = '$email',o_contact = '$contact', o_password = '$password' where ownid = '$_POST[user_id]'";
				
			}
			else if($_SESSION['login_type'] == '3'){
				$sql = "UPDATE `tbl_add_employee` set e_name = '$name', e_email = '$email', e_contact = '$contact', e_password = '$password' where eid = '$_POST[user_id]'";
				$_SESSION['objLogin']['e_name'] = $name;
				$_SESSION['objLogin']['e_email'] = $email;
				$_SESSION['objLogin']['e_contact'] = $contact;
				$_SESSION['objLogin']['e_password'] = $password;
			}
			else if($_SESSION['login_type'] == '4'){
				$sql = "UPDATE `tbl_add_rent` set r_name = '$name', r_email = '$email', r_contact = '$contact', r_password = '$password' where rid = '$_POST[user_id]'";
				$_SESSION['objLogin']['r_name'] = $name;
				$_SESSION['objLogin']['r_email'] = $email;
				$_SESSION['objLogin']['r_contact'] = $contact;
				$_SESSION['objLogin']['r_password'] = $password;
			}
			else if($_SESSION['login_type'] == '5'){
				$sql = "UPDATE `tblsuper_admin` set name = '$name', email = '$email', contact = '$contact', password = '$password' where user_id = '$_POST[user_id]'";
				$_SESSION['objLogin']['name'] = $name;
				$_SESSION['objLogin']['email'] = $email;
				$_SESSION['objLogin']['contact'] = $contact;
				$_SESSION['objLogin']['password'] = $password;
			}
			mysqli_query($link,$sql);
			echo "1";
		}
		else{
			echo '-99';
		}
	}
	else{
		echo '-99';
		
	}
