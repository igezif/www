<?php

class HomeDB extends ObjectDB {
	
	protected static $table = "home";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("title", "ValidateTitle");
		$this->add("meta_desc", "ValidateMD");
		$this->add("meta_key", "ValidateMK");
		$this->add("img", "ValidateIMG");
		$this->add("content", "ValidateText");
	}

}