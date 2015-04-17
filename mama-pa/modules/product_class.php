<?php

class Product extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("hornav");
		$this->add("title");
		$this->add("img");
		$this->add("available");
		$this->add("id");
		$this->add("brand");
		$this->add("price");
		$this->add("description");
		$this->add("foto", null, true);
	}
	
	public function getTmplFile() {
		return "product";
	}
	
}