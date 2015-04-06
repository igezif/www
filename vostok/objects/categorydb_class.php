<?php

class CategoryDB extends ObjectDB {
	
	protected static $table = "category";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("section_id", "ValidateID");
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
			->where("`parent_id` is NULL");
		$data = self::$db->select($select);
		$category = ObjectDB::buildMultiple(__CLASS__, $data);
		foreach ($category as $cat) $cat->postHandling();
		return $category;
	}
	
	public static function getAdminShow(){
		$data = self::$db->getResult("select c.*, s.title as section from ".Config::DB_PREFIX."category c left join ".Config::DB_PREFIX."section s on c.section_id=s.id");
		$category = ObjectDB::buildMultiple(__CLASS__, $data);
		foreach ($category as $cat) $cat->postAdminHandling();
		return $category;
	}

	public static function getChildCategory($id){
		$select = new Select(self::$db);
		$select->from(self::$table, "*")
			->where("`section_id` = ?", array($id))
			->group("title");
		$data = self::$db->select($select);
		$category = ObjectDB::buildMultiple(__CLASS__, $data);
		return $category;
	}
	
	private function postAdminHandling(){
		$this->link_update = URL::get("update", "admin", array("view" => "category", "id" => $this->id));
		$this->link_delete = URL::get("delete", "admin", array("view" => "category", "id" => $this->id));
	}
	
	private function postHandling() {
		$this->child_category = self::getChildCategory ($this->id);
		$this->product = ProductDB::getThreeRandProduct ($this->id);
	}
	
	protected function postInsert() {
		return $this->id;
	}
	
}