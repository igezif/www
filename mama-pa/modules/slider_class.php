<?php

class Slider extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("items");
		$this->add("active");
	}
	
	public function getTmplFile() {
		return "slider";
	}
	
}

?>