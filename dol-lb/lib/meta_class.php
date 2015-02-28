<?php
require_once "global_class.php";

class Meta extends GlobalClass {

	public function __construct() {
		parent::__construct("meta");
	}
	
	public function getTitle($page) {
		return $this->getField("page", $page, "title");
	}
	
	public function getMeta_desc($page) {
		return $this->getField("page", $page, "meta_desc");
	}
	
	public function getMeta_key($page) {
		return $this->getField("page", $page, "meta_key");
	}
}
?>