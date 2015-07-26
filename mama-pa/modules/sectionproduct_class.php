<?php

class Sectionproduct extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("title");
		$this->add("hornav");
		$this->add("full_text");
		$this->add("products");
		$this->add("pagination");
		$this->add("categories");
	}
	
	public function getTmplFile() {
		return "sectionproduct";
	}
	
}