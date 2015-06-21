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
		$this->add("show", "ValidateBoolean");
	}

	protected function postInit() {
		$this->link = URL::get("category", "", array("id" => $this->id));
		return true;
	}

	protected function postInsert() {
		return $this->id;
	}

	protected function postUpdate() {
		return $this->id;
	}
	
	public static function getCategoryOnSection($id){
		$select = new Select(self::$db);
		$select->from(self::$table, "*")
			->where("`section_id` = ?", array($id))
			->where("`show` = 1")
			->group("title");
		$data = self::$db->select($select);
		$category = ObjectDB::buildMultiple(__CLASS__, $data);
		return $category;
	}
	
	/* ADMINKA */
	public static function getAdminShow(){
		$data = self::$db->getResult("select c.*, s.title as section from ".Config::DB_PREFIX."category c left join ".Config::DB_PREFIX."section s on c.section_id=s.id");
		$category = ObjectDB::buildMultiple(__CLASS__, $data);
		foreach ($category as $cat) $cat->postAdminHandling();
		return $category;
	}
	
	private function postAdminHandling(){
		$this->link_update = URL::get("update", "admin", array("view" => "category", "id" => $this->id));
		$this->link_delete = URL::get("delete", "admin", array("view" => "category", "id" => $this->id));
		$this->alias = URL::get(self::$table, "", array("id" => $this->id));
	}
	
	public static function getIdonNumder($number){
		$select = new Select(self::$db);
		$select->from(self::$table, array("id"))
			->where("`number` = ?", array($number));
		$id = self::$db->selectCell($select);
		if(!$id){
			$select = new Select(self::$db);
			$select->from(self::$table, array("id"))
				->where("`parent_number` = ?", array($number));
			$id = self::$db->selectCell($select);
		}
		return $id;
	}
	
}