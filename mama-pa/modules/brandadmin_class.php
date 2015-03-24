<?php

class Brandadmin extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("items");
	}
	
	public function getTmplFile() {
		return "brand_admin";
	}
	
}