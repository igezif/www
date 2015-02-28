<?php
require_once "global_class.php";

class Reservation extends GlobalClass {

	public function __construct() {
		parent::__construct("reservation");
	}
	
	public function getYears() {
		$year = date("Y") - 6;
		$years = array();
		for ($i = 0; $i < 9; $i++) {
			$years[$i] = $year - $i;
		}
		return $years;
	}
	
	public function isExistsEmail($email) {
		return $this->isExistsFV("email", $email);
	}
	
}
?>