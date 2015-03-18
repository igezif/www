<?php

class SliderDB extends ObjectDB {
	
	protected static $table = "slider";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("product_id", "ValidateID");
		$this->add("name", "ValidateText");
		$this->add("description", "ValidateText");
		$this->add("img", "ValidateIMG");
	}
	
	protected function postInit() {
		$this->link = URL::get("product", "", array("id" => $this->product_id));
		return true;
	}

	public static function getItems() {
		$select = new Select(self::$db);
		$select->from(self::$table, array("s.*", "p.img"), "s")
			->join("INNER", "product", "p", "s.product_id = p.id");
		//echo $select;die;
		$data = self::$db->select($select);
		$slider = ObjectDB::buildMultiple(__CLASS__, $data);
		//print_r($slider); die;
		return $slider;
	}
	
	protected function postInsert() {
		return $this->id;
	}
	
}