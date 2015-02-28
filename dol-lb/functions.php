<?php
	require_once "start.php";
	
	require_once $dir_lib."manage_class.php";
	
	$manage = new Manage();
	
	if ($_POST["captcha"]) {
		echo $manage->checkCaptcha($_POST["captcha"]);
	}
	
	if ($_POST["data_type"] == "reserv") {
		echo $manage->reserv();
	}
	elseif ($_POST["data_type"] == "send") {
		echo $manage->send();
	}
	elseif ($_POST["vote"]) {
		$r = $manage->vote();
		$manage->redirect($r);
	}
	else exit;
	
	
?>