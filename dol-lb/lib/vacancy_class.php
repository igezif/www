<?php
require_once "global_class.php";

class Vacancy extends GlobalClass {

	public function __construct() {
		parent::__construct("vacancy");
	}
	
	public function getAllVacancy() {
		return $this->getAll("id");
	}
}
?>