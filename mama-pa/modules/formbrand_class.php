<?php

class Formbrand extends Form {
	
	public function __construct() {
		parent::__construct();
		$this->add("message");
		//$this->add("link_insert");
	}
	
	public function getTmplFile() {
		return "form_brand";
	}
	
}