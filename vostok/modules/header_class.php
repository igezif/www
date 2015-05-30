<?php

class Header extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("phone");
		$this->add("phone_number");
		//$this->add("link_search");
		//$this->add("items", null, true);
	}
	
	public function getTmplFile() {
		return "header";
	}
	
}