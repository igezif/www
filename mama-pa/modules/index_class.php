<?php

class Index extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("sections");
	}
	
	public function getTmplFile() {
		return "index";
	}
	
}

?>