<?php

class Basket extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("hornav");
		$this->add("summ");
		$this->add("header");
		$this->add("text");
		$this->add("items", null, true);
	}
	
	public function getTmplFile() {
		return "basket";
	}

}