<?php

class Gallery extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("hornav");
		$this->add("header");
		$this->add("items", null, true);
		//$this->sections = SectionDB::getAll();
	}
	
	public function getTmplFile() {
		return "gallery";
	}
	
}