<?php

class Viewgallery extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("hornav");
		$this->add("header");
		$this->add("items", null, true);
	}
	
	public function getTmplFile() {
		return "viewgallery";
	}
	
}