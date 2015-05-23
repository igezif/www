<?php

class Listimggallery extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("link_insert");
		$this->add("header");
		$this->add("message");
		$this->add("items");
	}
	
	public function getTmplFile() {
		return "listimggallery";
	}
	
}