<?php

class About extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("hornav");
		//$this->add("items", null, true);
	}
	
	public function getTmplFile() {
		return "about";
	}
	
}