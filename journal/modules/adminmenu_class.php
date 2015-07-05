<?php

class Adminmenu extends Module {

	public function __construct() {
		parent::__construct();
		$this->add("admin");
		$this->add("groups");
		$this->add("message");
	}

	public function getTmplFile() {
		return "adminmenu";
	}

}