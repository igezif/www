<?php

class OrderDB extends ObjectDB {
	
	protected static $table = "order";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("name", "ValidateTitle");
		$this->add("phone", "ValidatePhone");
		$this->add("email", "ValidateEmail");
		$this->add("address", "ValidateSmallText");
		$this->add("pay_id", "ValidateID");
		$this->add("delivery_id", "ValidateID");
		$this->add("summ", "ValidatePrice");
		$this->add("notice");
		$this->add("date_order", "ValidateDate", self::TYPE_TIMESTAMP, $this->getDate());
		$this->add("date_pay", "ValidateDate", self::TYPE_TIMESTAMP);
		$this->add("date_send", "ValidateDate", self::TYPE_TIMESTAMP);
	}
	
	protected function postInsert() {
		return $this->id;
	}
	
}