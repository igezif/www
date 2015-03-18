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
	
	public static function getThreeRandProduct($category_id) {
		$select = new Select(self::$db);
		/* $select->from(self::$table, array("COUNT(id)"))
			->where("`category_id` = ?", array($category_id));
		$max = self::$db->selectCell($select); */
		
		$select->from(self::$table, array("id"))
			->where("`category_id` = ?", array($category_id));
			
		$ids_category = self::$db->selectCol($select);
		print_r($ids_category);die;
		
		
		$ids = self::getRandDigits($max, 3);
		
		$select = new Select(self::$db);
		$select->from(self::$table, "*")
			->whereIn("id", $ids)
			->where("category_id = ?", array($category_id));
		echo $select;die;
		$data = self::$db->select($select);
		$products = ObjectDB::buildMultiple(__CLASS__, $data);
		//print_r($count);
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
	
	private static function getRandDigits($max, $count){
		$x=array();
		$tmp=array();
		for ($i = 0; $i < $count; $i++) {
		   do {
			  $a = mt_rand(1, $max);
		   } while(isset($tmp[$a]));
		   $tmp[$a]=1;
		   $x[]=$a;
		}
		return $x;
	}
	
	protected function postInsert() {
		return $this->id;
	}
	
}