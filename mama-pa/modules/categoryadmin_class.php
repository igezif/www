<?php

class Categoryadmin extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("items");
	}
	
	public function getTmplFile() {
		return "category_admin";
	}
	
}