<?php

class SectionDB extends ObjectDB {
	
	protected static $table = "section";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("title", "ValidateTitle");
		$this->add("meta_desc", "ValidateMD");
		$this->add("meta_key", "ValidateMK");
	}

	protected function postInsert() {
		return $this->id;
	}

	protected function postUpdate() {
		return $this->id;
	}

	private function postHandling() {
		$this->categories = CategoryDB::getCategoryOnSection($this->id);
		$this->products = ProductDB::getThreeRandProductOnSection($this->id);
	}

	public static function getAllShow() {
		$sections = self::getAll();
		foreach ($sections as $section) $section->postHandling();
		return $sections;
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
		$this->alias = URL::get(self::$table, "", array("id" => $this->id));
	}

}