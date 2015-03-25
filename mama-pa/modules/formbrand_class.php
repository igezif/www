<?php

class Formbrand extends Form {
	
	public function __construct() {
		parent::__construct();
		//$this->add("items");
		//$this->add("link_insert");
	}
	
	public function getTmplFile() {
		return "form_brand";
	}
	
}