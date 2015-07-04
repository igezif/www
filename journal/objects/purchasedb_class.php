<?php

class PurchaseDB extends ObjectDB {
	
	protected static $table = "purchase";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("order_id", "ValidateID");
		$this->add("product_id", "ValidateID");
		$this->add("count", "ValidatePhone");
	}
	
	
}