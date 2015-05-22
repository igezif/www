<?php

class Contactsadmin extends Module {
	
	public function __construct() {
		parent::__construct();
		$this->add("name", "ValidateTitle");
		$this->add("ind", "ValidateMD");
		$this->add("address", "ValidateMK");
		$this->add("phone", "ValidateIMG");
		$this->add("email", "ValidateText");
		$this->add("inn", "ValidateText");
		$this->add("kpp", "ValidateText");
		$this->add("bik", "ValidateText");
		$this->add("rs", "ValidateText");
		$this->add("bank", "ValidateText");
		$this->add("ks", "ValidateText");
		$this->add("okpo", "ValidateText");
		$this->add("okato", "ValidateText");
		$this->add("ogrn", "ValidateText");
	}
	
	public function getTmplFile() {
		return "contactsadmin";
	}
	
}