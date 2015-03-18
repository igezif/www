<?php

class CategoryDB extends ObjectDB {
	
	protected static $table = "category";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("number", "ValidateID");
		$this->add("parent_number", "ValidateID");
		$this->add("title", "ValidateTitle");
		$this->add("meta_desc", "ValidateMD");
		$this->add("meta_key", "ValidateMK");
		
	}
	
	/* protected function postInit() {
		//if (!is_null($this->img)) $this->img = Config::DIR_IMG_ARTICLES.$this->img;
		//$this->link = URL::get("article", "", array("id" => $this->id));
		//$this->link = "link";
		return true;
	} */
	
	protected function postInit() {
		$this->link = URL::get("category", "", array("id" => $this->id));
		return true;
	}
	
	public static function getAllShow() {
		$select = new Select(self::$db);
		$select->from(self::$table, "*")
			->where("`parent_number` is NULL");
		//echo $select; die;
		$data = self::$db->select($select);
		$category = ObjectDB::buildMultiple(__CLASS__, $data);
		foreach ($category as $cat) $cat->postHandling();
		//$category->postHandling();
		return $category;
		//return $data;
	}
	
	private static function getChildCategory($category_number){
		$select = new Select(self::$db);
		$select->from(self::$table, "*")
			->where("`parent_number` = ?", array($category_number))
			->group("title");
		//echo $select;die;	
		$data = self::$db->select($select);
		$category = ObjectDB::buildMultiple(__CLASS__, $data);
		return $category;
	}
	
	private function postHandling() {
		$this->child_category = self::getChildCategory ($this->number);
		$this->product = ProductDB::getThreeRandProduct ($this->id);
		//$this->brand = ProductDB::getBrandsOnCategory ($this->number);
	}
	
	protected function postInsert() {
		return $this->id;
	}
	
}