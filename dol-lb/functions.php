<?php
	require_once "start.php";
	
	require_once "lib/manage_class.php";
	
	$manage = new Manage();
	
	if (isset($_POST["captcha"])) {
		echo $manage->checkCaptcha($_POST["captcha"]);
	}
	if (isset($_POST["data_type"]) && $_POST["data_type"] == "reserv") {
		echo $manage->reserv();
	}
	elseif (isset($_POST["data_type"]) && $_POST["data_type"] == "send") {
		echo $manage->send();
	}
	elseif (isset($_POST["vote"])) {
		$r = $manage->vote();
		$manage->redirect($r);
	}
	else exit;



	
?>
