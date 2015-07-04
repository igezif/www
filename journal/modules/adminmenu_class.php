<?php

class Adminmenu extends Module {

	public function __construct() {
		parent::__construct();
		$this->add("admin");
	}

	public function getTmplFile() {
		return "adminmenu";
	}

}