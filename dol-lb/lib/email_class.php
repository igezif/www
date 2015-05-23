<?php

class Email {
	
	private $data;
	
	public function __construct() {
		$this->data = parse_ini_file("text/emails.ini");
	}
	
	public function getTitle($name) {
		return $this->data[$name."_TITLE"];
	}
	
	public function getText($name) {
		return $this->data[$name."_TEXT"];
	}
	
}

?>