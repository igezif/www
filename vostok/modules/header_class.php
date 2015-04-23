<?php

class Header extends Module {
	
	public function __construct() {
		parent::__construct();
		//$this->add("uri");
		//$this->add("link_search");
		//$this->add("items", null, true);
	}
	
	public function getTmplFile() {
		return "header";
	}
	
}