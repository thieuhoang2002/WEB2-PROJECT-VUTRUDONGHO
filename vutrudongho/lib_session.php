<?php

if(!isset($_SESSION)){
	session_start();
}

function isAdminLogged() {
	if(isset($_SESSION['current_username'])) {
		if ($_SESSION['isAdmin'] == true)
			return true;
	}
	
	return false;
}
?>