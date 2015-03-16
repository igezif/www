<?php

class ProductDB extends ObjectDB {
	
	protected static $table = "product";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("number", "ValidateID");
		$this->add("category_number", "ValidateID");
		$this->add("img", "ValidateIMG");
		$this->add("brand");
		$this->add("price");
		$this->add("title", "ValidateTitle");
		$this->add("meta_desc", "ValidateMD");
		$this->add("meta_key", "ValidateMK");
		$this->add("available", "ValidateBoolean");
	}
	
	/* protected function postInit() {
		if (!is_null($this->img)) $this->img = Config::DIR_IMG_ARTICLES.$this->img;
		$this->link = URL::get("article", "", array("id" => $this->id));
		return true;
	}
	
	protected function postInit() {
		if (!is_null($this->img)) $this->img = Config::DIR_IMG_ARTICLES.$this->img;
		$this->link = URL::get("brand", "", array("id" => $this->id));
		return true;
	} */
	
	public static function getThreeRandProduct($category_number) {
		
		return true;
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
	
}