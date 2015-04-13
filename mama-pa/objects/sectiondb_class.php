<?php

class SectionDB extends ObjectDB {
	
	protected static $table = "section";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("title", "ValidateTitle");
		$this->add("meta_desc", "ValidateMD");
		$this->add("meta_key", "ValidateMK");
	}

	public static function getAllShow() {
		$sections = self::getAll();
		foreach ($sections as $section) $section->postHandling();
		return $sections;
	}
	
	private function postHandling() {
		$this->categories = CategoryDB::getCategoryOnSection($this->id);
		$this->products = ProductDB::getThreeRandProductOnSection($this->id);
	}
	
	protected function postInsert() {
		return $this->id;
	}

	/* ADMINKA */

	public static function getAdminShow(){
		$sections = self::getAll();
		foreach ($sections as $section) $section->postAdminHandling();
		return $sections;
	}
	
	private function postAdminHandling(){
		$this->link_update = URL::get("update", "admin", array("view" => "section", "id" => $this->id));
		$this->link_delete = URL::get("delete", "admin", array("view" => "section", "id" => $this->id));
	}

}