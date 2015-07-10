<?php

class Group extends Module {

	public function __construct() {
		parent::__construct();
		$this->add("hornav");
		$this->add("group");
		$this->add("students");
		$this->add("message");
	}

	public function getTmplFile() {
		return "group";
	}

}