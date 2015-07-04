<?php

class Adminauth extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("message");
		$this->add("action");
		$this->add("link_register");
	}
	
	public function getTmplFile() {
		return "adminauth";
	}
	
}