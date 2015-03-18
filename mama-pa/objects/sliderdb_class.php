<?php

class SliderDB extends ObjectDB {
	
	protected static $table = "slider";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("product_id", "ValidateID");
		$this->add("name", "ValidateText");
		$this->add("description", "ValidateText");
	}
	
	protected function postInit() {
		$this->link = URL::get("product", "", array("id" => $this->product_id));
		return true;
	}

	public static function getItems() {
		$select = new Select(self::$db);
		$select->from(self::$table, "*", "s")
			->join("INNER", "product", "p", "s.product_id = p.id");
		echo $select;die;
		$data = self::$db->select($select);
		
		print_r($data); die;
	}
	
	protected function postInsert() {
		return $this->id;
	}
	
}