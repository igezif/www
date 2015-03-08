<?php

class Slider extends Module {
	
	public function __construct() {
		parent::__construct();
		//$this->add("product");
	}
	
	public function getTmplFile() {
		return "slider";
	}
	
}

?>