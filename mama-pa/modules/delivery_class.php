<?php

class Delivery extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("hornav");
		$this->add("header");
	}
	
	public function getTmplFile() {
		return "delivery";
	}

}