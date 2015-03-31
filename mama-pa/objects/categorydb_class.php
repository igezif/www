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
	
	protected function postInit() {
		$this->link = URL::get("category", "", array("id" => $this->id));
		return true;
	}

	public static function getAllShow() {
		$select = new Select(self::$db);
		$select->from(self::$table, "*")
			->where("`parent_number` is NULL");
		$data = self::$db->select($select);
		$category = ObjectDB::buildMultiple(__CLASS__, $data);
		foreach ($category as $cat) $cat->postHandling();
		return $category;
	}
	
	public static function getAdminShow(){
		$category = self::getAll();
		foreach ($category as $cat) $cat->postAdminHandling();
		return $category;
	}

	private static function getChildCategory($category_number){
		$select = new Select(self::$db);
		$select->from(self::$table, "*")
			->where("`parent_number` = ?", array($category_number))
			->group("title");
		$data = self::$db->select($select);
		$category = ObjectDB::buildMultiple(__CLASS__, $data);
		return $category;
	}
	
	private function postAdminHandling(){
		$this->link_update = URL::get("update", "admin", array("view" => "brand", "id" => $this->id));
		$this->link_delete = URL::get("delete", "admin", array("view" => "brand", "id" => $this->id));
	}
	
	private function postHandling() {
		$this->child_category = self::getChildCategory ($this->number);
		$this->product = ProductDB::getThreeRandProduct ($this->id);
	}
	
	protected function postInsert() {
		return $this->id;
	}
	
}