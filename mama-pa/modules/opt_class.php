<?php

class Opt extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("hornav");
		$this->add("header");
		$this->add("brands");
	}
	
	public function getTmplFile() {
		return "opt";
	}

}