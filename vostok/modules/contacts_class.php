<?php

class Contacts extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("hornav");
		//$this->add("header");
		//$this->add("img");
		//$this->add("content");
		//$this->add("price");
		//$this->add("items", null, true);
	}
	
	public function getTmplFile() {
		return "contacts";
	}
	
}