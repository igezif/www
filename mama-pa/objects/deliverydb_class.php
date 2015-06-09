<?php

class DeliveryDB extends ObjectDB {
	
	protected static $table = "delivery";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("title", "ValidateTitle");
		$this->add("checked", "ValidateBoolean");
	}
	
	public static function getAllShow() {
		$items = self::getAll();
		foreach ($items as $i) $i->postHandling();
		return $items;
	}
	
	private function postHandling() {
		$this->checked = (int) $this->checked;
	}
	
	protected function postInsert() {
		return $this->id;
	}
}