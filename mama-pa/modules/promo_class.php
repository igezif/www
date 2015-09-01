<?php

class Promo extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("brands");
		
	}
	
	public function getTmplFile() {
		return "promo";
	}
	
}