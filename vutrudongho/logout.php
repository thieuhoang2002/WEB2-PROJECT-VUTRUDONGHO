<?php
require_once('lib_session.php');
	if(isset($_REQUEST['isAdmin'])) {
		echo 'Dang xuat admin thanh cong';
		header('location: index.php');
		unset($_SESSION['current_username']);
		unset($_SESSION['isAdmin']);
		unset($_SESSION['current_userID']);
	}
?>