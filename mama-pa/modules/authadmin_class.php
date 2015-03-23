<?php

class Authadmin extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("action");
		$this->add("message");
	}
	
	public function getTmplFile() {
		return "auth_admin";
	}
	
}

?>