<?php

class Slideradmin extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("items");
		$this->add("link_insert");
		$this->add("message");
	}
	
	public function getTmplFile() {
		return "slider_admin";
	}
	
}