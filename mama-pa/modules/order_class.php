<?php

class Order extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("hornav");
		$this->add("summ");
		$this->add("header");
	}
	
	public function getTmplFile() {
		return "order";
	}

}