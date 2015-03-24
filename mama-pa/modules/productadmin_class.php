<?php

class Productadmin extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("items");
	}
	
	public function getTmplFile() {
		return "product_admin";
	}
	
}