<?php

class SectionDB extends ObjectDB {
	
	protected static $table = "section";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("title", "ValidateTitle");
		$this->add("meta_desc", "ValidateMD");
		$this->add("meta_key", "ValidateMK");
		
	}
	
	protected function postInit() {
		$this->link = URL::get("section", "", array("id" => $this->id));
		return true;
	}

	public static function getAllShow() {
		//$select = new Select(self::$db);
		//$select->from(self::$table, "*")
		//	->where("`parent_id` is NULL");
		//$data = self::$db->select($select);
		$category = self::getAll();
		//$category = ObjectDB::buildMultiple(__CLASS__, $data);
		foreach ($category as $cat) $cat->postHandling();
		return $category;
	}
	
	public static function getAdminShow(){
		$category = self::getAll();
		foreach ($category as $cat) $cat->postAdminHandling();
		return $category;
	}

	/* private static function getChildCategory($id){
		$select = new Select(self::$db);
		$select->from(self::$table, "*")
			->where("`parent_id` = ?", array($id))
			->group("title");
		$data = self::$db->select($select);
		$category = ObjectDB::buildMultiple(__CLASS__, $data);
		return $category;
	} */
	
	private function postAdminHandling(){
		$this->link_update = URL::get("update", "admin", array("view" => "section", "id" => $this->id));
		$this->link_delete = URL::get("delete", "admin", array("view" => "section", "id" => $this->id));
	}
	
	private function postHandling() {
		$this->child_category = CategoryDB::getChildCategory ($this->id);
		$this->product = ProductDB::getThreeRandProduct ($this->id);
	}
	
	protected function postInsert() {
		return $this->id;
	}
	
}