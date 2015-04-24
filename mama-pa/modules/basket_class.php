<?php

class Basket extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("summ");
		$this->add("items", null, true);
	}
	
	public function getTmplFile() {
		return "basket";
	}

}