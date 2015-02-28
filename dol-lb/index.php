<?php
	
	mb_internal_encoding("UTF-8");
	//require_once "start.php";
	
	require_once "lib/url_class.php";
	
	$url = new URL();
	$view = $url->getView();
	
	$class = mb_strtolower($view."Content");
	
	if (file_exists("lib/".$class."_class.php")) {
		require_once "lib/".$class."_class.php";
		new $class();
	}
	else {
		require_once "lib/notfoundcontent_class.php";
		new NotFoundContent();
	}
	
?>
