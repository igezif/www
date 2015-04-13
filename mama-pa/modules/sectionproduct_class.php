<?php

class Sectionproduct extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("title");
		$this->add("hornav");
		$this->add("products");
		$this->add("pagination");
	}
	
	public function getTmplFile() {
		return "sectionproduct";
	}
	
}