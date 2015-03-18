<?php

class ProductDB extends ObjectDB {
	
	protected static $table = "product";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("category_id", "ValidateID");
		$this->add("img", "ValidateIMG");
		$this->add("brand");
		$this->add("price");
		$this->add("title", "ValidateTitle");
		$this->add("meta_desc", "ValidateMD");
		$this->add("meta_key", "ValidateMK");
		$this->add("available", "ValidateBoolean");
	}
	
	protected function postInit() {
		$this->link = URL::get("product", "", array("id" => $this->id));
		return true;
	}
	
	public static function getThreeRandProduct($category_id) {
		$select = new Select(self::$db);
		$select->from(self::$table, array("id"))
			->where("`category_id` = ?", array($category_id));
		$ids_category = self::$db->selectCol($select);
		$ids = self::getRandDigits(count($ids_category) - 1, 3);
		$select = new Select(self::$db);
		$select->from(self::$table, "*")
			->whereIn("id", array($ids_category[$ids[0]], $ids_category[$ids[1]], $ids_category[$ids[2]]))
			->where("category_id = ?", array($category_id));
		$data = self::$db->select($select);
		$products = ObjectDB::buildMultiple(__CLASS__, $data);
		return $products;
	}
	
	public static function getBrandsOnCategory ($category_number) {
		$select = new Select(self::$db);
		$select->from(self::$table, "*")
			->where("`category_number` = ".self::$db->getSQ(), array($category_number))
			->group('brand');
		$data = self::$db->select($select);
		$brands = ObjectDB::buildMultiple(__CLASS__, $data);
		return $brands;
	}
	
	protected function postInsert() {
		return $this->id;
	}
	
}