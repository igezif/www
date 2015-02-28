<?php
require_once "global_class.php";

class Gallery extends GlobalClass {

	public function __construct() {
		parent::__construct("gallery");
	}
	
	public function getAllImages() {
		return $this->getAll("id");
	}
}
?>