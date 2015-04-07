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
		$category = self::getAll();
		foreach ($category as $cat) $cat->postHandling();
		return $category;
	}
	
	
	private function postHandling() {
		$this->categories = CategoryDB::getCategoryOnSection($this->id);
		$this->products = ProductDB::getThreeRandProductOnSection($this->id);
	}
	
	public static function getAdminShow(){
		$category = self::getAll();
		foreach ($category as $cat) $cat->postAdminHandling();
		return $category;
	}
	
	private function postAdminHandling(){
		$this->link_update = URL::get("update", "admin", array("view" => "section", "id" => $this->id));
		$this->link_delete = URL::get("delete", "admin", array("view" => "section", "id" => $this->id));
	}
	
	
	protected function postInsert() {
		return $this->id;
	}
	
}